import type { ToolTipHookInt, TT_GL_TYPE } from '@strinf/ts/interfaces/dom/tooltip';
import type { JSX } from 'preact';
import conSty from '@strinf/css/mods/container.module.css';
import linkSty from '@strinf/css/mods/link.module.css';
import CONFIG from '@strinf/ts/configs/config';
import QApiCon from '@strinf/ts/constants/api/q_api';
import ClHtmlI from '@strinf/ts/constants/icon/ClHtml';
import DOI_L from '@strinf/ts/constants/links/doi';
import ClHtmlSt from '@strinf/ts/constants/stat/ClHtml';
import { Align, ClHtml, Dis, Pad, Tex, Wid } from '@strinf/ts/constants/style/ClHtml';
import ErrType from '@strinf/ts/constants/type/ErrT';
import onPrError from '@strinf/ts/functions/err/async';
import readTextFile from '@strinf/ts/functions/files/reader';
import { createUrlStr } from '@strinf/ts/functions/http/http';
import DownloadBlobVD from '@strinf/ts/mvc/vdom/dyn/misc/DownloadVD';
import crAlert from '@strinf/ts/mvc/vdom/fun/alert/alert';
import { trackDownload } from '@strinf/ts/mvc/vdom/fun/mat/track';
import { useTooltipForRef } from '@strinf/ts/mvc/vdom/fun/tab/pass';
import { useRef } from 'preact/hooks';

interface DownloadT {
    doi: string;
    online: boolean;
    hook: ToolTipHookInt<TT_GL_TYPE>;
}

function activeLink(siId: string): (eve: Event) => Promise<[string, string]> {
    const callBack = async (eve: Event) => {
        eve.stopPropagation();
        const url = createUrlStr(CONFIG.backend, `${QApiCon.arcStrSiId.slice(1)}${siId}`);
        const res = readTextFile(url).then((cont): [string, string] => {
            const jsonBlob = new Blob([JSON.stringify(JSON.parse(cont)[0], null, 4)], {
                type: 'text/plain;charset=utf-8',
            });
            trackDownload(url, jsonBlob.size);
            return [URL.createObjectURL(jsonBlob), `${siId}.json`];
        });
        res.catch(onPrError);
        return res;
    };
    return callBack;
}

function DoiTemp({ doi, online, hook }: DownloadT): JSX.Element {
    const ref = useRef<HTMLSpanElement>(null);
    useTooltipForRef(
        ref,
        hook,
        () => {
            if (hook.data !== undefined) {
                hook.data(
                    <p>
                        <b>The DOI is currently not online</b>
                        ,
                        <br />
                        but it serves as a stable reference for the strain and will be
                        published at a future date. Entries will not be removed from the
                        archive, but new CCNos may be added and strain information may be
                        updated over time.
                    </p>,
                );
            }
        },
        [50, 50],
    );
    if (online) {
        return <>{doi}</>;
    }

    return (
        <>
            {doi}
            <i
                ref={ref}
                className={`${ClHtmlI.wrenchF} ${Tex.f}`}
                style={{
                    fontSize: '22px',
                    marginLeft: '8px',
                    marginRight: 'auto',
                }}
            />
        </>
    );
}

function DoiDownloadGrid(props: DownloadT): JSX.Element {
    const { doi, online, hook } = props;
    const siId = doi.replace(/10\.\d{4,}(?:\.\d+)*\/(\S+)$/, '$1');
    const spCon = `${Align.jb} ${Dis.dIFlex} ${conSty.fbundle} ${Wid.f}`;
    const btnC = `${ClHtmlSt.mask} ${ClHtml.btn} ${ClHtml.link} ${Pad.lN0} ${Pad.rN5}`;
    const claB = `${linkSty.linkicon} ${linkSty.cleanbutton}`;
    return (
        <span className={spCon}>
            <DoiTemp doi={doi} online={online} hook={hook} />
            <span style={{ 'white-space': 'nowrap' }}>
                <span className={claB}>
                    <DownloadBlobVD
                        btnC={btnC}
                        ancC={claB}
                        label={`Download archive for strain ${siId}`}
                        ico={ClHtmlI.downlF}
                        callBack={activeLink(siId)}
                        emptyLoad={true}
                        state="DOI - archive"
                        desc=""
                    />
                </span>
                <button
                    className={`${btnC} ${claB}`}
                    style={{ outline: 'none', boxShadow: 'none' }}
                    aria-label="Copy archive"
                    type="button"
                    onClick={() => {
                        try {
                            navigator.clipboard
                                .writeText(createUrlStr(DOI_L, doi))
                                .then(() => {
                                    crAlert(null, 'DOI copied to your clipboard');
                                })
                                .catch(onPrError);
                        }
                        catch {
                            crAlert(ErrType.FEWARN, 'Clipboard not defined!');
                        }
                    }}
                >
                    <i className={ClHtmlI.clipB} />
                </button>
            </span>
        </span>
    );
}

export default DoiDownloadGrid;
