<?php

namespace AOC\Helper;

/**
* Class InputReader
*
* @package AOC\Helper
*/
final class InputReader
{
    /**
    * @param string $filename
    *
    * @return array
    */
    public static function fileToLines(string $filename): array
    {
        return explode(PHP_EOL, file_get_contents($filename));
    }
}
