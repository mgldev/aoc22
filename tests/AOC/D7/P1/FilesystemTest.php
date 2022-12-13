<?php

namespace Tests\AOC\D7\P1;

use AOC\D7\P1\Filesystem;
use PHPUnit\Framework\TestCase;

/**
 * Class FilesystemTest
 *
 * ./vendor/bin/phpunit --filter FilesystemTest
 *
 * @package AOC\D7\P1
 */
class FilesystemTest extends TestCase
{
    /**
     * ./vendor/bin/phpunit --filter FilesystemTest::testChangeDirectory
     *
     * @return void
     */
    public function testChangeDirectory(): void
    {
        $fs = new Filesystem();

        $this->assertEquals('/', $fs->getCurrentWorkingDirectory());

        $fs->makeDirectory('foo');
        $this->assertEquals('/', $fs->getCurrentWorkingDirectory());

        $fs->changeDirectory('foo');
        $this->assertEquals('/foo', $fs->getCurrentWorkingDirectory());

        $fs->makeDirectory('bar')->changeDirectory('bar');
        $this->assertEquals('/foo/bar', $fs->getCurrentWorkingDirectory());

        $fs->changeDirectory('..');
        $this->assertEquals('/foo', $fs->getCurrentWorkingDirectory());
    }
}
