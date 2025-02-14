enum QApiCon {
    cntStr = '/v2/count/strains',

    cntCul = '/v2/count/deposits',

    cntTStr = '/v2/count/strains/type',

    cntArc = '/v2/count/archive',

    cntTCul = '/v2/count/deposits/strainregistry',

    cntSpe = '/v2/count/species',

    cntDes = '/v2/count/designations',

    disCpsCnt = '/service/stat/dps_cnt',

    strMin = '/v2/data/strain/min/',

    strMax = '/v2/data/strain/max/',

    strAvg = '/v2/data/strain/avg/',

    culMin = '/v2/data/deposit/min/',

    culAvg = '/v2/data/deposit/avg/',

    culMax = '/v2/data/deposit/max/',

    seaCulStrId = '/v2/search/deposit/si_id/',

    seaStrCulId = '/v2/search/strain/si_dp/',

    seaStrSeqAcc = '/v2/search/strain/seq_acc/',

    seaCulSeqAcc = '/v2/search/deposit/seq_acc/',

    seaStrTaxName = '/v2/search/strain/tax_name/',

    seaCulTaxName = '/v2/search/deposit/tax_name/',

    seaStrStrNo = '/v2/search/strain/cc_no/',

    seaCulStrNo = '/v2/search/deposit/cc_no/',

    seaStrBrc = '/v2/search/strain/cc/',

    seaCulBrc = '/v2/search/deposit/cc/',

    seaStrStrDes = '/v2/search/strain/des/',

    seaCulStrDes = '/v2/search/deposit/des/',

    arcStrSiId = '/service/archive/strain/si_id/',

    seaKeyInd = '/service/search/index/',

    allStrIds = '/service/all/strains',

    seaStrIds = '/service/search/strain/si_id/',

    seaStrAll = '/service/search/strain/all/',
}

export default QApiCon;
