import type { DiaCon } from '@strinf/ts/interfaces/dom/dia';

interface DisChartT {
    get api(): string;
    config: (call: string) => Promise<DiaCon>;
}

export default DisChartT;
