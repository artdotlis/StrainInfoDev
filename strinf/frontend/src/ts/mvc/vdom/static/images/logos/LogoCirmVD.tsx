import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/cirm.avif';

function LogoCirmVD(): JSX.Element {
    return <img loading="lazy" height="68" src={logoI} alt="CIRM-CFBP and CIRM-CF" />;
}

export default LogoCirmVD;
