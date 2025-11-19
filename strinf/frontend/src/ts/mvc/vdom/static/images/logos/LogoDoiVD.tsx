import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/doi.avif';

interface LogoProps {
    height: string;
    cla: string;
}

function LogoDoiVD({ height, cla }: LogoProps): JSX.Element {
    return <img loading="lazy" className={cla} height={height} src={logoI} alt="DOI" />;
}

export default LogoDoiVD;
