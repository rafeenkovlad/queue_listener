#!/usr/bin/env bash
echo "Запуск pgbouncer"
pgbouncer /etc/pgbouncer/pgbouncer.ini -u pgbouncer & sleep 10 && echo 'pgbouncer is started' || echo 'pgbouncer failed to start'
