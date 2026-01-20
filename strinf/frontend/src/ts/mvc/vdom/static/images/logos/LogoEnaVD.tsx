// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/ena.avif';
import logoIFull from '@extra/straininfo/logos/ena_full.avif';
import linkSty from '@strinf/css/mods/link.module.css';

function LogoEnaVD({ full, height }: { full?: boolean; height?: string }): JSX.Element {
    const srcI = full === true ? logoIFull : logoI;
    const heightI = typeof height === 'string' ? height : '22';
    const width = (full === true ? 3.59 : 0.81) * Number.parseInt(heightI, 10);
    return (
        <img
            loading="lazy"
            className={linkSty.logo}
            src={srcI}
            alt="ENA"
            height={heightI}
            width={`${width}`}
        />
    );
}

export default LogoEnaVD;
