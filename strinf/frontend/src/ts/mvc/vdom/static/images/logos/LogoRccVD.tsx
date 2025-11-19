import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/rcc.avif';

function LogoRccVD(): JSX.Element {
    return <img loading="lazy" height="68" src={logoI} alt="RCC" />;
}

export default LogoRccVD;
