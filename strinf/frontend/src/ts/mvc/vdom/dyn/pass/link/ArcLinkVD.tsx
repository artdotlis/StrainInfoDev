// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { ToolTipHookInt, TT_GL_TYPE } from '@strinf/ts/interfaces/dom/tooltip';
import type { JSX } from 'preact';
import conSty from '@strinf/css/mods/container.module.css';
import linkSty from '@strinf/css/mods/link.module.css';
import IdAcrTagCon from '@strinf/ts/constants/acr/id_acr';
import ClHtmlI from '@strinf/ts/constants/icon/ClHtml';
import DOI_L from '@strinf/ts/constants/links/doi';
import { Align, Dis, Tex } from '@strinf/ts/constants/style/ClHtml';
import IdHtmlTour from '@strinf/ts/constants/tour/IdHtml';
import ErrType from '@strinf/ts/constants/type/ErrT';
import onPrError from '@strinf/ts/functions/err/async';
import { createUrlStr } from '@strinf/ts/functions/http/http';
import crAlert from '@strinf/ts/mvc/vdom/fun/alert/alert';
import { useTooltipForRef } from '@strinf/ts/mvc/vdom/fun/tab/pass';
import LogoDoiVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoDoiVD';
import { useRef } from 'preact/hooks';

interface ArcLink {
    doi: string;
    hook: ToolTipHookInt<TT_GL_TYPE>;
    online: boolean;
}

const DOI_R = new RegExp(`^(.+)(${IdAcrTagCon.strId}.+)(\\.\\d+)$`);

function splitDoi(doi: string, online: boolean): JSX.Element {
    const splDoi = DOI_R.exec(doi);
    if (splDoi === null) {
        return <span>{doi}</span>;
    }
    return (
        <span>
            {online ? splDoi[1] : ''}
            <strong
                className={Tex.w}
                style={{
                    backgroundColor: 'var(--color-db-straininfo)',
                    borderRadius: '4px',
                    paddingRight: '4px',
                    paddingLeft: '4px',
                    paddingTop: '2px',
                    paddingBottom: '2px',
                }}
            >
                {splDoi[2]}
            </strong>
            {splDoi[3]}
        </span>
    );
}

function ArcLinkVD(props: ArcLink): JSX.Element | null {
    const { doi, hook, online } = props;
    const claD = `${Dis.dIFlex} ${conSty.fbundle}`;
    const claB = `${linkSty.cleanbutton} ${Dis.dIFlex} ${Align.jc}`;
    const ref = useRef<HTMLButtonElement>(null);
    useTooltipForRef(
        ref,
        hook,
        () => {
            if (hook.data !== undefined) {
                hook.data(
                    online ? (
                        <p>Click on the icon to copy the DOI URL</p>
                    ) : (
                        <>
                            <h6>Click on the icon to copy the DOI URL</h6>
                            <p>
                                <b>The DOI is currently not online</b>
                                ,
                                <br />
                                but it serves as a stable reference for the strain and
                                will be published at a future date. Entries will not be
                                removed from the archive, but new CCNos may be added and
                                strain information may be updated over time.
                            </p>
                        </>
                    )
                );
            }
        },
        [50, 50]
    );
    return (
        <span className={claD} id={IdHtmlTour.doiHead}>
            <button
                ref={ref}
                className={claB}
                type="button"
                aria-label="Copy archive"
                onClick={() => {
                    try {
                        navigator.clipboard
                            .writeText(createUrlStr(DOI_L, doi))
                            .then(() => {
                                crAlert(null, 'DOI copied to your clipboard');
                            })
                            .catch(onPrError);
                    } catch {
                        crAlert(ErrType.FEWARN, 'Clipboard not defined!');
                    }
                }}
            >
                {online ? (
                    <LogoDoiVD height="22" cla="" />
                ) : (
                    <i
                        className={`${ClHtmlI.wrenchF} ${Tex.f}`}
                        style={{
                            fontSize: '22px',
                        }}
                    />
                )}
            </button>
            {splitDoi(doi, online)}
        </span>
    );
}

export default ArcLinkVD;
