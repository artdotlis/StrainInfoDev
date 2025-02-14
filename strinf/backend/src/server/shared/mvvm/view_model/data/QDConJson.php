<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\data;

final class QDConJson
{
    private readonly bool $found;

    private string $json;

    private int $cnt;

    public function __construct(bool $found, string $json)
    {
        $this->found = $found;
        $this->json = $json;
        $this->cnt = 0;
    }

    public function isBuffered(): bool
    {
        return $this->found;
    }

    public function setJson(string $json): void
    {
        $this->json = $json;
    }

    public function getJson(): string
    {
        return $this->json;
    }

    public function getCnt(): int
    {
        return $this->cnt;
    }

    public function setCnt(int $cnt): void
    {
        $this->cnt = $cnt;
    }
}
