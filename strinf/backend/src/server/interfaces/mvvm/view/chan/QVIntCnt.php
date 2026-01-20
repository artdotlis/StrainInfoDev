<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view\chan;

interface QVIntCnt
{
    public function getStrainCount(): string;

    public function getArchiveCount(): string;

    public function getTypeCultureCount(): string;

    public function getTypeStrainCount(): string;

    public function getCultureCount(): string;

    public function getSpeciesCount(): string;

    public function getDesignationCount(): string;
}
