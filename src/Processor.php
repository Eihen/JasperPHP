<?php

namespace Eihen\JasperPHP;

/**
 * Base Processor
 *
 * Process reports without Data Source
 *
 * Base for other processors
 *
 * @package Eihen\JasperPHP
 */
class Processor extends JasperBase
{
    const VALID_OUTPUTS = [
        'view',
        'print',
        'pdf',
        'rtf',
        'xls',
        'xlsMeta',
        'xlsx',
        'docx',
        'odt',
        'ods',
        'pptx',
        'csv',
        'csvMeta',
        'html',
        'xhtml',
        'xml',
        'jrprint'
    ];
    const VALID_INPUTS = ['jrxml', 'jasper', 'jrprint'];

    protected $args = [];
    protected $params = [];

    /**
     * Compile the input .jrxml file to .jasper before processing the report
     * Saves the .jasper file in the same directory as the input file
     *
     * @return $this
     */
    public function writeJasper()
    {
        $this->args['writeJasper'] = '--write-jasper';
        return $this;
    }

    /**
     * Add report parameter
     *
     * @param string $key Parameter name
     * @param string $value Parameter value
     *
     * @return $this
     */
    public function param($key, $value)
    {
        $this->params[$key] = !empty($key) ? "$value" : '';

        return $this;
    }

    /**
     * Add report parameters
     *
     * @param array $params Parameters in the [name1=>value1,nam2=>value2,...] form
     *
     * @return $this
     */
    public function params($params)
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    /**
     * Set the path to the resource directory or jar file
     * If not given the input directory is used
     *
     * @param string $path Resource path
     *
     * @return $this
     */
    public function resource($path)
    {
        $this->args['resource'] = !empty($path) ? "-r $path" : '';

        return $this;
    }

    /**
     * Set the CSV output file delimiter
     * Defaults to ","
     *
     * @param string $delimiter
     *
     * @return $this
     */
    public function outDelimiter($delimiter)
    {
        $this->args['delimiter'] = !empty($delimiter) ? "--out-field-del $delimiter" : '';

        return $this;
    }

    /**
     * Set the CSV output file charset
     * Defaults to "utf-8"
     *
     * @param string $charset
     *
     * @return $this
     */
    public function charset($charset)
    {
        $this->args['charset'] = !empty($charset) ? "--out-charset $charset" : '';

        return $this;
    }

    /**
     * Process the input file and outputs reports in the specified formats
     * Supported input file formats: jrxml, jasper, jrprint
     * Supported output formats: view, print, pdf, rtf, xls, xlsMeta, xlsx,
     *  docs, odt, ods, pptx, csv, csvMeta, html, xhtml, xml, jrprint
     *
     * @param string $input Input file
     * @param array $formats Output formats int the [format1, format2,...] form
     *
     * @throws \Exception
     */
    public function process($input, $formats)
    {
        $input = static::validateInput($input);

        $formats = array_unique($formats);
        $unsupported = array_diff($formats, static::VALID_OUTPUTS);
        if (count($unsupported) > 0) {
            throw new \InvalidArgumentException('The output formats ' .
                implode(', ', $unsupported) . ' are not supported.');
        }

        $args = '-f ' . implode(' ', $formats);
        $args .= $this->implodeParams();
        $args .= ' ' . implode(' ', $this->args);

        $returnCode = 0;
        $commandOutput = [];

        exec(
            constant('JASPERSTARTER_BIN') . " $this->locale process \"$input\"  $this->output $args 2>&1",
            $commandOutput,
            $returnCode
        );

        if ($returnCode !== 0) {
            throw new \Exception(implode("\n", $commandOutput));
        }
    }

    /**
     * Validates input file format with the accept formats
     *
     * @param string $input Path to the input file
     * @param array $acceptedFormats Accepted formats (defaults to self::VALID_INPUTS)
     *
     * @return string
     */
    protected static function validateInput($input, $acceptedFormats = self::VALID_INPUTS)
    {
        return parent::validateInput($input, $acceptedFormats);
    }

    /**
     * Implode the array of parameters into the JasperStarter equivalent command
     *
     * @return string
     */
    protected function implodeParams()
    {
        if (count($this->params) > 0) {
            $args = ' -P';
            foreach ($this->params as $key => $value) {
                $args .= " $key=\"$value\"";
            }

            return $args;
        }

        return '';
    }
}
