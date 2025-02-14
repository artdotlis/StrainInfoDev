import { routeUri } from '@strinf/ts/functions/http/http';

interface PROPS {
    to: string;
    path?: string;
}

function Redirect(props: PROPS): null {
    const { to } = props;
    setTimeout(() => {
        routeUri(to, to);
    }, 100);
    return null;
}

export default Redirect;
