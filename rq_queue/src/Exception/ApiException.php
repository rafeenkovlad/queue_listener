<?php

namespace App\RqQueue\Exception;

class ApiException extends \Exception
{
    public static function custom(string $message, int $code): static
    {
        return new static($message, $code);
    }

    public static function unauthorized(): static
    {
        return new static("Unauthorized", 401);
    }

    public static function serverNotResponse(): static
    {
        return new static("Server is not response", 404);
    }

    public static function natsNotWorking(): static
    {
        return new static("Nats server not is work", 404);
    }

    public static function routeNotFound(): static
    {
        return new static("Route not found", 404);
    }

    public static function tokenNotFound(): static
    {
        return new static("Token not found", 403);
    }
}