// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

const reNames = new Intl.DisplayNames(['en'], { type: 'region' });

function parseCountryCode(code: string): string {
    try {
        return reNames.of(code) ?? code;
    } catch {
        return code;
    }
}

export default parseCountryCode;
