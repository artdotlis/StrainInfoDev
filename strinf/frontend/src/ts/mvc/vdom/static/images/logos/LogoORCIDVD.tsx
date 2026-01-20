// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/orcid.avif';
import linkSty from '@strinf/css/mods/link.module.css';

function LogoORCIDVD({ height }: { height?: string }): JSX.Element {
    const heightI = typeof height === 'string' ? height : '22';
    return (
        <img
            loading="lazy"
            className={linkSty.logo}
            src={logoI}
            alt="ORCID"
            width={heightI}
            height={heightI}
        />
    );
}

export default LogoORCIDVD;
