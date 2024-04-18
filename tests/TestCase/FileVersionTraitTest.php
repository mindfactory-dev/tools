<?php

// declare(strict_types=1);

namespace Mindfactory\Tools\Test\TestCase;

use PHPUnit\Framework\TestCase;
use Mindfactory\Tools\FileVersionTrait;
use Mindfactory\Tools\FileNotFoundException;

class FileVersionTraitTest extends TestCase
{

    private $trait;

    private string $filesPath;

    public function setUp(): void
    {
        parent::setUp();

        $this->filesPath = dirname(__DIR__) . '/files/';

        $this->trait = new class
        {
            use FileVersionTrait;
        };
    }

    public function testReturnsFilePathWithNoVersionSubmitted(): void
    {
        $path = $this->filesPath . 'foo.php';
        $result = $this->trait->getFileVersion($path);
        $expected = $this->filesPath . 'foo.php';

        $this->assertEquals($expected, $result);
    }

    public function testReturnsExeptionWhenFileDosentExists(): void
    {
        $path = $this->filesPath . 'wrong-name.php';

        try {
            $this->trait->getFileVersion($path);
        } catch (FileNotFoundException $e) {
            $this->assertTrue(true);
            return;
        }
        $this->fail('Dosent return FileNotFoundException');
    }

    public function testReturnsRightPathWhenVersionSubmitedAsString(): void
    {
        $path = $this->filesPath . 'foo.php';

        $result = $this->trait->getFileVersion($path, 'a');
        $expected = $this->filesPath . 'foo-a.php';

        $this->assertEquals($expected, $result);
    }

    public function testReturnsRightPathWhenVersionSubmitedAsArrayAndOneParamter(): void
    {
        $path = $this->filesPath . 'foo.php';

        $result = $this->trait->getFileVersion($path, ['a']);
        $expected = $this->filesPath . 'foo-a.php';

        $this->assertEquals($expected, $result);
    }

    public function testReturnsRightPathWhenVersionSubmitedAsArrayAndTwoParamters(): void
    {
        $path = $this->filesPath . 'foo.php';

        $result = $this->trait->getFileVersion($path, ['a', 'b']);
        $expected = $this->filesPath . 'foo-a-b.php';

        $this->assertEquals($expected, $result);
    }

    public function testReturnsRightPathWhenVersionSubmitedAsArrayAndThreeParamtersAndLastParameterDontExists(): void
    {
        $path = $this->filesPath . 'foo.php';

        $result = $this->trait->getFileVersion($path, ['a', 'b', 'c']);
        $expected = $this->filesPath . 'foo-a-b.php';

        $this->assertEquals($expected, $result);
    }

    public function testReturnsRightPathWhenVersionSubmitedAsArrayAndTwoParamtersAndLastParameterDontExists(): void
    {
        $path = $this->filesPath . 'foo.php';

        $result = $this->trait->getFileVersion($path, ['a', 'c']);
        $expected = $this->filesPath . 'foo-a.php';

        $this->assertEquals($expected, $result);
    }

    public function testReturnsRightPathWhenVersionSubmitedAsArrayAndOneParamterThatDontExists(): void
    {
        $path = $this->filesPath . 'foo.php';

        $result = $this->trait->getFileVersion($path, ['c']);
        $expected = $this->filesPath . 'foo.php';

        $this->assertEquals($expected, $result);
    }

    public function testReturnsRightPathWhenVersionSubmitedAsStringAndOneParamterThatDontExists(): void
    {
        $path = $this->filesPath . 'foo.php';

        $result = $this->trait->getFileVersion($path, 'c');
        $expected = $this->filesPath . 'foo.php';

        $this->assertEquals($expected, $result);
    }
}
