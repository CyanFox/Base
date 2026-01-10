<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DDCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dd {code*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'dd your code.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        return collect($this->argument('code'))
            ->map(fn (string $command): string => mb_rtrim($command, ';'))
            ->map(fn (string $sanitizedCommand) => eval("dump({$sanitizedCommand});"))
            ->implode(PHP_EOL);
    }
}
