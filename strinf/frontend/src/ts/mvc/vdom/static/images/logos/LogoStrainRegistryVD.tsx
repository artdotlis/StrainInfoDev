import type { JSX } from 'preact';
import logoI from '@assets/logo/streg.webp';

function LogoStrainRegistryVD(): JSX.Element {
    return (
        <img loading="lazy" height="111" width="700" src={logoI} alt="StrainRegistry" />
    );
}
export default LogoStrainRegistryVD;
