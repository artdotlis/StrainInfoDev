import type { JSX } from 'preact';
import linkSty from '@strinf/css/mods/link.module.css';
import src from '@extra/straininfo/logos/ror.webp';

function LogoRORVD({ height }: { height?: string }): JSX.Element {
    const heightI = typeof height === 'string' ? height : '22';
    let width = 1.45 * parseInt(heightI, 10);
    return (
        <img
            loading="lazy"
            className={linkSty.logo}
            src={src}
            alt="ROR"
            width={`${width}`}
            height={heightI}
        />
    );
}

export default LogoRORVD;
