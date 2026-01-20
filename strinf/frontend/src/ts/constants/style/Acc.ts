// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

enum IDC {
    menu = 'accessibility-menu',

    sCon = 'set-contrast',

    sMot = 'set-transitions',

    sDys = 'set-dyslexia',
}

enum Cookie {
    dyslexia = 'D3-accessibility-dyslexia',

    contrast = 'D3-accessibility-contrast',

    transitions = 'D3-accessibility-transitions',
}

enum CookieValue {
    dyslexia = 'dyslexia',

    contrast = 'high-contrast',

    transitions = 'without-transitions',
}

enum FormNames {
    dys = 'accessibility[dyslexia]',
    tra = 'accessibility[transitions]',
    con = 'accessibility[contrast]',
}

export { Cookie, CookieValue, FormNames, IDC };
