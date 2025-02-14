<?php

declare(strict_types=1);

namespace straininfo\server\configs\elems;

use straininfo\server\shared\logger\LogLevE;

use function straininfo\server\shared\logger\parse_lle;

/** @template T */
final class ConfGlLogger
{
    private string $name;
    private string $key;
    private int $db;
    private int $cap_size;
    private LogLevE $level;
    private bool $bubble;

    /** @param array<string, T> $arr_arg */
    public function __construct(array $arr_arg)
    {
        $key_names = [
            'name' => $this->setName(...),
            'key' => $this->setKey(...),
            'db' => $this->setDB(...),
            'cap_size' => $this->setCapSize(...),
            'level' => $this->setLevel(...),
            'bubble' => $this->setBubble(...),
        ];
        set_conf_values($arr_arg, $key_names);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getDB(): int
    {
        return $this->db;
    }

    public function getCapSize(): int
    {
        return $this->cap_size;
    }

    public function getLevel(): LogLevE
    {
        return $this->level;
    }

    public function getBubble(): bool
    {
        return $this->bubble;
    }

    /** @param T|null $val */
    private function setName($val): bool
    {
        if (is_string($val)) {
            $this->name = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setKey($val): bool
    {
        if (is_string($val)) {
            $this->key = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setDB($val): bool
    {
        if (is_int($val)) {
            $this->db = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setCapSize($val): bool
    {
        if (is_int($val)) {
            $this->cap_size = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setLevel($val): bool
    {
        if (is_string($val)) {
            $this->level = parse_lle($val);
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setBubble($val): bool
    {
        if (is_bool($val)) {
            $this->bubble = $val;
            return true;
        }
        return false;
    }
}
