import type { JSX } from 'preact';
import logoI from '@assets/dia/streg_proc.webp';

function ProcStrainRegistryVD(): JSX.Element {
    return (
        <img
            loading="lazy"
            width="560"
            src={logoI}
            alt="StrainRegistry registrationprocedure"
        />
    );
}
export default ProcStrainRegistryVD;
