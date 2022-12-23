<?php

namespace AOC\D20\P1;

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$input = array_map('intval', InputReader::fileToLines(__DIR__ . '/../input.txt'));
$map = [];

foreach ($input as $value) {
    $map[uniqid($value . '-')] = $value;
}

$working = array_keys($map);

foreach ($map as $id => $places) {
    $working = move($working, $id, $places);
}

$zeroId = array_keys($map, 0)[0];
$zeroPosition = array_keys($working, $zeroId)[0];

$sum = [];
foreach ([1000, 2000, 3000] as $location) {
    $index = $zeroPosition;
    $value = 0;
    for ($i = 0; $i < $location; $i++) {
        $index++;
        $value = $working[$index];
        if ($index === count($working) - 1) {
            $index = -1;
        }
    }
    $sum[] = $map[$value];
}

echo json_encode($sum) . "\n";
$answer = array_sum($sum);

echo "Answer is $answer\n";

function move(array $data, string $id, int $places)
{
    if ($places === 0) return $data;

    $sourceIndex = array_keys($data, $id)[0];
    $next = $sourceIndex + $places;
    $divisions = $next / count($data);
    $divisionsRounded = $divisions > 0 ? floor($divisions) : ceil($divisions);
    $subtract = $divisionsRounded * count($data);
    if ($subtract > 0) $subtract--;
    $targetIndex = $next - $subtract;
    $finalTargetIndex = $targetIndex;

    if ($targetIndex <= 0) {
        $finalTargetIndex = (count($data) - 1) + $targetIndex;
    }

    $p1 = array_splice($data, $sourceIndex, 1);
    $p2 = array_splice($data, 0, $finalTargetIndex);

    return array_merge($p2, $p1, $data);
}
