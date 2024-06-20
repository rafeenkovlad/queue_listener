<?php

namespace App\RqQueue\RouteLoader;

class RouteMap
{
    public const QUEUE = '/queue';
    public const NOTIFY = '/notify';
    private static array $streamNames = [
        self::QUEUE => 'queue',
        self::NOTIFY => 'notify',
    ];
    private static array $topicNames = [
        self::QUEUE => '',
        self::NOTIFY => '',
    ];

    public static function streamName(string $name): string
    {
        return static::$streamNames[$name];
    }

    public static function topicName(string $name): string
    {
        return static::$topicNames[$name];
    }
}