// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

function scrambleMail(mail: string): string {
    return mail.replace(/\./, ' [dot] ').replace(/@|;-;/, ' [at] ');
}

function openMailClient(destMail: string, subj?: string, body?: string): void {
    const enSub = encodeURIComponent(subj ?? '');
    const enBod = encodeURIComponent(body ?? '');
    const mailto = destMail.replace(/;-;/, '@');
    document.location.href = `mailto:${mailto}?subject=${enSub}&body=${enBod}`;
}

export { openMailClient, scrambleMail };
