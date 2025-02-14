import type { JSX } from 'preact';
import linkSty from '@strinf/css/mods/link.module.css';
import src from '@extra/straininfo/logos/orcid.webp';

function LogoORCIDVD({ height }: { height?: string }): JSX.Element {
    const heightI = typeof height === 'string' ? height : '22';
    return (
        <img
            loading="lazy"
            className={linkSty.logo}
            src={src}
            alt="ORCID"
            width={heightI}
            height={heightI}
        />
    );
}

export default LogoORCIDVD;
