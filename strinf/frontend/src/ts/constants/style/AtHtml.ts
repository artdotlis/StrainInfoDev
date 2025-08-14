import { CookieValue, FormNames } from '@strinf/ts/constants/style/Acc';
import {
    isContrastSet,
    isDyslexiaSet,
    isTransitionSet,
} from '@strinf/ts/functions/cookie/acc';

type DefAttr = Record<string, string | boolean>;

function crAccIn(name: string, value: string, check: boolean): DefAttr {
    return {
        type: 'checkbox',
        name,
        value,
        checked: check,
    };
}

const DD_B = {
    'data-toggle': 'dropdown',
    'aria-haspopup': true,
    'aria-expanded': false,
};

const ACC_M = {
    'aria-labelledby': 'accessibility-menu',
};

const ACC_LC = {
    for: 'set-contrast',
};

function accInC(): DefAttr {
    return crAccIn(FormNames.con, CookieValue.contrast, isContrastSet());
}

const ACC_LM = {
    for: 'set-transitions',
};

function accInM(): DefAttr {
    return crAccIn(FormNames.tra, CookieValue.transitions, isTransitionSet());
}

const ACC_LD = {
    for: 'set-dyslexia',
};

function accInD(): DefAttr {
    return crAccIn(FormNames.dys, CookieValue.dyslexia, isDyslexiaSet());
}

const TT_TAR = {
    'aria-describedby': 'tooltip',
};

const TT_SRC: { role: 'tooltip' } = {
    role: 'tooltip',
};

const TT_ARR = {
    'data-popper-arrow': true,
};

const HIDE_ATTR = {
    hidden: true,
};

const HIDE = 'hidden';

const SIDE_SMALL = {
    'data-sidebar-size': 'small',
};
const SIDE_HIDDEN: [string, string] = ['data-sidebar-hidden', 'hidden'];

export {
    ACC_LC,
    ACC_LD,
    ACC_LM,
    ACC_M,
    accInC,
    accInD,
    accInM,
    DD_B,
    HIDE,
    HIDE_ATTR,
    SIDE_HIDDEN,
    SIDE_SMALL,
    TT_ARR,
    TT_SRC,
    TT_TAR,
};

export type { DefAttr };
