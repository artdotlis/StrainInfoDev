import type { JSX } from 'preact';
import src from '@extra/straininfo/logos/ena.webp';
import srcFull from '@extra/straininfo/logos/ena_full.webp';
import linkSty from '@strinf/css/mods/link.module.css';

function LogoEnaVD({ full, height }: { full?: boolean; height?: string }): JSX.Element {
    const srcI = full === true ? srcFull : src;
    const heightI = typeof height === 'string' ? height : '22';
    const width = (full === true ? 3.59 : 0.81) * Number.parseInt(heightI, 10);
    return (
        <img
            loading="lazy"
            className={linkSty.logo}
            src={srcI}
            alt="ENA"
            height={heightI}
            width={`${width}`}
        />
    );
}

export default LogoEnaVD;
