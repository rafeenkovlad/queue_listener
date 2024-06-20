<?php

namespace App\RqQueue\RouteLoader;

interface RouteInterface
{
    public function getRoutePath(): string;

    public function getStreamName(): string;

    public function getTopicName(): string;

    public function setJob(string $json, string $token): void;

    public function getJob(): string;
}