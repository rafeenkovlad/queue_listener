<?php

namespace App\Response;

class Response
{
    public static function htmlResponse($response): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, PUT, PATCH');
        header('Content-Type: text/html; charset=utf-8');
        echo $response;
    }

    public static function cssResponse($response): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, PUT, PATCH');
        header('Content-Type: text/css; charset=utf-8');
        echo $response;
    }

    public static function jsResponse($response): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, PUT, PATCH');
        header('Content-Type: application/javascript; charset=utf-8');
        echo $response;
    }
}