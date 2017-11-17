<?php

namespace Eihen\JasperPHP;

/**
 * MySQL Processor
 *
 * Process reports with MySQL database as Data Source
 *
 * @package Eihen\JasperPHP
 */
class MySqlProcessor extends DatabaseProcessor
{
    /**
     * MysqlProcessor constructor.
     */
    public function __construct()
    {
        $this->args['type'] = '-t mysql';
    }
}
