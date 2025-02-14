<?php

declare(strict_types=1);

namespace straininfo\server\configs;

use straininfo\server\shared\cron\IndexArgs;
use straininfo\server\shared\logger\LoggerArgs;
use straininfo\server\shared\mvvm\model\CacheArgs;
use straininfo\server\shared\mvvm\model\DBArgs;
use straininfo\server\shared\mvvm\model\ModelArgs;
use straininfo\server\shared\mvvm\view\StatArgs;
use straininfo\server\shared\mvvm\view\WebArgsBE;
use straininfo\server\shared\mvvm\view\WebArgsFE;

final class ConfigsCont
{
    /** @var ConfModel<string|int|bool> */
    private readonly ConfModel $model;

    /** @var ConfView<string|int|bool|array<string>> */
    private readonly ConfView $view;

    /** @var ConfGlobal<string|int|bool> */
    private readonly ConfGlobal $global;

    private readonly string $log_name;

    private static ?ConfigsCont $instance = null;

    private function __construct(string $log_name)
    {
        $this->view = new ConfView(check_conf_array_str(...));
        $this->global = new ConfGlobal(check_conf_main(...));
        $this->model = new ConfModel(check_conf_main(...));
        $this->log_name = $log_name;
    }

    public static function getConfigsCon(string $log_name): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($log_name);
        }
        return self::$instance;
    }

    public function getTimeZone(): \DateTimeZone
    {
        return $this->global->getService()->getTimeZone();
    }

    public function getCharSet(): string
    {
        return $this->global->getService()->getCharSet();
    }

    public function getLoggerArgs(): LoggerArgs
    {
        return new LoggerArgs(
            name: $this->global->getLogger()->getName() . $this->log_name,
            key: $this->global->getLogger()->getKey(),
            r_host: $this->global->getRedis()->getHost(),
            r_db: $this->global->getLogger()->getDB(),
            r_port: $this->global->getRedis()->getPort(),
            r_cap_size: $this->global->getLogger()->getCapSize(),
            level: $this->global->getLogger()->getLevel(),
            bubble: $this->global->getLogger()->getBubble()
        );
    }

    public function getDBArgs(): DBArgs
    {
        return new DBArgs(
            host: $this->model->getDatabase()->getHost(),
            db: $this->model->getDatabase()->getName(),
            user: $this->model->getDatabase()->getUser(),
            password: $this->model->getDatabase()->getPassword(),
            port: $this->model->getDatabase()->getPort(),
            charset: $this->global->getService()->getCharSet()
        );
    }

    public function getRedisArgs(): CacheArgs
    {
        return new CacheArgs(
            host: $this->global->getRedis()->getHost(),
            db: $this->model->getCache()->getName(),
            port: $this->global->getRedis()->getPort(),
            charset: $this->global->getService()->getCharSet(),
            expire_h: $this->model->getCache()->getExH(),
            tmp_h: $this->model->getCache()->getTmpH(),
            limit: $this->model->getCache()->getLimit()
        );
    }

    public function getIndexArgs(): IndexArgs
    {
        return new IndexArgs(
            host: $this->global->getRedis()->getHost(),
            db: $this->model->getIndex()->getName(),
            port: $this->global->getRedis()->getPort(),
            charset: $this->global->getService()->getCharSet(),
            key_len: $this->model->getIndex()->getKeyLen(),
            limit: $this->model->getIndex()->getLimit()
        );
    }

    public function getModelArgs(): ModelArgs
    {
        return new ModelArgs(
            time_zone: $this->getTimeZone(),
            maintenance: $this->global->getService()->getMaintenance()
        );
    }

    public function getWebArgsBE(): WebArgsBE
    {
        return new WebArgsBE(
            charset: $this->global->getService()->getCharSet(),
            cors: $this->view->getWebBE()->getCORS(),
            private: $this->view->getWebBE()->getPrivate(),
            protocol: $this->view->getWebBE()->getProtocol(),
            domain: $this->view->getWebBE()->getDomain(),
            port: $this->view->getWebBE()->getPort()
        );
    }

    public function getWebArgsFE(): WebArgsFE
    {
        return new WebArgsFE(
            protocol: $this->view->getWebFE()->getProtocol(),
            domain: $this->view->getWebFE()->getDomain(),
            port: $this->view->getWebFE()->getPort(),
            site: $this->view->getWebFE()->getSiteMap()
        );
    }

    public function getStatArgs(): StatArgs
    {
        return new StatArgs(
            enabled: $this->view->getStat()->getEnabled(),
            matomo: $this->view->getStat()->getMatomo(),
            id: $this->view->getStat()->getId(),
            token: $this->view->getStat()->getToken(),
            ignore: $this->view->getStat()->getIgnore()
        );
    }

    public function getVersion(): string
    {
        return $this->global->getService()->getVersion();
    }
}
