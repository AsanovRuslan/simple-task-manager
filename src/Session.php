<?php


namespace BeeJee\App;


class Session
{
    private $have_flash = false;

    public function __construct()
    {
        $this->start();

        if ($this->isset('flash')) {
            $this->have_flash = true;
        }
    }

    public function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set($name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        return $_SESSION[$name] ?? null;
    }

    public function unset($name): void
    {
        unset($_SESSION[$name]);
    }

    public function isset($name): bool
    {
        return isset($_SESSION[$name]);
    }

    public function flash($name, $value)
    {
        $_SESSION['flash'][$name] = $value;
    }

    public function __destruct()
    {
        if ($this->have_flash) {
            $this->unset('flash');
        }
    }
}