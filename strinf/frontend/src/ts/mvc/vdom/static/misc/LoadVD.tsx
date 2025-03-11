import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import { disableLoader, enableLoader } from '@strinf/ts/functions/libs/style';
import type { JSX } from 'preact';

function Loading(): JSX.Element {
    return (
        <div
            className={ClHtml.cntCon}
            ref={() => {
                enableLoader();
                return () => {
                    disableLoader();
                };
            }}
        >
            <section className={ClHtml.sec}>
                <div className={ClHtml.con} />
            </section>
        </div>
    );
}

export default Loading;
