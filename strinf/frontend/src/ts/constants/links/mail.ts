function strain_info_mail(): string {
    return ['straininfo', 'dsmz.de'].join('@');
}

function dsmz_mail(): string {
    return ['contact', 'dsmz.de'].join('@');
}

export { dsmz_mail, strain_info_mail };
