import type { InfoTMInt } from '@strinf/ts/interfaces/dom/tooltip';
import type { InfoR, InfoS } from '@strinf/ts/interfaces/api/mapped';

type ViewChanInt<I extends InfoS | InfoR> = InfoTMInt<I>;

export default ViewChanInt;
