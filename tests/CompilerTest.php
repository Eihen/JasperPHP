<?php

namespace Eihen\JasperPHP\Tests;

use Eihen\JasperPHP\Compiler;
use PHPUnit\Framework\TestCase;

/**
 * Class CompilerTest
 *
 * @covers \Eihen\JasperPHP\Compiler
 */
class CompilerTest extends TestCase
{
    /**
     * @return Compiler
     */
    public function testConstruct()
    {
        $compiler = new Compiler();
        $this->assertInstanceOf(Compiler::class, $compiler);
        return $compiler;
    }

    /**
     * Data provider for valid compile tests that should succeed
     *
     * @return array
     */
    public function compileProvider()
    {
        return [
            'No File Name' => [__DIR__ . '/jrxml/Simple.jrxml', __DIR__ . '/generated/'],
            'No Extension' => [__DIR__ . '/jrxml/Simple.jrxml', __DIR__ . '/generated/SimpleNoExt'],
            'Jasper Extension' => [__DIR__ . '/jrxml/Simple.jrxml', __DIR__ . '/generated/SimpleJasperExt.jasper'],
            'Empty Output' => [__DIR__ . '/jrxml/Simple.jrxml', ''],
        ];
    }

    /**
     * @dataProvider compileProvider
     * @depends      testConstruct
     *
     * @param string $input
     * @param string $output
     * @param Compiler $compiler
     */
    public function testCompile($input, $output, Compiler $compiler)
    {
        $compiler->output($output)->compile($input);

        $inputInfo = pathinfo($input);

        if (empty($output)) {
            $output = $inputInfo['dirname'] . '/' . $inputInfo['filename'] . '.jasper';
        } elseif (is_dir($output)) {
            $output .= '/' . $inputInfo['filename'] . '.jasper';
        } elseif (pathinfo($output, PATHINFO_EXTENSION) !== 'jasper') {
            $output .= '.jasper';
        }

        $this->assertFileExists($output);
        /*$this->assertEquals(
            filesize(realpath(__DIR__ . '/jasper/' . $inputInfo['filename'] . '.jasper')),
            filesize($output)
        );*/
    }

    /**
     * @depends testConstruct
     *
     * @param Compiler $compiler
     */
    public function testEmptyInput(Compiler $compiler)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Input file not defined.');
        $compiler->compile('');
    }

    /**
     * @depends testConstruct
     *
     * @param Compiler $compiler
     */
    public function testNotFileInput(Compiler $compiler)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Input is not a file.');
        $compiler->compile(__DIR__ . 'notexistentfile.input');
    }

    /**
     * @depends testConstruct
     *
     * @param Compiler $compiler
     */
    public function testInvalidFormatInput(Compiler $compiler)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMEssage('Invalid input file format.');
        $compiler->compile(__FILE__);
    }
}
