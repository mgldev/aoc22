<?php

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$cycle = 0;
$x = 1;
$crt = [];

$crtLine = '';

foreach (InputReader::fileToLines(__DIR__ . '/../input.txt') as $instruction) {
    $parts = explode(' ', $instruction);
    $command = $parts[0];
    $value = isset($parts[1]) ? (int) $parts[1] : null;
    $sprite = [$x - 1, $x, $x + 1];

    switch ($command) {
        case 'noop':
            $cycle += 1;
            $crtLine .= in_array($cycle, $sprite) ? '#' : '.';
            echo $cycle . "\n";
            break;

        case 'addx':
            for ($i = 0; $i < 2; $i++) {
                $cycle++;
                echo $cycle . "\n";
                $crtLine .= in_array($cycle, $sprite) ? '#' : '.';
            }
            $x += $value;
            break;
    }

    if (strlen($crtLine) == 40) {
        echo "Rendering\n";
        $crt[] = $crtLine;
        $crtLine = '';
        if (count($crt) === 6) break;
    }
}

//echo implode("\n", $crt);
