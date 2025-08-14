import type { JSX } from 'preact';
import src from '@extra/straininfo/logos/orcid.webp';
import linkSty from '@strinf/css/mods/link.module.css';

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
