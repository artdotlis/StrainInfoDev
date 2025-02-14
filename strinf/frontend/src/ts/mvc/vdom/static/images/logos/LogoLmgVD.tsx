import type { JSX } from 'preact';
import src from '@extra/straininfo/logos/bccm_lmg.webp';

function LogoLmgVD(): JSX.Element {
    return <img loading="lazy" height="68" src={src} alt="BCCM/LMG" />;
}

export default LogoLmgVD;
