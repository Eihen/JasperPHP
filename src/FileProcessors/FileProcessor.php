<?php

namespace Eihen\JasperPHP;

/**
 * File Processor.
 *
 * Base for specific file types processors
 */
abstract class FileProcessor extends Processor
{
    /**
     * Set the Data Source input file.
     *
     * @param string $file File path
     *
     * @return $this
     */
    public function file($file)
    {
        $this->args['file'] = !empty($file) ? '--data-file '.escapeshellarg($file) : '';

        return $this;
    }
}
