// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { LoadFS } from '@strinf/ts/interfaces/dom/global';

interface LoadStVInt {
    setLoad: (load: () => LoadFS[]) => void;
}

export default LoadStVInt;
