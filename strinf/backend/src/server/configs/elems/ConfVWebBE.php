<?php

declare(strict_types=1);

namespace straininfo\server\configs\elems;

/** @template T */
final class ConfVWebBE
{
    /** @var array<string> */
    private array $cors;

    /** @var array<string> */
    private array $private;

    /** @var "https" | "http" */
    private mixed $protocol;

    private string $domain;

    private int $port;

    /** @param array<string, T> $arr_arg */
    public function __construct(array $arr_arg)
    {
        $key_names = [
            'cors' => $this->setCORS(...),
            'private' => $this->setPrivate(...),
            'protocol' => $this->setProtocol(...),
            'domain' => $this->setDomain(...),
            'port' => $this->setPort(...),
        ];
        set_conf_values($arr_arg, $key_names);
    }

    /** @return array<string> */
    public function getCORS(): array
    {
        return $this->cors;
    }

    /** @return array<string> */
    public function getPrivate(): array
    {
        return $this->private;
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

    public function getPort(): int
    {
        return $this->port;
    }

    /** @param T|null $val */
    private function setCORS($val): bool
    {
        if (is_array($val)) {
            foreach ($val as $ele) {
                if (!is_string($ele)) {
                    return false;
                }
            }
            /** @var array<string> $val */
            $this->cors = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setPrivate($val): bool
    {
        if (is_array($val)) {
            foreach ($val as $ele) {
                if (!is_string($ele)) {
                    return false;
                }
            }
            /** @var array<string> $val */
            $this->private = $val;
            return true;
        }
        return false;
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
    private function setPort($val): bool
    {
        if (is_int($val) && $val > 0) {
            $this->port = $val;
            return true;
        }
        return false;
    }
}
