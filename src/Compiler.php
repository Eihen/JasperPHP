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
     * @param bool $dontExec Don't execute the command, just return the command string
     *
     * @return null|string
     * @throws \Exception
     */
    public function compile($input, $dontExec = false)
    {
        $input = static::validateInput($input, ['jrxml']);

        $returnCode = 0;
        $commandOutput = [];

        $command = constant('JASPERSTARTER_BIN') . " $this->locale compile $input $this->output 2>&1";

        if ($dontExec) {
            return $command;
        }

        exec(
            $command,
            $commandOutput,
            $returnCode
        );

        if ($returnCode !== 0) {
            throw new \Exception(implode("\n", $commandOutput));
        }

        return null;
    }
}
