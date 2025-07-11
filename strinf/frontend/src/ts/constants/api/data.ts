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

export { StrainStatus, DepositStatus };
