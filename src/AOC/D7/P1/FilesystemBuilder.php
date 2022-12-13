<?php

namespace AOC\D7\P1;

use AOC\Helper\InputReader;

/**
 * Class FilesystemBuilder
 *
 * Builds a Filesystem instance from historic console output
 *
 * @package AOC\D7\P1
 */
class FilesystemBuilder
{
    /** @var string */
    private const PATTERN_CHANGE_DIR = '/\$ cd (?<path>\w+|..|\/)/';

    /** @var string */
    private const PATTERN_FILE = '/(?<size>\d+) (?<name>[a-z]+(.[a-z]+)?)/';

    /** @var string */
    private const PATTERN_DIR = '/dir (?<name>\w+)/';

    /**
     * Build from an input file of console output
     *
     * @param Filesystem $filesystem
     * @param string $filename
     *
     * @return Filesystem
     */
    public static function buildFromFile(int $totalSpace, string $filename): Filesystem
    {
        return self::build($totalSpace, array_filter(InputReader::fileToLines($filename)));
    }

    /**
     * Build from an array of console output
     *
     * @param int $totalSpace
     * @param array $consoleOutput
     *
     * @return Filesystem
     */
    public static function build(int $totalSpace, array $consoleOutput): Filesystem
    {
        $filesystem = new Filesystem($totalSpace);

        foreach ($consoleOutput as $line) {
            $arguments = [];

            switch (true) {
                case (bool) preg_match(self::PATTERN_CHANGE_DIR, $line, $arguments):
                    $filesystem->changeDirectory($arguments['path']);
                    break;

                case (bool) preg_match(self::PATTERN_FILE, $line,$arguments):
                    $filesystem->makeFile(new File($arguments['name'], (int) $arguments['size']));
                    break;

                case (bool) preg_match(self::PATTERN_DIR, $line,$arguments):
                    $filesystem->makeDirectory($arguments['name']);
                    break;
            }
        }

        return $filesystem->changeDirectory('/');
    }
}
