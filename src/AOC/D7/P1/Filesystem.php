<?php

namespace AOC\D7\P1;

use AOC\D7\P1\Exception\DirectoryNotFoundException;

/**
 * Class Filesystem
 *
 * Represents a virtual unix filesystem
 *
 * @package AOC\D7\P1
 */
class Filesystem
{
    /** @var Directory  The root of the filesystem (i.e. /) */
    protected Directory $root;

    /** @var Directory  The current working directory */
    protected Directory $cwd;

    /**
     * Filesystem constructor
     *
     * @param int $totalSpace
     */
    public function __construct(private readonly int $totalSpace)
    {
        $this->cwd = $this->root = new Directory('/', null);
    }

    /**
     * Make a directory in the current working directory for the given $name
     *
     * @param string $name
     *
     * @return $this
     */
    public function makeDirectory(string $name): self
    {
        $this->cwd->addSubDirectory($name);

        return $this;
    }

    /**
     * Make a file in the current working directory for the given $file
     *
     * @param File $file
     *
     * @return $this
     */
    public function makeFile(File $file): self
    {
        $this->cwd->addFile($file);

        return $this;
    }

    /**
     * Change the current directory to the specified path
     *
     * - "/" will go to the root
     * - "/foo/bar" will go to a specific path relative to the root directory
     * - "foo/bar" will go to a specific path relative to the current directory
     * - ".." will go to the parent directory
     *
     * @param string $path
     *
     * @return $this
     */
    public function changeDirectory(string $path): self
    {
        $this->cwd = $this->getDirectory($path);

        return $this;
    }

    /**
     * Get the directory for the given $path
     *
     * @param string $path
     *
     * @return Directory
     */
    public function getDirectory(string $path): Directory
    {
        return match (true) {
            $path === '..' => $this->cwd->getParent(),
            str_starts_with($path, '/') => $this->getDirectoryByPath($path, $this->root),
            default => $this->getDirectoryByPath($path, $this->cwd),
        };
    }

    /**
     * Finds the Directory instance for the given $path starting from the given $start Directory
     *
     * @param string $path
     *
     * @param Directory $start
     *
     * @return Directory
     */
    private function getDirectoryByPath(string $path, Directory $start): Directory
    {
        $dirNames = array_filter(explode('/', $path));
        $directory = $start;

        foreach ($dirNames as $dirName) {
            $directory = $directory->getSubDirectory($dirName);

            if ($directory === null) {
                throw new DirectoryNotFoundException('Directory not found');
            }
        }

        return $directory;
    }

    /**
     * List the contents of the current working directory (files and directories)
     *
     * @return array[]
     */
    public function list(): array
    {
        $output = [
            'directories' => [],
            'files' => [],
        ];

        foreach ($this->cwd->getSubDirectories() as $subDirectory) {
            $output['directories'][] = $subDirectory->getName();
        }

        foreach ($this->cwd->getFiles() as $file) {
            $output['files'][] = $file->getName();
        }

        return $output;
    }

    /**
     * Get a recursive summary of all subdirectories within the current working director and their sizes
     *
     * @return array
     */
    public function getSubdirectorySizes(): array
    {
        return $this->cwd->getSubdirectorySizes();
    }

    /**
     * Get the current working directory path
     *
     * @return string
     */
    public function getCurrentWorkingDirectory(): string
    {
        return $this->cwd->getFullPath();
    }

    /**
     * @return int
     */
    public function getTotalSpace(): int
    {
        return $this->totalSpace;
    }

    /**
     * @return int
     */
    public function getUsedSpace(): int
    {
        return $this->root->getTotalSize();
    }

    /**
     * @return int
     */
    public function getRemainingSpace(): int
    {
        return $this->getTotalSpace() - $this->getUsedSpace();
    }
}
