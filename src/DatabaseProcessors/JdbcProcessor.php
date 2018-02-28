<?php

namespace Eihen\JasperPHP;

/**
 * JDBC Processor
 *
 * Process reports with any database as Data Source, for which a JDBC driver can be provided
 *
 * @package Eihen\JasperPHP
 */
class JdbcProcessor extends DatabaseProcessor
{
    /**
     * JdbcProcessor constructor.
     */
    public function __construct()
    {
        $this->args['type'] = '-t "generic"';
    }

    /**
     * Set the JDBC Driver
     *
     * @param string $driver Driver Class Name
     *
     * @return $this
     */
    public function class($driver)
    {
        $this->args['jdbcDriver'] = !empty($driver) ? '--db-driver ' . escapeshellarg($driver) : '';

        return $this;
    }

    /**
     * Set the JDBC Url (without user and password)
     *
     * @param string $url JDBC Url
     *
     * @return $this
     */
    public function url($url)
    {
        $this->args['jdbcUrl'] = !empty($url) ? '--db-url ' . escapeshellarg($url) : '';

        return $this;
    }

    /**
     * Set the directory where the JDBC Drivers .jar files are located
     * Default to "./jdbc"
     *
     * @param string $dir Path to JDBC Drivers directory
     *
     * @return $this
     */
    public function dir($dir)
    {
        $this->args['jdbcDir'] = !empty($dir) ? '--jdbc-dir ' . escapeshellarg($dir) : '';

        return $this;
    }
}
