<?php

namespace App\RqQueue\RouteLoader\Routes;

use App\RqQueue\RouteLoader\AbstractRoute;
use App\RqQueue\RouteLoader\RouteInterface;
use App\RqQueue\RouteLoader\RouteMap;

class NotifyRoute extends AbstractRoute implements RouteInterface
{

    protected function routePath(): void
    {
        $this->routePath = RouteMap::NOTIFY;
    }

    protected function bodyJson(string $json): void
    {
        $this->bodyJson = $json;
    }

    protected function streamName(): void
    {
        $this->streamName = RouteMap::streamName(RouteMap::NOTIFY);;
    }

    protected function validate(\stdClass $std): void
    {
        // TODO: Implement validateJson() method.
    }

    protected function topicName(): void
    {
        $this->topicName = RouteMap::topicName(RouteMap::NOTIFY);
    }
}