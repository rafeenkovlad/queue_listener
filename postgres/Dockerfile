FROM postgres:14.10-alpine

COPY ./start-pgbouncer.sh ./
#COPY ./pg_hba.conf /var/lib/postgresql/data/pg_hba.conf
#COPY ./cron/root ./etc/crontabs/

RUN apk add --no-cache pgbouncer && \
    chmod -R 777 /var/log/pgbouncer/ && \
    mkdir /run/pgbouncer/ && \
    chmod -R 777 /run/pgbouncer/ && \
    mkdir /var/lib/postgresql/data/pg_stat_tmp/ && \
    touch /var/lib/postgresql/data/pg_stat_tmp/global.stat && \
    chown postgres:root /var/lib/postgresql/data/pg_stat_tmp/global.stat && \
    chmod -R 777 /var/lib/postgresql/data/pg_stat_tmp/


#COPY init.sql /docker-entrypoint-initdb.d/

EXPOSE 6432