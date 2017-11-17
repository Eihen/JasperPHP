<?php

declare(strict_types = 1);

namespace Eihen\JasperPHP;

/**
 * CSV Processor
 *
 * Process reports with CSV file as Data Source
 *
 * @package Eihen\JasperPHP
 */
class CsvProcessor extends FileProcessor
{
    /**
     * @var array CSV file column list
     */
    protected $columns;

    /**
     * CsvProcessor constructor.
     */
    final public function __construct()
    {
        $this->args['type'] = '-t csv';
    }

    /**
     * The CSV first row contains column headers
     *
     * @return $this
     */
    public function csvFirstRow()
    {
        $this->args['csvFirstRow'] = '--csv-first-row';
        return $this;
    }

    /**
     * Add a column
     *
     * @param string $column
     *
     * @return $this
     */
    public function column(string $column)
    {
        if (!empty($column)) {
            $this->columns[] = $column;
        }

        return $this;
    }

    /**
     * Add a list of columns
     *
     * @param array $columns
     *
     * @return $this
     */
    public function columns(array $columns)
    {
        $this->columns = array_merge($this->columns, $columns);
        return $this;
    }

    /**
     * Set the field delimiter
     * Defaults to ","
     *
     * @param string $delimiter Delimiter
     *
     * @return $this
     */
    public function fieldDelimiter(string $delimiter)
    {
        $this->args['csvFieldDelimiter'] = !empty($delimiter) ? "--csv-field-del \"$delimiter\"" : '';

        return $this;
    }

    /**
     * Set the record delimiter
     * Defaults to line separator
     *
     * @param string $delimiter Delimiter
     *
     * @return $this
     */
    public function recordDelimiter(string $delimiter)
    {
        $this->args['csvRecordDelimiter'] = !empty($delimiter) ? "--csv-record-del \"$delimiter\"" : '';

        return $this;
    }

    /**
     * Set the charset
     * Defaults to "utf-8"
     *
     * @param string $charset Charset code
     *
     * @return $this
     */
    public function charset(string $charset)
    {
        $this->args['csvCharset'] = !empty($charset) ? "--csv-charset \"$charset\"" : '';

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
    public function process(string $input, array $formats)
    {
        if (count($this->columns) > 0) {
            $this->args['csvColumns'] = '--csv-columns '
                . implode(' ', $this->columns);
        }

        parent::process($input, $formats);
    }
}
