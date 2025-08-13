const UNIQUE_DES = /^(\D*)(\d+(?:\D\d+)*)(\D*)$/;
const CL_CORE = /^\D+|\D+$/g;
const SINGLE_WORD_CHAR = /^[A-Za-z0-9]$/;
const STR_DEFINED_SEP = ':' as const;

export { UNIQUE_DES, CL_CORE, SINGLE_WORD_CHAR, STR_DEFINED_SEP };
