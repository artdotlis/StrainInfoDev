import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/bccm.avif';

function LogoBccmVD(): JSX.Element {
    return <img loading="lazy" height="68" src={logoI} alt="BCCM" />;
}

export default LogoBccmVD;
