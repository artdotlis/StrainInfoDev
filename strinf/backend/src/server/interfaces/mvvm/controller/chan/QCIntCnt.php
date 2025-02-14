<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller\chan;

interface QCIntCnt
{
    public function getStrainCount(): string;

    public function getArchiveCount(): string;

    public function getTypeStrainCount(): string;

    public function getTypeCultureCount(): string;

    public function getCultureCount(): string;

    public function getSpeciesCount(): string;

    public function getDesignationCount(): string;
}
