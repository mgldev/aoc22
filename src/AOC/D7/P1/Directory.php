<?php

namespace AOC\D7\P1;

/**
 * Class Directory
 *
 * @package AOC\D7\P1
 */
class Directory
{
    /** @var File[] */
    private array $files = [];

    /** @var Directory[]  */
    private array $subDirectories = [];

    /**
     * Directory constructor
     *
     * @param string $name
     * @param Directory|null $parent
     */
    public function __construct(private string $name, private ?Directory $parent)
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function addSubDirectory(string $name): void
    {
        $this->subDirectories[$name] = new Directory($name, $this);
    }

    /**
     * @param string $name
     *
     * @return Directory|null
     */
    public function getSubDirectory(string $name): ?Directory
    {
        return $this->subDirectories[$name] ?? null;
    }

    /**
     * @return Directory[]
     */
    public function getSubDirectories(): array
    {
        return $this->subDirectories;
    }

    /**
     * @return Directory|null
     */
    public function getParent(): ?Directory
    {
        return $this->parent;
    }

    public function addFile(File $file): self
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * @return File[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @return string
     */
    public function getFullPath(): string
    {
        $directory = $this;
        $paths = [];

        while ($directory !== null && $directory->getName() !== '/') {
            $paths[] = $directory->getName();
            $directory = $directory->getParent();
        }

        return '/' . implode('/', array_reverse($paths));
    }

    /**
     * @return int
     */
    public function getTotalSize(): int
    {
        $total = array_sum(array_map(fn (File $file) => $file->getSize(), $this->getFiles()));

        foreach ($this->getSubDirectories() as $subDirectory) {
            $total += $subDirectory->getTotalSize();
        }

        return $total;
    }

    /**
     * @return array
     */
    public function getSubdirectorySizes(): array
    {
        $sizes = [];

        foreach ($this->getSubDirectories() as $subDirectory) {
            $sizes[$subDirectory->getFullPath()] = $subDirectory->getTotalSize();
            $sizes = array_merge($sizes, $subDirectory->getSubdirectorySizes());
        }

        return $sizes;
    }
}
