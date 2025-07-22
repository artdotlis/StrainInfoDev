enum UIApiAnc {
    privacy = 'imp_privacy',
    license = 'imp_license',
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

    impPrivacy = '/imprint/#imp_privacy',

    impLicense = '/imprint/#imp_license',

    team = '/team',

    strReg = '/strainregistry',

    news = '/news',

    manual = '/doc',

    service = '/service',

    sitemap = '/sitemap_index.xml',
}

export { UIApiCon, UIApiAnc };
