<?php

namespace App\RqQueue\RouteLoader\Routes;

use App\RqQueue\RouteLoader\AbstractRoute;
use App\RqQueue\RouteLoader\RouteInterface;
use App\RqQueue\RouteLoader\RouteMap;
use App\RqQueue\Service\Validate\Validate;

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

    protected function validate(Validate $std): void
    {
        /** @var Validate $queue */
        $queue = $std->setPropertyValidate('queue')
            ->notBlank()
            ->isObject()
            ->getValue();

        $queue->setPropertyValidate('job1')
            ->notBlank()
            ->isArray();
        $queue->setPropertyValidate('job2')
            ->notBlank()
            ->isObject();
        $queue->setPropertyValidate('job3')
            ->notBlank()
            ->isString();
    }

    protected function topicName(): void
    {
        $this->topicName = RouteMap::topicName(RouteMap::QUEUE);
    }
}