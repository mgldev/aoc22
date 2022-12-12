<?php

namespace AOC\D5\P1;

use AOC\Helper\InputReader;
use Exception;

/**
 * Class RearrangementProcedure
 *
 * @package AOC\D5\P1
 */
class RearrangementProcedure
{
    /**
     * RearrangementProcedure constructor
     *
     * @param Cargo $cargo
     * @param CraneInteface $crane
     * @param array $instructions
     */
    public function __construct(
        private Cargo $cargo,
        private CraneInteface $crane,
        private array $instructions
    ) {
    }

    /**
     * @return string   The crates from the top of each stack stitched together after the rearrangement procedure
     */
    public function execute(): string
    {
        foreach ($this->instructions as $instruction) {
            $cargo = $this->crane->moveByInstruction($this->cargo, $instruction);
        }

        return $cargo->getStackTopsAsString();
    }

    /**
     * Create a rearrangement procedure for a given input $filename and a given $crane type
     *
     * @param string $filename
     * @param CraneInteface $crane
     *
     * @return static
     *
     * @throws Exception
     */
    public static function fromInput(string $filename, CraneInteface $crane): self
    {
        $cargo = Cargo::fromFile($filename);

        $instructions = [];

        foreach (InputReader::fileToLines($filename) as $instruction) {
            if ($crane->isValidInstruction($instruction)) {
                $instructions[] = $instruction;
            }
        }

        return new self($cargo, $crane, $instructions);
    }
}