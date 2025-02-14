function strain_info_mail(): string {
    return ['straininfo', 'dsmz.de'].join('@');
}

function dsmz_mail(): string {
    return ['contact', 'dsmz.de'].join('@');
}

export { strain_info_mail, dsmz_mail };
