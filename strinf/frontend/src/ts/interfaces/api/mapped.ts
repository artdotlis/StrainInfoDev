import type {
    DepositAvg,
    DepositMin,
    StrainStrMin,
    DepositStrMin,
    StrainStrAvg,
    SeaIndCon,
} from '@strinf/ts/interfaces/api/data';

interface SeaInputMap {
    qApi: string;
    qArg: string;
}

interface SeaInputCombEl {
    getArgs: (input: string) => string;
    check: (input: string) => void;
    api: string;
}

type ChartData<T> = Record<string, T>;

interface ChartKeyXY {
    x: string;
    y: string;
}

interface ApiChanInt {
    createApiCall: (extra: string) => string;
}

// -------------------------------

interface SerSeaAllJ {
    data: unknown[];
    count: number;
}

interface PassJ {
    strain: StrainStrAvg;
}

interface SeaIndJ {
    exact: SeaIndCon[];
    match: SeaIndCon[];
}

interface DetailsJ {
    deposit: DepositAvg;
    strain: DepositStrMin;
}

interface InfoDJ {
    deposit: DepositMin;
}
interface InfoSJ {
    strain: StrainStrMin;
}
// TODO remove or simplify types (too complex)
// |-> just use one central type containing all data?

type InfoR = [number, string, string, boolean];
type InfoS = [number, string, string];

type SeaR = [number, string[], string, boolean, Uint8Array, number];
type SerSeaR = [number, string[], string, number, string, number];
type DetailsR = [
    number,
    [string, string, string, string, string, string, boolean],
    string,
    number,
    boolean,
    boolean,
    [string, number | undefined, number | undefined],
    [string, string],
    [string, string],
    number | undefined,
    string,
    string,
    string,
    string,
    string,
    [string, string],
    [string, string],
    string,
    [string, string],
    [string, string],
    string,
    boolean,
    string[],
];

type RelT = [number, string, number | undefined, number | undefined];
type DesT = string;
type OvT = [
    number,
    boolean,
    [string, number | undefined, number | undefined],
    number | undefined,
    string,
];
type PubT = [string, string, [string, number][], string, string, number | undefined];
type SeqT = [
    string,
    [string, number][],
    string,
    string,
    number | string,
    number | undefined,
];
type DetMT = [
    [string, string, string, string, string, string, boolean],
    string,
    number,
    boolean,
    boolean,
    [string, number | undefined, number | undefined],
];
type DetET = [
    [string, string],
    [string, string],
    number | undefined,
    string,
    string,
    string,
    string,
    string,
    [string, string],
    [string, string],
    string,
    [string, string],
    [string, string],
    string,
    boolean,
];
type DetT = [...DetMT, ...DetET];
type ArcT = [string, string, string];

type SIndT = [string, string, number, number];

interface PassR {
    overview: OvT;
    relations: RelT[];
    designations: DesT[];
    sequences: SeqT[];
    publications: PubT[];
    archive: ArcT[];
    allStrIds: number[];
    altStrIds: number[];

    clear: () => void;
}

interface SeaIndR {
    exact: SIndT[];
    match: SIndT[];
}

interface MaintenanceInt {
    status: boolean;
    duration: string;
    zone: string;
}
interface ServerStatusInt {
    private: boolean;
    version: string;
    maintenance: MaintenanceInt;
}

export type {
    ServerStatusInt,
    ApiChanInt,
    ChartData,
    ChartKeyXY,
    SeaInputMap,
    SeaInputCombEl,
    SerSeaAllJ,
    SeaR,
    SerSeaR,
    PassJ,
    PassR,
    InfoR,
    InfoS,
    InfoDJ,
    InfoSJ,
    DetailsR,
    DetailsJ,
    SeqT,
    PubT,
    DetET,
    DetMT,
    DetT,
    OvT,
    RelT,
    DesT,
    ArcT,
    SeaIndR,
    SeaIndJ,
    SIndT,
};
