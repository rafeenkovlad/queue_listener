FROM nats:2.9.25-alpine

# entrypoint
COPY docker-entrypoint.sh "/usr/local/bin/"
COPY nats-server.conf "/etc/nats/"
COPY nats "/"

RUN apk add curl && \
    mkdir "/storage" && \
    chmod -R 777 "/storage"
