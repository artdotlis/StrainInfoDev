import type { ProgSet } from '@strinf/ts/interfaces/dom/prog';
import type { JSX } from 'preact';

import progSty from '@strinf/css/mods/status.module.css';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import { useState } from 'preact/hooks';

function ProgVD({ progSet }: ProgSet): JSX.Element | null {
    const [prog, setProg] = useState<number>(0);
    progSet((number: number) => {
        if (number - prog >= 5) {
            setProg(number);
        }
    });
    if (prog < 5 || prog > 95) {
        return null;
    }
    return (
        <div
            id={progSty.load}
            style={{
                margin: '-2rem -2rem 0 -2rem',
            }}
        >
            <div className={ClHtml.pDiv}>
                <div className={ClHtml.pBar} style={`width: ${prog}%;`} />
            </div>
        </div>
    );
}

export default ProgVD;
