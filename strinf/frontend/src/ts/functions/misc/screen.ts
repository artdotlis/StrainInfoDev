// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

function isSlimScreen(): boolean {
    return window.innerWidth < 800;
}
function isSmallScreen(): boolean {
    return window.innerHeight < 600 || isSlimScreen();
}

export { isSlimScreen, isSmallScreen };
