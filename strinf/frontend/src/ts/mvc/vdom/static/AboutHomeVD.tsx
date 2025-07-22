import type { JSX } from 'preact';
import { memo } from 'preact/compat';
import { UIApiCon } from '@strinf/ts/constants/api/ui_api';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import linkSty from '@strinf/css/mods/link.module.css';

import About from '@strinf/md/about/about.mdx';

function AboutI(): JSX.Element {
    return (
        <section className={ClHtml.sec}>
            <div className={ClHtml.con}>
                <h2 className={ClHtml.titSec}>
                    <a
                        className={`${ClHtml.link} ${linkSty.link} ${ClHtml.noCol}`}
                        href={UIApiCon.about}
                    >
                        About
                    </a>
                </h2>
                <About />
            </div>
        </section>
    );
}

export default memo(AboutI);
