import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/bccm_lmg.avif';

function LogoLmgVD(): JSX.Element {
    return <img loading="lazy" height="68" src={logoI} alt="BCCM/LMG" />;
}

export default LogoLmgVD;
