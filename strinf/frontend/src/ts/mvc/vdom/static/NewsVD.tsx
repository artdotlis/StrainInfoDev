// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { NewsT } from '@strinf/ts/functions/md/wrapper';
import type { BreadCrumbsG } from '@strinf/ts/interfaces/dom/global';
import type { JSX } from 'preact';

import News from '@strinf/md/news/news.mdx';
import HeadT from '@strinf/ts/constants/type/HeadT';

import { getCurFullPath } from '@strinf/ts/functions/http/http';
import { factoryNewsDateWr, TableWr, UListWr } from '@strinf/ts/functions/md/wrapper';
import { MainConContext } from '@strinf/ts/mvc/vdom/state/GlobSt';
import CanonH from '@strinf/ts/mvc/vdom/static/helmet/CanonH';
import MetaH from '@strinf/ts/mvc/vdom/static/helmet/MetaH';
import { memo } from 'preact/compat';
import { useContext as use } from 'preact/hooks';

function NewsM(): JSX.Element {
    const ctx: BreadCrumbsG | undefined = use(MainConContext);
    if (ctx?.bread !== undefined) {
        for (const actF of ctx.bread) {
            actF(HeadT.NEWS);
        }
    }
    return (
        <>
            <MetaH title="StrainInfo - News" desc="StrainInfo news" />
            <CanonH href={getCurFullPath()} />
            <News
                components={{
                    h2: factoryNewsDateWr(({ children }: NewsT) => <h2>{children}</h2>),
                    ul: UListWr,
                    table: TableWr,
                }}
            />
        </>
    );
}

const NewsVD = memo(NewsM);

export default NewsVD;
