<?php

declare(strict_types=1);

namespace Eihen\JasperPHP;

/**
 * Oracle Processor.
 *
 * Process reports with Oracle database as Data Source
 */
class OracleProcessor extends DatabaseProcessor
{
    /**
     * OracleProcessor constructor.
     */
    public function __construct()
    {
        $this->args['type'] = '-t "oracle"';
    }

    /**
     * Set the Oracle Database SID.
     *
     * @param string $sid Database SID
     *
     * @return $this
     */
    public function sid(string $sid)
    {
        $this->args['oracleSid'] = !empty($sid) ? '--db-sid '.escapeshellarg($sid) : '';

        return $this;
    }
}
