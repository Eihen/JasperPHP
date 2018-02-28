<?php

declare(strict_types=1);

namespace Eihen\JasperPHP;

/**
 * PostgreSQL Processor.
 *
 * Process reports with PostgreSQL database as Data Source
 */
class PostgresProcessor extends DatabaseProcessor
{
    /**
     * PostgresProcessor constructor.
     */
    public function __construct()
    {
        $this->args['type'] = '-t "postgres"';
    }
}
