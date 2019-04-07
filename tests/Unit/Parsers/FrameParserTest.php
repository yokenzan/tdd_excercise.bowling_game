<?php

namespace Tests\Unit\Parsers;

use BowlingGame\Ball;
use BowlingGame\Frame;
use BowlingGame\FrameWithBonus;
use BowlingGame\Parsers\BallParser;
use BowlingGame\Parsers\FrameParser;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FrameParserTest extends TestCase
{
    /**
     * @var FrameParser
     */
    private $parser;


    public function setUp() : void
    {
        parent::setUp();
        $this->parser = new FrameParser(new BallParser());
    }


    public function testParseFrames()
    {
        $this->assertEquals(
            new Frame(Ball::generate(1), Ball::generate(1)),
            $this->parser->parse('11')
        );

        $this->assertEquals(
            new Frame(Ball::generate(9), Ball::generate(1)),
            $this->parser->parse('9/')
        );

        $this->assertEquals(
            new Frame(Ball::generate(9)), $this->parser->parse('9')
        );

        $this->assertEquals(
            new Frame(Ball::generate(10)), $this->parser->parse('X')
        );

        $this->assertEquals(
            new FrameWithBonus(
                Ball::generate(10), Ball::generate(10), Ball::generate(10)
            ),
            $this->parser->parse('X||XX')
        );
    }

}
