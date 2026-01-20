// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/bccm_lmg.avif';

function LogoLmgVD(): JSX.Element {
    return <img loading="lazy" height="68" src={logoI} alt="BCCM/LMG" />;
}

export default LogoLmgVD;
