<?php

namespace App\Helpers;

use View;
use Session;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class Messages
{
    protected static $view;

    protected static $messages;

    public function __construct($view = null)
    {
        if (is_null($view)) {
            $view = 'messages';
        }
        static::$view = $view;
    }

    /**
     * Get messages from session.
     *
     * Session vars used : success, info, warning, errors, error
     *
     * @return obj Object with the messages by type
     */
    public static function get()
    {
        if (! is_null(static::$messages)) {
            return static::$messages;
        }
        static::$messages          = new \stdClass();
        static::$messages->success = Session::get('success');
        static::$messages->info    = Session::get('info');
        static::$messages->warning = Session::get('warning');
        static::$messages->danger  = Session::get('error');

        return static::$messages;
    }

    /**
     * Renderer of the messages.
     */
    public function __call($name, $arguments)
    {
        if ($name == 'render' && count($arguments) == 0) {
            return View::make(static::$view, ['messages' => static::get()])->render();
        } elseif ($name == 'render' && count($arguments) == 1) {
            return View::make($arguments[0], ['messages' => static::get()])->render();
        }
    }

    /**
     * Static renderer of the messages.
     */
    public static function __callStatic($name, $arguments)
    {
        if (is_null(static::$view)) {
            static::$view = 'messages';
        }

        if ($name == 'render' && count($arguments) == 0) {
            return View::make(static::$view, ['messages' => static::get()])->render();
        } elseif ($name == 'render' && count($arguments) == 1) {
            return View::make($arguments[0], ['messages' => static::get()])->render();
        }
    }
}
