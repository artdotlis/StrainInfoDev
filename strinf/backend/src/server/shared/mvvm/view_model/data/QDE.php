<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\data;

enum QDE: string
{
    case MIN = 'data_min';
    case AVG = 'data_avg';
    case MAX = 'data_max';
    case MIC = 'data_mic';
    case MIC_IND = 'data_mic_ind';
}
