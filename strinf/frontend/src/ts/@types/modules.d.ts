declare module '*.webp';

// types/mdx.d.ts
declare module '*.mdx' {
    import type { JSX } from 'preact';

    const MDXComponent: (props) => JSX.Element;
    export default MDXComponent;
}
