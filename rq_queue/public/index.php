<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\RqQueue\Response\ApiResponse;
use App\RqQueue\RouteLoader\RouteLoader;
use App\RqQueue\Service\Nats\Connection;

try {
    RouteLoader::init();
    Connection::init(RouteLoader::routeInterface())
        ->addStreamDefault()
        ->addJob();
//        ->addConsumer();
    //Auth::run();
}catch (Exception $e) {
    ApiResponse::jsonException($e);
}





