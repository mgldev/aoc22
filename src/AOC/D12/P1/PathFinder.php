<?php

namespace AOC\D12\P1;

use SplQueue;

/**
 * Class PathFinder
 *
 * @package AOC\D12\P1
 */
class PathFinder
{
    /**
     * @param NeighbourResolverInterface $neighbourResolver
     */
    public function __construct(private NeighbourResolverInterface $neighbourResolver)
    {
    }

    /**
     * @return Path|null
     */
    public function find(Point $start, Point $destination): ?Path
    {
        $queue = new SplQueue();
        $path = new Path([$start]);
        $queue->enqueue($path);

        $visited = [(string) $start];

        while ($queue->count() > 0) {
            /** @var Path $path */
            $path = $queue->dequeue();
            $node = $path->latest();

            if ($node->equals($destination)) {
                return $path;
            }

            $neighbours = $this->neighbourResolver->resolve($node);

            foreach ($neighbours as $neighbour) {
                if (!in_array((string) $neighbour, $visited)) {
                    $visited[] = (string) $neighbour;
                    $newPathVisits = $path->getVisited();
                    $newPathVisits[] = $neighbour;
                    $newPath = new Path($newPathVisits);
                    $queue->enqueue($newPath);
                }
            }
        }

        return null;
    }
}
