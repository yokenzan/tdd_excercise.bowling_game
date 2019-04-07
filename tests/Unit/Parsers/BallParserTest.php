<?php

namespace Tests\Unit\Parsers;

use BowlingGame\Ball;
use BowlingGame\Parsers\BallParser;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BallParserTest extends TestCase
{
    /**
     * @var BallParser
     */
    private $parser;


    public function setUp() : void
    {
        parent::setUp();
        $this->parser = new BallParser();
    }


    public function testParseBall()
    {
        $this->assertEquals(Ball::generate(1),  $this->parser->parse('1'));
        $this->assertEquals(Ball::generate(2),  $this->parser->parse('2'));
    }


    public function testParseStrikeBall()
    {
        $this->assertEquals(Ball::generate(10), $this->parser->parse('X'));
    }


    public function testParseSpareBall()
    {
        $firstPins = 7;

        $this->assertEquals(Ball::generate(3), $this->parser->parse('/', $firstPins));
    }


    public function testParseEmptyBall()
    {
        $this->assertEquals(Ball::generate(0), $this->parser->parse('-'));
    }


    public function testShouldThrowsExceptionIfArgumentIsInvalidFormat()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for score of ball');

        $invalidText = '#';
        $this->parser->parse($invalidText);
    }
}
