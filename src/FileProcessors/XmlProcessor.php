<?php

declare(strict_types = 1);

namespace Eihen\JasperPHP;

/**
 * XML Processor
 *
 * Process reports with XML file as Data Source
 *
 * @package Eihen\JasperPHP
 */
class XmlProcessor extends FileProcessor
{
    /**
     * XmlProcessor constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->args['type'] = '-t xml';
    }

    /**
     * Set the Data Source XPath
     *
     * @param string $xpath
     *
     * @return $this
     */
    public function xpath(string $xpath)
    {
        $this->args['xpath'] = !empty($xpath) ? "--xml-xpath $xpath" : '';

        return $this;
    }
}
