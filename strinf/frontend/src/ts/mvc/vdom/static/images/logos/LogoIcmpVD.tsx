import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/icmp.avif';

function LogoIcmpVD(): JSX.Element {
    return <img loading="lazy" height="68" src={logoI} alt="ICMP" />;
}

export default LogoIcmpVD;
