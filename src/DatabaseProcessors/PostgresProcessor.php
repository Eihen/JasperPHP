<?php

namespace Eihen\JasperPHP;

/**
 * PostgreSQL Processor
 *
 * Process reports with PostgreSQL database as Data Source
 *
 * @package Eihen\JasperPHP
 */
class PostgresProcessor extends DatabaseProcessor
{
    /**
     * PostgresProcessor constructor.
     */
    public function __construct()
    {
        $this->args['type'] = '-t postgres';
    }
}
