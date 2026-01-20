// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

type ProgSetF = (setter: (prog: number) => void) => void;
type ProgF = (prog: number) => void;

interface ProgSet {
    get progSet(): ProgSetF;
}
interface ProgStMInt {
    get prog(): ProgF;
}
export type { ProgF, ProgSet, ProgSetF, ProgStMInt };
