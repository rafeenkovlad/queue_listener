package main

import (
	"fmt"
	"natsListener/pkg/nats"
	"natsListener/pkg/response"
	"os"
	//"sync"
)

func main() {
	fmt.Println("connect nats server.")
	nats.Connect()
	fmt.Println("connected.")
	pid := os.Getpid()
	fmt.Println("PID основного процесса:", pid)
	data := response.GetChanData()
	nats.CheckStreamIsNotReadMessage("queue", "").AddSymfonyListen(data)
	nats.CheckStreamIsNotReadMessage("notify", "").AddSymfonyListen(data)
	nats.Listen(data)
}
