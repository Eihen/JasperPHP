<?php

namespace Eihen\JasperPHP;

/**
 * JSON Processor.
 *
 * Process reports with JSON file as Data Source
 */
class JsonProcessor extends FileProcessor
{
    /**
     * JsonProcessor constructor.
     */
    public function __construct()
    {
        $this->args['type'] = '-t "json"';
    }

    /**
     * Set the JSON query string.
     *
     * @param string $query Query
     *
     * @return $this
     */
    public function query($query)
    {
        $this->args['jsonQuery'] = !empty($query) ? '--json-query '.escapeshellarg($query) : '';

        return $this;
    }
}
