FROM docker.io/mariadb:lts

ARG USER_GID=1000

COPY ./bin/db/mariadb.sh /entry.sh

RUN apt-get update && apt-get install -y jq && rm -rf /var/lib/apt/lists/*

RUN groupmod --gid ${USER_GID} mysql 

ENTRYPOINT [ "/bin/sh", "/entry.sh" ]