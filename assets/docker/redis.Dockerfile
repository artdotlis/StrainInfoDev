FROM docker.io/redis:alpine

ARG USER_GID=1000

COPY ./configs/stage/redis.conf /redis.conf
COPY ./bin/db/redis.sh /entry.sh

RUN apk --no-cache add shadow && groupmod --gid ${USER_GID} redis && apk del shadow
RUN mkdir /socket && chown redis:redis /socket

USER redis

CMD [ "/bin/sh", "/entry.sh" ]