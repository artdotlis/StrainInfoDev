enum ErrType {
    E404 = '404',
    E500 = '500',
    E503 = '503',
    EMain = 'MAIN',
    INWARN = 'IN_WARN',
    FEWARN = 'FE_WARN',
}

const ERR_MARK = 'ERROR_INPUT';

export default ErrType;
export { ERR_MARK };
