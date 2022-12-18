<?php

// this attempt can handle the small AOC example, doesn't complete within 3 hours for final input - ineffcient

namespace AOC\D12\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use AOC\Helper\InputReader;

class Point
{
    public function __construct(public int $x, public int $y)
    {
    }

    public function equals(Point $point): bool
    {
        return $this->x === $point->x && $this->y === $point->y;
    }

    public function __toString(): string
    {
        return $this->x . ',' . $this->y;
    }
}

class Path
{
    private $uniqid;

    public function __construct(array $visited = [])
    {
        $this->uniqid = uniqid('path-');

        foreach ($visited as $point) {
            $this->visited[(string) $point] = $point;
        }
    }

    /**
     * @return string
     */
    public function getUniqid(): string
    {
        return $this->uniqid;
    }

    private bool $terminated = false;

    private bool $completed = false;

    public function getVisited(): array
    {
        return $this->visited;
    }

    public function hasVisited(Point $point): bool
    {
        return array_key_exists((string) $point, $this->visited);
    }

    public function visit(Point $point)
    {
        $this->visited[(string) $point] = $point;
    }

    public function terminate(): void
    {
        $this->terminated = true;
    }

    public function complete(): void
    {
        $this->completed = true;
    }

    public function isComplete(): bool
    {
        return $this->completed;
    }

    public function hasCeased(): bool
    {
        return $this->terminated || $this->completed;
    }

    public function latest(): ?Point
    {
        return end($this->visited);
    }

    public function getVisitCount(): int
    {
        return count($this->visited);
    }

    public function __toString(): string
    {
        return $this->uniqid . ': ' . implode(' -> ', $this->visited);
    }
}

class PathFinder
{
    private array $grid = [];

    private array $paths = [];

    private Point $start;

    private Point $destination;

    private $iterations = 0;

    public function __construct(array $grid)
    {
        $this->grid = $grid;
        $this->formatGrid();
    }

    private function flipGridXY()
    {
        $flipped = [];

        foreach ($this->grid as $y => $line) {
            foreach ($line as $x => $height) {
                if (!isset($flipped[$x])) {
                    $flipped[$x] = [];
                }
                $flipped[$x][$y] = $height;
            }
        }

        $this->grid = $flipped;
    }

    private function formatGrid()
    {
        $this->flipGridXY();

        for ($x = 0; $x < count($this->grid); $x++) {
            for ($y = 0; $y < count($this->grid[0]); $y++) {
                $char = $this->grid[$x][$y];

                switch ($char) {
                    case 'S':
                        $this->start = new Point($x, $y);
                        break;
                    case 'E':
                        $this->destination = new Point($x, $y);
                        break;
                    default:
                        $this->grid[$x][$y] = ord($char) - 96;
                }
            }
        }
    }

    public function getValue(Point $point): string
    {
        return $this->grid[$point->x][$point->y];
    }

    private function getPossibleMoves(Point $point, ?Path $path): array
    {
        $possible = [];

        foreach ([[0, 1], [0,-1], [1,0], [-1,0]] as $adjustment) {
            [$ax, $ay] = $adjustment;
            $checkPoint = new Point($point->x + $ax, $point->y + $ay);

            // off the grid
            if (!isset($this->grid[$checkPoint->x][$checkPoint->y])) {
                continue;
            }

            // can't move to a position we've already visited
            if ($path !== null && $path->hasVisited($checkPoint)) {
                continue;
            }

            $value = $this->getValue($point);
            $checkValue = $this->getValue($checkPoint);
            $isDestination = $checkPoint->equals($this->destination);
            $isStart= $checkPoint->equals($this->start);
            $diff = (int) $checkValue - (int) $value;

            if (($diff < 2 || $isDestination) && !$isStart) {
                $possible[] = $checkPoint;
            }
        }

        return $possible;
    }

    public function find(): array
    {
        $possibleMoves = $this->getPossibleMoves($this->start, null);

        foreach ($possibleMoves as $possibleMove) {
            $path = new Path([$this->start, $possibleMove]);
            $this->addPath($path);
            $this->followPath($path);
        }

        return $this->paths;
    }

    private function addPath(Path $path)
    {
        $this->paths[$path->getUniqid()] = $path;
    }

    private function removePath(Path $path)
    {
        unset($this->paths[$path->getUniqid()]);
    }

    public function followPath(Path $path)
    {
        if ($path->hasCeased()) return;

        $head = $path->latest();
        $possibleMoves = $this->getPossibleMoves($head, $path);
        $chosenMove = array_pop($possibleMoves);

        // no possible moves
        if ($chosenMove === null) {
            $this->removePath($path);
            unset($path);
            return;
        }

        $visited = $path->getVisited();

        $this->addPointToPath($chosenMove, $path);

        foreach ($possibleMoves as $remainingMove) {
            $alternativePath = new Path($visited);
            $this->addPath($alternativePath);
            $this->addPointToPath($remainingMove, $alternativePath);
        }
    }

    public function addPointToPath(Point $point, Path $path)
    {
        if ($point->equals($this->destination)) {
            $path->complete();
        } elseif ($point->equals($this->start)) {
            $path->terminate();
            $this->removePath($path);
            unset($path);
            gc_collect_cycles();
        } else if ($path->hasVisited($point)) {
            $path->terminate();
            $this->removePath($path);
            unset($path);
            gc_collect_cycles();
        } else {
            $path->visit($point);
            $this->followPath($path);
        }
    }

    public static function fromFile(string $filename): self
    {
        $grid = [];

        foreach (InputReader::fileToLines($filename) as $line) {
            $grid[] = str_split($line);
        }

        return new self($grid);
    }
}

$finder = PathFinder::fromFile(__DIR__ . '/../input-example.txt');
$paths = $finder->find();
$completedPaths = array_filter($paths, fn (Path $path) => $path->isComplete());

$highestElevation = null;
foreach ($completedPaths as $path) {
    $elevation = $finder->getValue($path->latest());
    if ($highestElevation === null || $elevation > $highestElevation) {
        $highestElevation = $elevation;
    }
}

$highestElevationMatches = [];
$candidates = [];
foreach ($completedPaths as $path) {
    $elevation = $finder->getValue($path->latest());
    if ($elevation === $highestElevation) {
        $candidates[] = $path;
    }
}

$lowestVisitCount = null;
$shortestPath = null;

foreach ($candidates as $path) {
    if ($lowestVisitCount === null || $path->getVisitCount() < $lowestVisitCount) {
        $lowestVisitCount = $path->getVisitCount();
        $shortestPath = $path;
    }
}

echo "The shortest path I found took " . $lowestVisitCount . " steps to reach the destination\n";
echo "The path I took was:\n";
echo $shortestPath . "\n";

/**
 * - if (b - a < 2) // allowed
 *
 * 2[a] trying to go to 3[b]
 *      : (3-2) = 1
 *      : 1 < 2 = true
 *
 * 2[a] trying to go to 1[b]
 *      : (1-2) = -1
 *      : -1 < 2 = true
 *
 * 2[a] trying to go to 4[b]
 *      : (4-2) = 2
 *      : 2 < 2 = false
 *
 */

/**
 *          1,0
 * 0,1      1,1     2,1
 *          1,2
 */