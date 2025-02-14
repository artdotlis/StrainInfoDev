function sortAndReduce<T>(
    data: Record<string, T[]>,
    max: number,
    repl: T
): [string[], Record<string, T[]>] {
    const filtRes: Record<string, T[]> = {};
    const sortKey: Record<number, string[]> = {};
    for (const [key, val] of Object.entries(data)) {
        filtRes[key] = val.length > max ? [...val.slice(0, max), repl] : val;
        if (!(val.length in sortKey)) {
            sortKey[val.length] = [];
        }
        sortKey[val.length]?.push(key);
    }
    const sortedKey = Object.keys(sortKey)
        .sort((first, second) => Number(second) - Number(first))
        .flatMap((lKey) => sortKey[Number(lKey)] ?? []);
    return [sortedKey, filtRes];
}

export default sortAndReduce;
