<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class SettingNotFoundException extends Exception
{
    protected $message = 'The requested setting was not found.';

    public function __construct($settingKey = '')
    {
        if ($settingKey) {
            $this->message = "The requested setting '{$settingKey}' was not found.";
        }
        parent::__construct($this->message);
    }
}
