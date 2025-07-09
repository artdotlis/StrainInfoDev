import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import { disableLoader, enableLoader } from '@strinf/ts/functions/libs/style';
import type { JSX } from 'preact';
import { useEffect } from 'preact/hooks';

function Loading(): JSX.Element {
    useEffect(() => {
        enableLoader();

        return () => {
            disableLoader();
        };
    }, []);
    return (
        <div className={ClHtml.cntCon}>
            <section className={ClHtml.sec}>
                <div className={ClHtml.con} />
            </section>
        </div>
    );
}

export default Loading;
