<?php

namespace App\RqQueue\Config\Env;

use Symfony\Component\Dotenv\Dotenv;

class Env
{
    private function __construct()
    {

    }

    public static function init(): void
    {
        $dotenv = new Dotenv();
        $dotenv->load('../.env');
    }
}