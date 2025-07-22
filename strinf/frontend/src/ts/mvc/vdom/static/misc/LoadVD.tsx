import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import type { JSX } from 'preact';
import loaderSty from '@strinf/css/mods/loader.module.css';

const LID = 'loader_container';

function Loading(): JSX.Element {
    return (
        <section className={ClHtml.sec} id={LID}>
            <div className={ClHtml.con}>
                <div className={loaderSty.loader}>
                    {[...Array(4)].map((_, cid) => (
                        <div className={loaderSty.ball} key={`lob-${cid}`} />
                    ))}
                </div>
            </div>
        </section>
    );
}

export default Loading;
export { LID };
