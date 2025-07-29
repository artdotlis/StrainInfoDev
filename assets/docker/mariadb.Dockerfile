FROM docker.io/mariadb:latest

ARG USER_GID=1000

COPY ./bin/db/mariadb.sh /entry.sh

RUN groupmod --gid ${USER_GID} mysql 

USER mysql

CMD [ "/bin/sh", "/entry.sh" ]