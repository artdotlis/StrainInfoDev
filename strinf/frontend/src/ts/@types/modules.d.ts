// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare module '*.avif';

// types/mdx.d.ts
declare module '*.mdx' {
    import type { JSX } from 'preact';

    const MDXComponent: (props) => JSX.Element;
    export default MDXComponent;
}
