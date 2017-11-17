<?php

namespace Eihen\JasperPHP;

/**
 * Compiler
 *
 * Compile .jrxml files into .jasper files
 *
 * @package Eihen\JasperPHP
 */
class Compiler extends JasperBase
{
    /**
     * Compile .jrxml files into .jasper files
     *
     * @param string $input Input file or directory containing the files
     *
     * @throws \Exception
     */
    public function compile($input)
    {
        $input = static::validateInput($input, ['jrxml']);

        $returnCode = 0;
        $commandOutput = [];

        exec(
            constant('JASPERSTARTER_BIN') . " $this->locale compile \"$input\" $this->output 2>&1",
            $commandOutput,
            $returnCode
        );

        if ($returnCode !== 0) {
            throw new \Exception(implode("\n", $commandOutput));
        }
    }
}
