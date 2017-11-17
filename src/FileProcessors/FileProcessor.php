<?php

declare(strict_types = 1);

namespace Eihen\JasperPHP;

/**
 * File Processor
 *
 * Base for specific file types processors
 *
 * @package Eihen\JasperPHP
 */
abstract class FileProcessor extends Processor
{
    /**
     * FileProcessor constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set the Data Source input file
     *
     * @param string $file File path
     *
     * @return $this
     */
    public function file($file)
    {
        $this->args['file'] = !empty($file) ? "--data-file \"$file\"" : '';

        return $this;
    }
}
