<?php

declare(strict_types=1);

namespace Eihen\JasperPHP;

/**
 * JasperBase
 *
 * Basic interface with the JasperStarter cli tool
 *
 * @package Eihen\JasperPHP
 */
abstract class JasperBase
{
    /** @var string Output path */
    protected $output = '';

    /** @var string Locale code */
    protected $locale = '';

    /**
     * Set the output directory and file name prefix
     * Format: path/to/output/prefix
     *
     * @param string $output
     * @return $this
     */
    public function output(string $output)
    {
        if (!empty($output)) {
            $info = pathinfo($output);
            // Checks if the full output is a valid directory
            if (($dir = realpath($output)) && is_dir($dir)) {
                $output = $dir;
            } // Checks if the dirname of the output is a valid directory
            elseif (($dir = realpath($info['dirname'])) && is_dir($dir)) {
                $output = $dir . '/' . $info['filename'];

                // To avoid .jasper.jasper since JasperStarter always adds the extension
                if (isset($info['extension']) && $info['extension'] != 'jasper') {
                    $output .= $info['extension'];
                }
            } else {
                throw new \InvalidArgumentException('The directory of the output is invalid.');
            }
        }

        $this->output = '-o ' . escapeshellarg($output);
        return $this;
    }

    /**
     * Set the locale used to process the report
     * Use ISO-639 two letter code (en) or a combination of ISO-639 and ISO_3166 codes (en_US)
     *
     * @param string $locale Locale code
     *
     * @return $this
     */
    public function locale(string $locale)
    {
        $this->locale = !empty($locale) ? '--locale ' . escapeshellarg($locale) : '';

        return $this;
    }

    /**
     * Validates input file and returns it's real path
     *
     * @param string $input Path to the input file
     * @param array $acceptedFormats Accepted formats
     *
     * @return string
     */
    protected static function validateInput(string $input, array $acceptedFormats)
    {
        if (empty($input)) {
            throw new \InvalidArgumentException('Input file not defined.');
        }

        if (!is_file($input)) {
            throw new \InvalidArgumentException('Input is not a file.');
        }

        if (!in_array(pathinfo($input, PATHINFO_EXTENSION), $acceptedFormats)) {
            throw new \InvalidArgumentException('Invalid input file format.');
        }

        return escapeshellarg(realpath($input));
    }
}
