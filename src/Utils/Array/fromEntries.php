<?php

function fromEntries(array $array, callable $callback): array {
    $result = [];
    foreach ($array as $key => $value) {
        list ($newKey, $newValue) = $callback($value, $key, $array);
        $result[$newKey] = $newValue;
    }

    return $result;
}
