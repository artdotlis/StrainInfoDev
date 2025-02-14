<?php

declare(strict_types=1);

namespace straininfo\server\configs\elems;

/** @template T */
final class ConfGlService
{
    private \DateTimeZone $timezone;
    private string $charset;
    private int $maintenance;
    private string $version;

    /** @param array<string, T> $arr_arg */
    public function __construct(array $arr_arg)
    {
        $key_names = [
            'timezone' => $this->setTimeZone(...),
            'charset' => $this->setCharSet(...),
            'maintenance' => $this->setMaintenance(...),
            'version' => $this->setVersion(...),
        ];
        set_conf_values($arr_arg, $key_names);
    }

    public function getTimeZone(): \DateTimeZone
    {
        return $this->timezone;
    }

    public function getCharSet(): string
    {
        return $this->charset;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getMaintenance(): int
    {
        return $this->maintenance;
    }

    /** @param T|null $val */
    private function setTimeZone($val): bool
    {
        if (is_string($val) && in_array($val, timezone_identifiers_list())) {
            $this->timezone = new \DateTimeZone($val);
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setCharSet($val): bool
    {
        if (is_string($val) && in_array($val, mb_list_encodings())) {
            $this->charset = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setVersion($val): bool
    {
        if (is_string($val) && $val !== '') {
            $this->version = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setMaintenance($val): bool
    {
        if (is_int($val)) {
            $this->maintenance = $val;
            return true;
        }
        return false;
    }
}
