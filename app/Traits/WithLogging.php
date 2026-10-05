<?php

namespace App\Traits;

use Exception;

// Unused in main application but can be used in modules
// @phpstan-ignore-next-line
trait WithLogging
{
    public function log($message, $level = 'info')
    {
        if ($message instanceof Exception) {
            $message = $message->getMessage();
        }
        $this->dispatch('logger', ['type' => $level, 'message' => $message]);
    }
}
