<?php

namespace Tests\Unit;

use BowlingGame\Ball;
use BowlingGame\Frame;
use BowlingGame\Game;
use BowlingGame\FrameWithBonus;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testShouldCalculateScoreExampleCase1()
    {
        $game   = new Game();
        $frames = [
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(10)),
            new Frame(Ball::generate(10)),
            new FrameWithBonus(
                Ball::generate(10), Ball::generate(10), Ball::generate(10)
            ),
        ];

        foreach($frames as $frame) $game->addFrame($frame);

        $this->assertSame(300, $game->getScore());
    }


    public function testShouldCalculateScoreExampleCase2()
    {
        $game   = new Game();
        $frames = [
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(9)),
            new Frame(Ball::generate(9)),
        ];

        foreach($frames as $frame) $game->addFrame($frame);

        $this->assertSame(90, $game->getScore());
    }


    public function testShouldCalculateScoreExampleCase3()
    {
        $game   = new Game();
        $frames = [
            new Frame(Ball::generate(5), Ball::generate(5)),
            new Frame(Ball::generate(5), Ball::generate(5)),
            new Frame(Ball::generate(5), Ball::generate(5)),
            new Frame(Ball::generate(5), Ball::generate(5)),
            new Frame(Ball::generate(5), Ball::generate(5)),
            new Frame(Ball::generate(5), Ball::generate(5)),
            new Frame(Ball::generate(5), Ball::generate(5)),
            new Frame(Ball::generate(5), Ball::generate(5)),
            new Frame(Ball::generate(5), Ball::generate(5)),
            new FrameWithBonus(
                Ball::generate(5),Ball::generate(5), Ball::generate(5)
            ),
        ];

        foreach($frames as $frame) $game->addFrame($frame);

        $this->assertSame(150, $game->getScore());
    }


    public function testShouldCalculateScoreExampleCase4()
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

        $this->assertSame(167, $game->getScore());
    }

}
