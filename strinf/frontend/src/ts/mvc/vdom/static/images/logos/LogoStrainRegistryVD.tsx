// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logoI from '@assets/logo/streg.avif';

function LogoStrainRegistryVD(): JSX.Element {
    return (
        <img loading="lazy" height="111" width="700" src={logoI} alt="StrainRegistry" />
    );
}
export default LogoStrainRegistryVD;
