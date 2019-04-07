<?php

namespace Tests\Unit\Parsers;

use BowlingGame\Ball;
use BowlingGame\Frame;
use BowlingGame\FrameWithBonus;
use BowlingGame\Game;
use BowlingGame\Parsers\BallParser;
use BowlingGame\Parsers\FrameParser;
use BowlingGame\Parsers\GameParser;
use PHPUnit\Framework\TestCase;

class GameParserTest extends TestCase
{
    /**
     * @var GameParser
     */
    private $parser;


    public function setUp() : void
    {
        parent::setUp();
        $this->parser = new GameParser(
            new FrameParser(new BallParser())
        );
    }


    public function testParseGame()
    {
        $game   = new Game();
        $frames = [
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(7), Ball::generate(3)),
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(0), Ball::generate(8)),
            new Frame(Ball::generate(8), Ball::generate(2)),
            new Frame(Ball::generate(0), Ball::generate(6)),
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(10)),
            new FrameWithBonus(
                Ball::generate(10), Ball::generate(8), Ball::generate(1)
            ),
        ];

        foreach($frames as $frame) $game->addFrame($frame);

        $this->assertEquals($game, $this->parser->parse('X|7/|9-|X|-8|8/|-6|X|X|X||81'));
    }
}
