<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;

// Unused in main application but can be used in modules
// @phpstan-ignore-next-line
trait WithLogging
{
    public function log($message, $level = 'info'): void
    {
        if ($message instanceof Exception) {
            $message = $message->getMessage();
        }
        $this->dispatch('logger', ['type' => $level, 'message' => $message]);
    }
}
