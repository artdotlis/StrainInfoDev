const LEAD_TRAIL_COMMA = /^,+|,+$/g;

function getLeTrComma(): RegExp {
    return LEAD_TRAIL_COMMA;
}

export default getLeTrComma;
