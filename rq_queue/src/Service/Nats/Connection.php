<?php

namespace App\RqQueue\Service\Nats;

use App\RqQueue\RouteLoader\RouteInterface;
use Basis\Nats\Configuration;
use Basis\Nats\Client;
use Basis\Nats\Message\Msg;
use Basis\Nats\Queue;
use Basis\Nats\Stream\RetentionPolicy;
use Basis\Nats\Stream\StorageBackend;
use Basis\Nats\Stream\Stream;

class Connection
{
    private static ?Connection $self = null;
    private Client $client;
    private RouteInterface $routeInterface;
    private Client|Queue $queue;
    private Stream $stream;

    static function init(RouteInterface $routeInterface): self
    {
        if (static::$self) {
            return static::$self;
        }

        static::$self = new self();
        static::$self->routeInterface = $routeInterface;

        $configuration = new Configuration([
            'host' => '192.162.0.7',
            'jwt' => null,
            'lang' => 'php',
            'pass' => null,
            'pedantic' => false,
            'port' => 4222,
            'reconnect' => true,
            'timeout' => 1,
            'token' => null,
            'user' => null,
            'nkey' => null,
            'verbose' => false,
            'version' => 'dev',
        ]);


        static::$self->client = new Client($configuration);


        return static::$self;
    }

    public function addJob(): self
    {
        $this->client->publish(
            $this->routeInterface->getStreamName(). $this->routeInterface->getTopicName(),
            $this->routeInterface->getJob());

        return $this;
    }

    public function addSubscribe(): self
    {
        $this->queue = $this->client->subscribe($this->routeInterface->getStreamName());

        return $this;
    }

    public function addConsumer(): self
    {
        $consumer = $this->stream->getConsumer('pull_consumer');

        $consumer->getConfiguration()
            ->setSubjectFilter(
                $this->routeInterface->getStreamName() . $this->routeInterface->getTopicName()
            );

        if(!$consumer->exists()) {
            $consumer->create();
        }

        $consumer->setBatching(50);

        $queue = $consumer->getQueue();

        /** @var Msg $msg */
        foreach ($queue->fetchAll() as $msg) {
            $msg->replyTo = 'null';
            @$msg->ack();
        }

//        var_dump($queue->fetch()->payload);
//        $consumer->getQueue()->next();

        return $this;

    }

    public function addStreamDefault(): self
    {
        $this->stream = $this->client
            ->getApi()
            ->getStream($this->routeInterface->getStreamName());
        $this->stream->getConfiguration()
            ->setRetentionPolicy(RetentionPolicy::LIMITS)
            ->setStorageBackend(StorageBackend::FILE)
            ->setSubjects(
                [$this->routeInterface->getStreamName() . $this->routeInterface->getTopicName()]
            );
        if(!$this->stream->exists()) {
            $this->stream->create();
        }

        return $this;
    }
}