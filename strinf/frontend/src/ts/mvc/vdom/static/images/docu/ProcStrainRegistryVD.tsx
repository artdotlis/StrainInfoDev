// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';

const Prog = new URL('@assets/dia/streg_proc.avif', import.meta.url).pathname;

function ProcStrainRegistryVD(): JSX.Element {
    return (
        <img
            loading="lazy"
            width="560"
            src={Prog}
            alt="StrainRegistry registrationprocedure"
        />
    );
}
export default ProcStrainRegistryVD;
