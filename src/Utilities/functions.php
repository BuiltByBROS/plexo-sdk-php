<?php
namespace Plexo\Sdk\Utilities\functions;

function ksortRecursive(&$array, $sort_flags = SORT_REGULAR)
{
    if (!is_array($array)) {
        return false;
    }
    ksort($array, $sort_flags);
    foreach ($array as &$arr) {
        ksortRecursive($arr, $sort_flags);
    }
    return true;
}

function replace_unicode_escape_sequence($match)
{
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}
