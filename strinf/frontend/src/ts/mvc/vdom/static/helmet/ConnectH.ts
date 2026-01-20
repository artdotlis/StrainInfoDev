// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import { useEffect } from 'preact/hooks';

function PreConnectH({ id, href }: { id: string; href: string }): null {
    const fId = `${id}_preconnect`;
    useEffect(() => {
        document.querySelector(`#${fId}`)?.remove();
        const link = document.createElement('link');
        link.setAttribute('rel', 'preconnect');
        link.setAttribute('href', href);
        link.setAttribute('id', fId);
        document.head.appendChild(link);
        return () => {
            document.querySelector(`#${fId}`)?.remove();
        };
    }, [fId, href]);

    return null;
}

export default PreConnectH;
