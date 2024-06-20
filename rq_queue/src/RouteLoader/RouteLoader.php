<?php

namespace App\RqQueue\RouteLoader;

use App\RqQueue\Exception\ApiException;
use App\RqQueue\RouteLoader\Routes\NotifyRoute;
use App\RqQueue\RouteLoader\Routes\QueueRoute;
use Symfony\Component\HttpFoundation\Request;

class RouteLoader
{

    private static self $routeLoader;

    private RouteInterface $routeInterface;

    private static function requestLoader(): Request
    {
        return Request::createFromGlobals();
    }

    private static function getRouteInterface(string $routeInterface): RouteInterface
    {
        return new $routeInterface;
    }

    private static function routeMap(): array
    {
        return [
            RouteMap::QUEUE => QueueRoute::class,
            RouteMap::NOTIFY => NotifyRoute::class,
        ];
    }

    /**
     * @throws ApiException
     */
    public static function init(): void
    {
        self::$routeLoader = new self();
        $request = self::requestLoader();
        $routeMap =  self::routeMap();
        self::$routeLoader->routeInterface = self::getRouteInterface(
            $routeMap[$request->getRequestUri()] ?? throw ApiException::routeNotFound()
        );
        self::$routeLoader->routeInterface->setJob(
            $request->getContent(),
            $request->server->get('HTTP_AUTHORIZATION') ?? throw ApiException::tokenNotFound()
        );
    }

    public static function routeInterface(): RouteInterface
    {
        return self::$routeLoader->routeInterface;
    }
}