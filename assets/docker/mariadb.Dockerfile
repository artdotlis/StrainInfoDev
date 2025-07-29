FROM docker.io/mariadb:lts

ARG USER_GID=1000

COPY ./bin/db/mariadb.sh /entry.sh

RUN groupmod --gid ${USER_GID} mysql 

ENTRYPOINT [ "/bin/sh", "/entry.sh" ]