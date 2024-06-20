package nats

import (
	"github.com/nats-io/nats.go"
	"natsListener/pkg/nats/listener"
	"natsListener/pkg/response"
)

var js nats.JetStreamContext

func Connect() {
	DefaultURL := "nats://srv_nats:4222"
	nc, _ := nats.Connect(DefaultURL)
	js, _ = nc.JetStream()
}

func CheckStreamIsNotReadMessage(streamName, topicName string) listener.Listener {
	consumer := &nats.ConsumerConfig{Name: streamName + topicName + "_pull_consumer"}
	js.AddConsumer(streamName, consumer)
	consumerInfo, _ := js.ConsumerInfo(streamName, streamName+topicName+"_pull_consumer")

	//if consumerInfo == nil {
	//	return false
	//}
	return listener.Listener{StreamName: streamName, TopicName: topicName, ConsumerInfo: consumerInfo}

	//return consumerInfo.NumPending > 0
}

func Listen(data chan response.Response) {
	listener.GoSymfonyListen(data)
}
