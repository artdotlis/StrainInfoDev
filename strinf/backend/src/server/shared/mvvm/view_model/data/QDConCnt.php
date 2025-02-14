<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\data;

final class QDConCnt
{
    private readonly bool $found;
    private int $cnt;
    private string $json;

    public function __construct(bool $found, int $cnt)
    {
        $this->found = $found;
        $this->cnt = $cnt;
    }

    public function isBuffered(): bool
    {
        return $this->found;
    }

    public function getCnt(): int
    {
        return $this->cnt;
    }

    public function setToBuf(int $cnt): void
    {
        $this->cnt = $cnt;
    }

    public function setJson(string $json): void
    {
        $this->json = $json;
    }

    public function getJson(): string
    {
        return $this->json;
    }
}
