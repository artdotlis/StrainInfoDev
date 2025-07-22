interface ConfLinkT {
    domain: string;
    protocol: 'https' | 'http';
    port: number;
}

interface StatsT {
    enable: boolean;
    matomo: ConfLinkT;
    domain: string[];
    id: number;
}

interface IndexT {
    key_len: number;
}

interface ConfConT {
    backend: ConfLinkT;
    frontend: ConfLinkT;
    statistic: StatsT;
    index: IndexT;
    production: boolean;
    stage: boolean;
}

export type { ConfConT, ConfLinkT, StatsT };
