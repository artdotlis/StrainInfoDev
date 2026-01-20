// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';

const GrAb = new URL('@assets/dia/gr_ab.avif', import.meta.url).pathname;

function AboutIluVD(): JSX.Element {
    /** not loading="lazy" because of cls */
    return <img height="535" src={GrAb} alt="Background" />;
}

export default AboutIluVD;
