FROM docker.io/rockylinux:9 AS appbuilder

ARG BIN_DEPLOY
ARG FIX_CONFIG
ARG STAGE

COPY . /tmp/app

WORKDIR /tmp/app

RUN mkdir -p "${HOME}/.local/bin" && CGO_ENABLED=0 bash "./${BIN_DEPLOY}"

FROM docker.io/alpine:3.19

ARG BIN_DEPLOY_REQ_NGINX
ARG BIN_DEPLOY_ADD_CRON
ARG DOCKER_ENV_BE
ARG DOCKER_ENV_DIR
ARG SERVER_WEB_CONFS_DIR
ARG SERVER_PHP_CONFS_DIR
ENV DOCKER_ENV_BE=${DOCKER_ENV_BE}

RUN apk --no-cache update && apk add --upgrade apk-tools bash && apk upgrade --available
RUN apk --no-cache add nginx nginx-mod-http-set-misc 

COPY "./${BIN_DEPLOY_REQ_NGINX}" /req.nginx.sh
COPY "./${BIN_DEPLOY_ADD_CRON}" /add_cron.sh

RUN sh /req.nginx.sh && rm /req.nginx.sh

RUN mkdir -p /run/php-fpm/ && chown nginx:nginx /run/php-fpm

RUN rm -rf /etc/nginx/http.d/* || true 
RUN rm -rf /etc/php82/php-fpm.d/* || true 
RUN mkdir -p /etc/nginx/http.d && mkdir -p /etc/php82/php-fpm.d

COPY --from=appbuilder $SERVER_WEB_CONFS_DIR/* /etc/nginx/http.d/
COPY --from=appbuilder $SERVER_PHP_CONFS_DIR/* /etc/php82/php-fpm.d/

COPY --from=appbuilder /entry.sh  /entry.sh
COPY --from=appbuilder $DOCKER_ENV_DIR/* $DOCKER_ENV_DIR/

RUN sh /add_cron.sh && rm /add_cron.sh

WORKDIR /var/www/

RUN rm -rf /var/www/*

COPY --from=appbuilder /var/www/ ./

RUN chown -R nginx:nginx /var/www/

HEALTHCHECK --interval=5m --timeout=3s CMD /health.sh

ENTRYPOINT ["/bin/sh", "/entry.sh"]