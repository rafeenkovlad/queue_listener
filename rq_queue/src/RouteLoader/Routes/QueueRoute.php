<?php

namespace App\RqQueue\RouteLoader\Routes;

use App\RqQueue\Exception\ApiException;
use App\RqQueue\RouteLoader\AbstractRoute;
use App\RqQueue\RouteLoader\RouteInterface;
use App\RqQueue\RouteLoader\RouteMap;

class QueueRoute extends AbstractRoute implements RouteInterface
{

    protected function routePath(): void
    {
        $this->routePath = RouteMap::QUEUE;
    }

    protected function bodyJson(string $json): void
    {
        $this->bodyJson = $json;
    }

    protected function streamName(): void
    {
        $this->streamName = RouteMap::streamName(RouteMap::QUEUE);
    }

    protected function validate(\stdClass $std): void
    {
        $std->queue ?? throw ApiException::custom('parameter queue will be not empty', 400);
    }

    protected function topicName(): void
    {
        $this->topicName = RouteMap::topicName(RouteMap::QUEUE);
    }
}