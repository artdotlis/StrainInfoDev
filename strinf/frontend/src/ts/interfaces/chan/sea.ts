import type { LoadStMInt } from '@strinf/ts/interfaces/dom/global';
import type { ProgStMInt } from '@strinf/ts/interfaces/dom/prog';
import type { SeaTMInt } from '@strinf/ts/interfaces/dom/sea';

type ViewChanInt = ProgStMInt & SeaTMInt & LoadStMInt;

export default ViewChanInt;
