import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/nfdi4microbiota.avif';

function LogoN4MVD(): JSX.Element {
    return <img loading="lazy" height="68" src={logoI} alt="NFDI4Microbiota" />;
}

export default LogoN4MVD;
