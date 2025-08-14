enum StrainStatus {
    pubOn = 'published online',
    err = 'erroneous',
    pubOff = 'published offline',
    dep = 'deposition',
}

enum DepositStatus {
    pri = 'private',
    dead = 'dead',
    unk = 'unknown',
    ava = 'available',
    err = 'erroneous data',
}

enum DataSource {
    web_s = 'scraped from brc website',
    web_f = 'found on brc website',
    brc = 'provided by brc',
    edb = 'external database',
    reg = 'registration',
    str_a = 'straininfo archive',
}

enum SeqType {
    gene = 'gene',
    genome = 'genome',
    rop = 'rrnaop',
    pat = 'patent',
}

enum AssemblyLvl {
    com = 'complete',
    chr = 'chromosome',
    sca = 'scaffold',
    con = 'contig',
}

export { AssemblyLvl, DataSource, DepositStatus, SeqType, StrainStatus };
