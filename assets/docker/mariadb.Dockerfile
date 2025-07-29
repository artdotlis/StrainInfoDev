FROM docker.io/mariadb:latest

ARG USER_GID=1000

RUN groupmod --gid ${USER_GID} mysql 
USER mysql

CMD [ "mariadbd" ]