// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

enum UIApiAnc {
    privacy = 'privacy',
    license = 'license',
    cite = 'cite',
}

enum UIApiCon {
    search = '/search',

    pass = '/pass', // alias for search with qapi

    strain = '/strain/',

    index = '/',

    indexFull = '/index.html',

    about = '/about',

    contact = '/contact',

    imprint = '/imprint',

    impPrivacy = '/imprint/#privacy',

    impLicense = '/imprint/#license',

    impCite = '/imprint/#cite',

    team = '/team',

    strReg = '/strainregistry',

    news = '/news',

    manual = '/doc',

    service = '/service',

    sitemap = '/sitemap_index.xml',
}

export { UIApiAnc, UIApiCon };
