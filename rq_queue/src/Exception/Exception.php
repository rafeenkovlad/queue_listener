<?php

namespace App\RqQueue\Exception;

class Exception extends \Exception
{
    public static function emptyLogin(): static
    {
        return new static("login is empty", 403);
    }

    public static function emptyPassword(): static
    {
        return new static("password is empty", 403);
    }

    public static function routeNotFound(): static
    {
        return new static("route not found", 404);
    }

    public static function pageNotFound(): static
    {
        return new static("page not found", 404);
    }

    public static function fileNotFound(): static
    {
        return new static("file not found", 404);
    }

    public static function сontentTypeNotSupported(): static
    {
        return new static("not supported content", 403);
    }
}