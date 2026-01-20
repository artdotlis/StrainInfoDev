// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

const UNIQUE_DES = /^(\D*)(\d+(?:\D\d+)*)(\D*)$/;
const CL_CORE = /^\D+|\D+$/g;
const SINGLE_WORD_CHAR = /^[A-Z0-9]$/i;
const STR_DEFINED_SEP = ':' as const;

export { CL_CORE, SINGLE_WORD_CHAR, STR_DEFINED_SEP, UNIQUE_DES };
