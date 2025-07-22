import type { JSX } from 'preact';
import { memo } from 'preact/compat';
import errSty from '@strinf/css/mods/error.module.css';

function PanicVD(): JSX.Element {
    return (
        <div className={errSty.err}>
            <h1>500</h1>
            <h2>
                Internal server error!
                <br />
                Try reloading the webpage!
            </h2>
        </div>
    );
}

export default memo(PanicVD);
