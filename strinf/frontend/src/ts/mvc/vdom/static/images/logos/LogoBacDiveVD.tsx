import type { JSX } from 'preact';
import logoI from '@extra/straininfo/logos/bacdive.avif';
import linkSty from '@strinf/css/mods/link.module.css';

function LogoBacDiveVD(): JSX.Element {
    return (
        <img
            loading="lazy"
            className={linkSty.logoleft}
            src={logoI}
            height="22"
            alt="BacDive"
        />
    );
}

export default LogoBacDiveVD;
