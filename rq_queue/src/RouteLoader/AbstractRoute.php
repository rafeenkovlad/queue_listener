<?php

namespace App\RqQueue\RouteLoader;

use App\RqQueue\Exception\ApiException;
use App\RqQueue\Service\Validate\Validate;

abstract class AbstractRoute
{

    protected string $routePath;

    protected string $streamName;

    protected string $bodyJson;

    protected string $topicName;

    protected string $token;

    abstract protected function routePath(): void;

    public function getRoutePath(): string
    {
        static::routePath();

        return $this->routePath;
    }

    abstract protected function streamName(): void;

    public function getStreamName(): string
    {
        static::streamName();

        return $this->streamName;
    }

    abstract protected function topicName(): void;

    public function getTopicName(): string
    {
        static::topicName();

        return $this->topicName;
    }

    abstract protected function bodyJson(string $json): void;

    /**
     * @throws ApiException
     */
    abstract protected function validate(Validate $std): void;

    /**
     * @param string $json
     * @param string $token
     * @return void
     * @throws ApiException
     */
    public function setJob(string $json, string $token): void
    {
        $std = json_decode($json, false);
        $std = new Validate($std);
//        var_dump($std);
        static::validate($std);
        static::bodyJson($json);
        $this->token = $token;
    }

    public function getJob(): string
    {
        $this->bodyJson[-1] = ',';
        $this->bodyJson .= ' "token": "' . $this->token .'"}';

        return $this->bodyJson;
    }
}