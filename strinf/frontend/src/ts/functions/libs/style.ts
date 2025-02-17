import scSty from '@strinf/css/mods/scroll.module.css';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';

const LOAD_STATE = {
    enabled: false,
};

function enableLoader(): void {
    LOAD_STATE.enabled = true;
    setTimeout(() => {
        if (LOAD_STATE.enabled) {
            const body = document.getElementsByTagName('body')[0] ?? {
                classList: [],
                className: '',
            };
            if (body.classList.length === 0) {
                body.className = scSty.disable;
            }
            const [loader] = document.getElementsByClassName(ClHtml.ld);
            if (loader !== undefined) {
                loader.classList.add(ClHtml.show);
            }
        }
    }, 200);
}

function enableScroll(): void {
    const body = document.getElementsByTagName('body')[0] ?? {
        classList: [],
        className: '',
    };
    body.className = '';
}

function disableLoader(): void {
    LOAD_STATE.enabled = false;
    const body = document.getElementsByTagName('body')[0] ?? {
        classList: [],
        className: '',
    };
    if (body.classList.length > 0) {
        body.className = '';
    }
    const [loader] = document.getElementsByClassName(ClHtml.ld);
    if (loader !== undefined) {
        loader.classList.remove(ClHtml.show);
    }
}

const SIDE_STATUS = 'active';
const SIDE_ID = 'side_bar_status_id';

function customToggleSideBar(enable: boolean): void {
    const sideBar = document.getElementById(SIDE_ID);
    if (
        sideBar !== null &&
        Math.abs(Number(sideBar.classList.contains(SIDE_STATUS)) - Number(enable))
    ) {
        window.style.toggleSidebar(sideBar);
    }
}

function enableSideBar(): void {
    customToggleSideBar(true);
}

function disableSideBar(): void {
    customToggleSideBar(false);
}

function toggleSideBar(side?: HTMLElement): void {
    window.style.toggleSidebar(side);
}

function deactivateAllDropdownToggles(): void {
    window.style.deactivateAllDropdownToggles();
}

function reInitCStyle(): void {
    [window.style.pageWrapper] = document.getElementsByClassName(ClHtml.pgWr);
    [window.style.stickyAlerts] = document.getElementsByClassName(ClHtml.alSt);
}

export {
    enableScroll,
    disableLoader,
    reInitCStyle,
    enableSideBar,
    disableSideBar,
    toggleSideBar,
    SIDE_ID,
    enableLoader,
    deactivateAllDropdownToggles,
};
