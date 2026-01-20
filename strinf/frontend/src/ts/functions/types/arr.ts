// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

function hasProp<P extends string>(prop: P, obj: unknown): obj is Record<P, unknown> {
    if (typeof obj !== 'object' || obj === null) {
        return false;
    }
    return prop in obj;
}

export { hasProp };
