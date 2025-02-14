import type { JSX } from 'preact';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import errSty from '@strinf/css/mods/error.module.css';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import { useContext } from 'preact/hooks';
import type { BreadCrumbsG } from '@strinf/ts/interfaces/dom/global';
import HeadT from '@strinf/ts/constants/type/HeadT';

interface EmptyProps {
    path: string;
}

function EmptyVD({ path }: EmptyProps): JSX.Element {
    const ctx: BreadCrumbsG | undefined = useContext(MainConGl);
    if (ctx?.bread !== undefined) {
        ctx.bread.map((actF) => {
            actF(HeadT.HOME);
        });
    }
    return (
        <div className={ClHtml.cntCon}>
            <section className={ClHtml.sec}>
                <div className={ClHtml.con}>
                    <div className={errSty.err}>
                        <h1>404</h1>
                        <h2>Route not found - {path}</h2>
                    </div>
                </div>
            </section>
        </div>
    );
}

export default EmptyVD;
