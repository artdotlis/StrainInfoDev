import type { BreadCrumbsG } from '@strinf/ts/interfaces/dom/global';
import type { JSX } from 'preact';
import Team from '@strinf/md/team/team.mdx';

import HeadT from '@strinf/ts/constants/type/HeadT';
import { PersonWr, TableWr, TeamWr } from '@strinf/ts/functions/md/wrapper';

import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import MetaH from '@strinf/ts/mvc/vdom/static/helmet/MetaH';
import { memo } from 'preact/compat';
import { useContext as use } from 'preact/hooks';

interface TeamProps {
    path: string;
}

function TeamM(): JSX.Element {
    const ctx: BreadCrumbsG | undefined = use(MainConGl);
    if (ctx?.bread !== undefined) {
        for (const actF of ctx.bread) {
            actF(HeadT.TEAM);
        }
    }
    return (
        <>
            <MetaH title="StrainInfo - Team" desc="StrainInfo team" index={false} />
            <Team
                components={{
                    table: TableWr,
                    ul: TeamWr,
                    li: PersonWr,
                }}
            />
        </>
    );
}

const TeamVD = memo<(props: TeamProps) => JSX.Element>(TeamM);

export default TeamVD;
