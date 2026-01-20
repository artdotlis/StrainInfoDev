// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import * as pl_mdx from 'eslint-plugin-mdx';

export default [
    {
        ...pl_mdx.flat,
        files: ['src/**/*.mdx'],
        processor: pl_mdx.createRemarkProcessor({
            lintCodeBlocks: true,
            languageMapper: {},
        }),
        rules: {
            ...pl_mdx.flat.rules,
            'no-unused-expressions': 'warn',
        },
    },
    {
        ...pl_mdx.flatCodeBlocks,
        files: ['src/**/*.mdx'],
        rules: {
            ...pl_mdx.flatCodeBlocks.rules,
            'no-var': 'error',
            'prefer-const': 'error',
        },
    },
];
