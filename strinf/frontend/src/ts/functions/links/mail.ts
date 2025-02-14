function scrambleMail(mail: string): string {
    return mail.replace(/\./, ' [dot] ').replace(/@|;-;/, ' [at] ');
}

function openMailClient(destMail: string, subj?: string, body?: string): void {
    const enSub = encodeURIComponent(subj ?? '');
    const enBod = encodeURIComponent(body ?? '');
    const mailto = destMail.replace(/;-;/, '@');
    document.location.href = `mailto:${mailto}?subject=${enSub}&body=${enBod}`;
}

export { scrambleMail, openMailClient };
