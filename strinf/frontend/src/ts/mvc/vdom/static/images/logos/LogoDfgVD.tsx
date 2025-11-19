import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/dfg.avif';

function LogoDfgVD(): JSX.Element {
    return <img loading="lazy" width="260" src={logoI} alt="DFG" />;
}

export default LogoDfgVD;
