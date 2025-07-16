function isSlimScreen(): boolean {
    return document.body.clientWidth < 800;
}
function isSmallScreen(): boolean {
    return document.body.clientHeight < 600 || isSlimScreen();
}

export { isSlimScreen, isSmallScreen };
