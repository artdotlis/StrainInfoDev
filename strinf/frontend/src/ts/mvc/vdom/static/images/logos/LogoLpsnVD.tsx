// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/lpsn.avif';

import linkSty from '@strinf/css/mods/link.module.css';

function LogoLpsnVD({ height }: { height?: string }): JSX.Element {
    const heightI = typeof height === 'string' ? height : '22';
    const width = 1.45 * Number.parseInt(heightI, 10);
    return (
        <img
            loading="lazy"
            className={linkSty.logo}
            src={logoI}
            alt="LPSN"
            width={`${width}`}
            height={heightI}
        />
    );
}

export default LogoLpsnVD;
