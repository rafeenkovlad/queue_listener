package listener

import (
	"github.com/fatih/color"
	"github.com/nats-io/nats.go"
	"natsListener/pkg/response"
	"net/http"
	"time"
)

var httpRoute map[string]string

type Listener struct {
	StreamName   string
	TopicName    string
	ConsumerInfo *nats.ConsumerInfo
}

func init() {
	httpRoute = map[string]string{
		"queue":  "http://srv_nginx:8080/api/nats/subscribe/queue/run",
		"notify": "http://srv_nginx:8080/api/nats/subscribe/notify/run",
	}
}

func (c Listener) AddSymfonyListen(data chan response.Response) {
	go c.run(httpRoute[c.StreamName], data)
}

func (c Listener) run(route string, data chan response.Response) {
	for {
		resp := response.Response{}
		resp.Value, resp.Err = http.Post(route, "", nil)
		data <- resp
		time.Sleep(5 * time.Second)
	}
}

func GoSymfonyListen(data chan response.Response) {
	for resp := range data {
		if resp.Value != nil {
			color.Green("Received response: %s", resp.Value)
		}
		if resp.Err != nil {
			color.Red("Received error response: %v", resp.Err)
		}
	}
}
