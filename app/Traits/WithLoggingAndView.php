<?php

namespace App\Traits;

use Exception;

trait WithLoggingAndView
{
    public function log($message, $level = 'info'): void
    {
        if ($message instanceof Exception) {
            $message = $message->getMessage();
        }
        $this->dispatch('logger', ['type' => $level, 'message' => $message]);
    }

    public function renderView($view, $title, $layout = 'components.cf.layouts.app', $params = [])
    {
        $params = array_merge($params, ['title' => $title]);

        return view($view)->layout($layout, $params);
    }
}
