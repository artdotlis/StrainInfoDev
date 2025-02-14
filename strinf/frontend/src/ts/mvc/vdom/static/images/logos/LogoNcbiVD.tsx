import type { JSX } from 'preact';
import linkSty from '@strinf/css/mods/link.module.css';
import src from '@extra/straininfo/logos/ncbi.webp';
import srcFull from '@extra/straininfo/logos/ncbi_full.webp';

function LogoNcbiVD({ full, height }: { full?: boolean; height?: string }): JSX.Element {
    const srcI = full === true ? srcFull : src;
    const heightI = typeof height === 'string' ? height : '22';
    let width = (full === true ? 3.45 : 0.81) * parseInt(heightI, 10);
    return (
        <img
            loading="lazy"
            className={linkSty.logo}
            src={srcI}
            height={heightI}
            alt="NCBI"
            width={`${width}`}
        />
    );
}

export default LogoNcbiVD;
