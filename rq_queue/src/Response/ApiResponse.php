<?php

namespace App\RqQueue\Response;

class ApiResponse
{
    public static function jsonException(\Exception $e)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, PUT, PATCH');
        header('Content-Type: application/json', true, $e->getCode());
        echo json_encode([
            'message' => $e->getMessage(),
        ]);
    }

    public static function jsonApiResponse(\GuzzleHttp\Psr7\Response $response)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, PUT, PATCH');
        header('Content-Type: application/json', true, $response->getStatusCode());
        echo $response->getBody()->getContents();
    }
}