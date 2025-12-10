export default {
    entry: ['src/index.tsx'],
    project: ['**/*.{js,cjs,mjs,jsx,ts,cts,mts,tsx,mdx,md}'],
    ignore: ['configs/**', 'assets/**', 'src/**/worker*.ts'],
    ignoreDependencies: [
        '@mdx-js/mdx',
        /^typescript-plugin.+/,
        /^@?eslint.*/,
        '@antfu/eslint-config',
        '@typescript-eslint/parser',
        '@extra/straininfo',
    ],
    ignoreBinaries: ['tsc'],
    compilers: {
        css: (text: string) => [...text.matchAll(/(?<=@)import[^;]+/g)].join('\n'),
        yaml: (text: string) => [...text.matchAll(/(?<=@)import[^;]+/g)].join('\n'),
    },
};
