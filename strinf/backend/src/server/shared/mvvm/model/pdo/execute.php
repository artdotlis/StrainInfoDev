<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\pdo;

/**
 * @template T
 *
 * @param array<T> $val
 */
function bind_and_exe(\PDOStatement $sta, array $val, int $type): bool
{
    $v_i = 1;
    foreach ($val as $v_el) {
        $sta->bindValue($v_i, $v_el, $type);
        $v_i++;
    }
    return $val && $sta->execute();
}

/**
 * @template T
 *
 * @param callable(string|int): T $parse
 *
 * @return array<T>
 */
function parse_row_2_arr(\PDOStatement $sta, callable $parse): array
{
    if ($sta->execute() && is_array($res = $sta->fetch())) {
        return array_map($parse, $res);  // @phpstan-ignore argument.type
    }
    return [];
}

/**
 * @template T
 *
 * @param callable(array<string|int>): T $parse
 *
 * @return array<T>
 */
function parse_rows_2_arr(\PDOStatement $sta, callable $parse): array
{
    if ($sta->execute()) {
        return array_map($parse, $sta->fetchAll());
    }
    return [];
}

/**
 * @template T
 *
 * @param callable(string|int): T $parse
 *
 * @return array<T>
 */
function parse_col_2_arr(\PDOStatement $sta, callable $parse): array
{
    if ($sta->execute() && $res = $sta->fetchAll()) {
        return array_map($parse, $res);
    }
    return [];
}
