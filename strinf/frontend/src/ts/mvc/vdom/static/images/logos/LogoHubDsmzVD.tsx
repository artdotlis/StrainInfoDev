import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/d3_hub.avif';
import logoIFull from '@extra/straininfo/logos/d3_hub_full.avif';

function LogoHubDsmzVD({
    full,
    height,
}: {
    full: boolean;
    height?: string;
}): JSX.Element {
    const srcI = full ? logoIFull : logoI;
    return (
        <img
            fetchPriority="high"
            height={height ?? 100}
            src={srcI}
            alt="DSMZ Digital Diversity"
        />
    );
}

export default LogoHubDsmzVD;
