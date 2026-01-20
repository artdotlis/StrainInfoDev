// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/comp.avif';

function LogoDsmzVD(): JSX.Element {
    return <img loading="lazy" height="100" src={logoI} alt="DSMZ" />;
}

export default LogoDsmzVD;
