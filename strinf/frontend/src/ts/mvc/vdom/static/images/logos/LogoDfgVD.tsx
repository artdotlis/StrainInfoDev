// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/dfg.avif';

function LogoDfgVD(): JSX.Element {
    return <img loading="lazy" width="260" src={logoI} alt="DFG" />;
}

export default LogoDfgVD;
