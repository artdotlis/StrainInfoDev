import { useState } from 'preact/hooks';
import type { JSX } from 'preact';

import progSty from '@strinf/css/mods/status.module.css';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import type { ProgSet } from '@strinf/ts/interfaces/dom/prog';

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
        <div id={progSty.load}>
            <div className={ClHtml.pDiv}>
                <div className={ClHtml.pBar} style={`width: ${prog}%;`} />
            </div>
        </div>
    );
}

export default ProgVD;
