const SEQ_ACC = [
    // Nucleotide
    '[A-Z]\\d{5}|[A-Z]{2}\\d{6}|[A-Z]{2}\\d{8}',
    // WGS
    '[A-Z]{4}\\d{8,}|[A-Z]{6}\\d{9,}',
    // MGA
    '[A-Z]{5}\\d{7}',
    // RefSeq - dna/rna only - TODO how many numbers ?
    '(?:AC_|NC_|NG_|NT_|NW_|NZ_|NM_|NR_|XM_|XR_)\\d+',
    // GENBANK + REFSEQ assemblies
    '(?:GCA_|GCF_)\\d+',
];

const DB_ACC_REG = {
    nucleotide: /[A-Z]\d{5}|[A-Z]{2}\d{6}|[A-Z]{2}\d{8}/,
    assembly: /GCA_\d+/,
};

export { SEQ_ACC, DB_ACC_REG };
