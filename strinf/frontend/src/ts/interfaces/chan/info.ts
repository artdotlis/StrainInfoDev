import type { InfoR, InfoS } from '@strinf/ts/interfaces/api/mapped';
import type { InfoTMInt } from '@strinf/ts/interfaces/dom/tooltip';

type ViewChanInt<I extends InfoS | InfoR> = InfoTMInt<I>;

export default ViewChanInt;
