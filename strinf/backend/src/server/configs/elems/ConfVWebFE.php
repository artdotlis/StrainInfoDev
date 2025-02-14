<?php

declare(strict_types=1);

namespace straininfo\server\configs\elems;

/** @template T */
final class ConfVWebFE
{
    /** @var "https" | "http" */
    private mixed $protocol;

    private string $domain;

    private int $port;

    private string $site;

    /** @param array<string, T> $arr_arg */
    public function __construct(array $arr_arg)
    {
        $key_names = [
            'protocol' => $this->setProtocol(...),
            'domain' => $this->setDomain(...),
            'port' => $this->setPort(...),
            'sitemap' => $this->setSiteMap(...),
        ];
        set_conf_values($arr_arg, $key_names);
    }

    /** @return "https" | "http" */
    public function getProtocol(): mixed
    {
        return $this->protocol;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getSiteMap(): string
    {
        return $this->site;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    /** @param T|null $val */
    private function setDomain($val): bool
    {
        if (is_string($val)) {
            $this->domain = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setProtocol($val): bool
    {
        if (is_string($val) && in_array("{$val}", ['https', 'http'])) {
            /** @var "https" | "http" $val */
            $this->protocol = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setSiteMap($val): bool
    {
        if (is_string($val)) {
            $this->site = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setPort($val): bool
    {
        if (is_int($val) && $val > 0) {
            $this->port = $val;
            return true;
        }
        return false;
    }
}
