// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import { useEffect } from 'preact/hooks';

function SchemaMainH({ json }: { json: string }): null {
    const fId = 'main_site_schema';
    useEffect(() => {
        document.querySelector(`#${fId}`)?.remove();
        const script = document.createElement('script');
        script.setAttribute('nonce', `${import.meta.env.VITE_NONCE_NAME}`);
        script.setAttribute('type', 'application/ld+json');
        script.setAttribute('id', fId);
        script.text = json;
        document.head.appendChild(script);
        return () => {
            document.querySelector(`#${fId}`)?.remove();
        };
    }, [json]);

    return null;
}

export default SchemaMainH;
