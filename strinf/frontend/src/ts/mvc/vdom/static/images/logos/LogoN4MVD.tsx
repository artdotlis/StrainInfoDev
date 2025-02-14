import type { JSX } from 'preact';
import src from '@extra/straininfo/logos/nfdi4microbiota.webp';

function LogoN4MVD(): JSX.Element {
    return <img loading="lazy" height="68" src={src} alt="NFDI4Microbiota" />;
}

export default LogoN4MVD;
