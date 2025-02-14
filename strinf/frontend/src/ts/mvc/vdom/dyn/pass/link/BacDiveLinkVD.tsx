import type { JSX } from 'preact';
import LogoBacDiveVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoBacDiveVD';
import { bac_dive_id } from '@strinf/ts/constants/links/bacdive';

interface BacLink {
    id: number;
}

function BacDiveLinkVD(props: BacLink): JSX.Element {
    const { id } = props;
    return (
        <a href={bac_dive_id(id)} target="_blank" rel="noreferrer">
            <LogoBacDiveVD />
        </a>
    );
}

export default BacDiveLinkVD;
