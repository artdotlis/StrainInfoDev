// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare global {
    interface StyleT {
        pageWrapper: Element | undefined;
        stickyAlerts: Element | undefined;
        darkModeOn: boolean;

        createCookie: (name: string, value: string, days: number) => void;
        readCookie: (name: string) => string | null;
        eraseCookie: (name: string) => void;
        toggleDarkMode: () => void;
        getPreferredMode: () => string;
        toggleSidebar: (btn?: Element) => void;
        deactivateAllDropdownToggles: () => void;
        toggleModal: (modalId: string) => void;
        toggleLoader: () => void;
        makeId: (length: number) => void;
        toastAlert: (alertId: string, timeShown: number) => void;
        initStickyAlert: (param: object) => void;
        clickHandler: (event: Event) => void;
        keydownHandler: (event: Event) => void;
        bindInputValue: (inputElement: Element) => void;
        callBindInputValueForAttachment: (event: Event) => void;
        initSmallSidebar: () => void;
    }
}

export {};
