<?php

use AOC\Helper\InputReader;
require_once __DIR__ . '/../../../../vendor/autoload.php';

$cycle = 0;
$x = 1;
$crt = [];
$crtLine = '';
$pixel = 0;

foreach (InputReader::fileToLines(__DIR__ . '/../input.txt') as $instruction) {
    $parts = explode(' ', $instruction);
    $command = $parts[0];
    $value = isset($parts[1]) ? (int) $parts[1] : null;

    switch ($command) {
        case 'noop':
            $cycle++;
            $pixel = $cycle - (count($crt) * 40);
            $sprite = [$x - 1, $x, $x + 1];
            $crtLine .= in_array($pixel, $sprite) ? '#' : '.';
            if (strlen($crtLine) == 40) {
                $crt[] = $crtLine;
                $crtLine = '';
                if (count($crt) === 6) break;
            }
            break;

        case 'addx':
            for ($i = 0; $i < 2; $i++) {
                if ($i === 1) {
                    $x += $value;
                }
                $cycle++;
                $pixel = $cycle - (count($crt) * 40);
                $sprite = [$x - 1, $x, $x + 1];
                $crtLine .= in_array($pixel, $sprite) ? '#' : '.';

                if (strlen($crtLine) == 40) {
                    $crt[] = $crtLine;
                    $crtLine = '';
                    if (count($crt) === 6) break;
                }
            }
            //$x += $value;
            break;
    }
}

echo implode("\n", $crt);
