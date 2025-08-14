import type { JSX } from 'preact';
import src from '@extra/straininfo/logos/ror.webp';
import linkSty from '@strinf/css/mods/link.module.css';

function LogoRORVD({ height }: { height?: string }): JSX.Element {
    const heightI = typeof height === 'string' ? height : '22';
    const width = 1.45 * Number.parseInt(heightI, 10);
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
