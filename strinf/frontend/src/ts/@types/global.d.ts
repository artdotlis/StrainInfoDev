// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

type Matomo = [string, string[] | boolean] | string[] | (string | number)[];

declare global {
    // JSX
    namespace preact.JSX {
        interface IntrinsicElements {
            'rapi-doc': object;
        }
    }

    // window
    interface Window {
        style: StyleT;
        onerror: OnErrorEventHandlerNoNull;
        _paq?: Matomo[];
        Matomo?: object;
        matomoLoaded?: true;
        tracking?: number;
        lastSearch?: string;
    }
}

export {};
