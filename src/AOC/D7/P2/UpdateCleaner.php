<?php

namespace AOC\D7\P2;

use AOC\D7\P1\Directory;
use AOC\D7\P1\Filesystem;

/**
 * Class UpdateCleaner
 *
 * @package AOC\D7\P2
 */
class UpdateCleaner
{
    /**
     * UpdateCleaner constructor
     *
     * @param Filesystem $filesystem
     */
    public function __construct(private readonly Filesystem $filesystem)
    {
    }

    /**
     * Determine which directory should be removed in order to apply the update
     *
     * @param int $updateFileSize   The filesize of the update
     *
     * @return Directory    The directory to remove
     */
    public function getDirectoryToRemove(int $updateFileSize): Directory
    {
        $remainingSpace = $this->filesystem->getRemainingSpace();
        $spaceToFree = $updateFileSize - $remainingSpace;
        $spaceSummary = $this->filesystem->getSubdirectorySizes();
        $candidates = array_filter($spaceSummary, fn (int $filesize) => $filesize > $spaceToFree);

        return $this->filesystem->getDirectory(implode(array_keys($candidates, min($candidates))));
    }
}
