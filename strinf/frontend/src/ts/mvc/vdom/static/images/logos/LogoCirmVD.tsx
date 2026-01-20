// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/cirm.avif';

function LogoCirmVD(): JSX.Element {
    return <img loading="lazy" height="68" src={logoI} alt="CIRM-CFBP and CIRM-CF" />;
}

export default LogoCirmVD;
