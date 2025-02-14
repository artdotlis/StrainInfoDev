import type { JSX } from 'preact';
import linkSty from '@strinf/css/mods/link.module.css';
import src from '@extra/straininfo/logos/bacdive.webp';

function LogoBacDiveVD(): JSX.Element {
    return (
        <img
            loading="lazy"
            className={linkSty.logoleft}
            src={src}
            height="22"
            alt="BacDive"
        />
    );
}

export default LogoBacDiveVD;
