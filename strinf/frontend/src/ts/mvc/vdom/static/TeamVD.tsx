import type { JSX } from 'preact';
import { memo } from 'preact/compat';
import { useContext } from 'preact/hooks';

import type { BreadCrumbsG } from '@strinf/ts/interfaces/dom/global';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';

import Team from '@strinf/md/team/team.mdx';
import { PersonWr, TableWr, TeamWr } from '@strinf/ts/functions/md/wrapper';
import HeadT from '@strinf/ts/constants/type/HeadT';

interface TeamProps {
    path: string;
}

function TeamM(): JSX.Element {
    const ctx: BreadCrumbsG | undefined = useContext(MainConGl);
    if (ctx?.bread !== undefined) {
        ctx.bread.map((actF) => {
            actF(HeadT.TEAM);
        });
    }
    return (
        <Team
            components={{
                table: TableWr,
                ul: TeamWr,
                li: PersonWr,
            }}
        />
    );
}

const TeamVD = memo<(props: TeamProps) => JSX.Element>(TeamM);

export default TeamVD;
