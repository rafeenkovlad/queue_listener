FROM golang:alpine3.20

ENTRYPOINT sh -c "cd /var/www/natsListener/cmd && go build && ./cmd  && tail -f /dev/null"

WORKDIR /var/www