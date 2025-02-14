import type { JSX } from 'preact';
import src from '@extra/straininfo/logos/icmp.webp';

function LogoIcmpVD(): JSX.Element {
    return <img loading="lazy" height="68" src={src} alt="ICMP" />;
}

export default LogoIcmpVD;
