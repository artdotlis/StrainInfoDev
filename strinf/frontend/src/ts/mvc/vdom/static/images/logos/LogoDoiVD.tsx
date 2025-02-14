import type { JSX } from 'preact';
import src from '@extra/straininfo/logos/doi.webp';

interface LogoProps {
    height: string;
    cla: string;
}

function LogoDoiVD({ height, cla }: LogoProps): JSX.Element {
    return <img loading="lazy" className={cla} height={height} src={src} alt="DOI" />;
}

export default LogoDoiVD;
