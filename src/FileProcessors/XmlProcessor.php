<?php

namespace Eihen\JasperPHP;

/**
 * XML Processor.
 *
 * Process reports with XML file as Data Source
 */
class XmlProcessor extends FileProcessor
{
    /**
     * XmlProcessor constructor.
     */
    public function __construct()
    {
        $this->args['type'] = '-t "xml"';
    }

    /**
     * Set the Data Source XPath.
     *
     * @param string $xpath
     *
     * @return $this
     */
    public function xpath($xpath)
    {
        $this->args['xpath'] = !empty($xpath) ? '--xml-xpath '.escapeshellarg($xpath) : '';

        return $this;
    }
}
