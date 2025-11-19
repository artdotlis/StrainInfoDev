import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/cip.avif';

function LogoCipVD(): JSX.Element {
    return <img loading="lazy" height="68" src={logoI} alt="CIP" />;
}

export default LogoCipVD;
