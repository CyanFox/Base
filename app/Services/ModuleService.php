<?php

declare(strict_types=1);

namespace App\Services;

use App\Facades\VersionManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Nwidart\Modules\Exceptions\ModuleNotFoundException;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Module as ModuleInstance;
use RuntimeException;
use ZipArchive;

class ModuleService
{
    public function checkRequirements(string $moduleName): bool
    {
        $requirements = $this->getRequirements($moduleName);

        if ($requirements === []) {
            return true;
        }

        foreach ($requirements as $requirement) {
            $module = $this->getModule($requirement);

            if ($module->isDisabled()) {
                return false;
            }

            if ($module->isEnabled() && !$this->checkRequirements($module->getName())) {
                return false;
            }
        }

        return true;
    }

    public function getRequirements(string $moduleName): array
    {
        return $this->getModule($moduleName)->get('require', []);
    }

    public function getBaseVersion(string $moduleName): ?string
    {
        return $this->getModule($moduleName)->get('version');
    }

    public function checkBaseVersion(string $moduleName): bool
    {
        $module = $this->getModule($moduleName);
        $baseVersion = $module->get('base_version');

        if ($baseVersion === null) {
            return true;
        }

        return version_compare(VersionManager::getCurrentBaseVersion(), $baseVersion, '>=');
    }

    public function getAuthors(string $moduleName): ?array
    {
        return $this->getModule($moduleName)->get('authors');
    }

    public function getKeywords(string $moduleName): ?array
    {
        return $this->getModule($moduleName)->get('keywords');
    }

    public function getDescription(string $moduleName): ?string
    {
        return $this->getModule($moduleName)->get('description');
    }

    public function getSettingsPage(string $moduleName): ?string
    {
        $module = $this->getModule($moduleName);
        $settingsPage = $module->get('settings_page');

        if ($settingsPage !== null && Route::has($settingsPage)) {
            return route($settingsPage);
        }

        return null;
    }

    public function isUpdateAvailable(string $moduleName): bool
    {
        $remoteVersion = $this->getRemoteVersion($moduleName);
        $currentVersion = $this->getVersion($moduleName);

        if ($remoteVersion === null) {
            return false;
        }

        return version_compare($remoteVersion, $currentVersion, '>');
    }

    public function getRemoteVersion(string $moduleName): ?string
    {
        $module = $this->getModule($moduleName);

        if (config('app.env') === 'testing') {
            return $this->getVersion($moduleName);
        }

        $remoteUrl = $module->get('remote_version_url');
        if ($remoteUrl === null) {
            return null;
        }

        $cacheKey = $moduleName . '_version';

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($module, $remoteUrl) {
            $headers = $module->get('remote_headers', []);

            $response = empty($headers)
                ? Http::get($remoteUrl)
                : Http::withHeaders($headers)->get($remoteUrl);

            $data = $response->json();

            return $data['version'] ?? null;
        });
    }

    public function getVersion(string $moduleName): ?string
    {
        return $this->getModule($moduleName)->get('version');
    }

    public function runInstall(string $moduleName): void
    {
        $installCommand = $this->getModule($moduleName)->get('install_command');

        if ($installCommand !== null) {
            Artisan::call($installCommand);
        }
    }

    public function runUninstall(string $moduleName): void
    {
        $uninstallCommand = $this->getModule($moduleName)->get('uninstall_command');

        if ($uninstallCommand !== null) {
            Artisan::call($uninstallCommand);
        }
    }

    public function installModule(string $path): bool
    {
        $fullPath = storage_path($path);
        $moduleName = pathinfo($path, PATHINFO_FILENAME);

        return $this->extractAndEnableModule($fullPath, $moduleName);
    }

    public function getModule(string $moduleName): ModuleInstance
    {
        $module = Module::find($moduleName);

        if ($module === null) {
            throw new ModuleNotFoundException("Module '{$moduleName}' not found.");
        }

        return $module;
    }

    public function installModuleFromURL(string $url): bool
    {
        $tempPath = storage_path('app/temp');
        $tempFile = $tempPath . '/' . basename($url);

        File::ensureDirectoryExists($tempPath);

        try {
            $response = Http::timeout(30)->get($url);

            if ($response->failed()) {
                throw new RuntimeException('Failed to download module');
            }

            File::put($tempFile, $response->body());

            $moduleName = pathinfo($tempFile, PATHINFO_FILENAME);

            return $this->extractAndEnableModule($tempFile, $moduleName);
        } finally {
            File::deleteDirectory($tempPath);
        }
    }

    private function extractAndEnableModule(string $zipPath, string $moduleName): bool
    {
        $zip = new ZipArchive();

        if ($zip->open($zipPath) !== true) {
            return false;
        }

        $destinationPath = base_path('modules');
        $zip->extractTo($destinationPath);
        $zip->close();

        $this->getModule($moduleName)->enable();
        $this->runInstall($moduleName);

        return true;
    }
}
