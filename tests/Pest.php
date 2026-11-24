<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Modules\Core\Models\User;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind different classes or traits.
|
*/

pest()->extend(TestCase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Modules
|--------------------------------------------------------------------------
|
| Every module that ships test files (modules/**.test.php, see the "Modules"
| testsuite in phpunit.xml) runs against the base test case with a fresh,
| transaction-wrapped database. Directories are discovered at runtime, so
| adding or removing modules never requires changes in this file.
|
*/

$moduleDirectories = glob(dirname(__DIR__).'/modules/*') ?: [];

if ($moduleDirectories !== []) {
    pest()->extend(TestCase::class)
        ->use(RefreshDatabase::class)
        ->in(...$moduleDirectories);
}

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| While you're writing tests, you often need to check that values meet certain criteria.
| The "expect()" function gives you access to a set of "expectations" methods that can be
| used to assert different things. Of course, you may extend these Expectations with
| yours own custom expectations as needed.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, sometimes you need to prepare Laravel
| factories or other shared state for your tests. Here you may define functions
| that will be available in all test files.
|
| These helpers must stay module-agnostic: they only rely on the base
| application and its configuration. Module-specific helpers belong in the
| module itself (modules/<Module>/tests/helpers.php).
|
*/

/**
 * Create a user using the configured auth user model.
 *
 * When permissions are given and the user model supports Spatie's
 * permission traits, the permissions are assigned as well.
 *
 * PHPStan needs to know what model is being used for the user. Defaulting to Core User
 *
 * @return User
 */
function makeUser(array $attributes = [], array $permissions = []): Model
{
    static $counter = 0;
    $counter++;

    $userModel = config('auth.providers.users.model');

    $user = $userModel::create(array_merge([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'username' => 'user'.$counter.'_'.Str::lower(Str::random(4)),
        'email' => 'user'.$counter.'@example.com',
        'password' => 'Password123!',
    ], $attributes));

    if ($permissions !== [] && method_exists($user, 'givePermissionTo')) {
        $permissionModel = config('permission.models.permission');

        foreach ($permissions as $permission) {
            $user->givePermissionTo($permissionModel::findOrCreate($permission, 'web'));
        }
    }

    return $user;
}
