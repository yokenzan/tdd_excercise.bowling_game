<?php

namespace Tests\Unit;

use BowlingGame\Ball;
use BowlingGame\Frame;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FrameTest extends TestCase
{
    public function testShouldThrowExceptionIfKnockedPinsOfBallsGreaterThan10()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'count of pins should be equel or less than 10'
        );

        new Frame(new Ball(10), new Ball(10));
    }


    public function testShouldReturnCountOfKnokedPinsOfEachBall()
    {
        $frame = new Frame(new Ball(4), new Ball(3));

        $this->assertEquals(4, $frame->getPinsOf(1));
        $this->assertEquals(3, $frame->getPinsOf(2));
    }


    public function testShouldReturnSumOfKnokedPins()
    {
        $frame = new Frame(new Ball(4), new Ball(3));

        $this->assertEquals(4 + 3, $frame->getPins());
    }


    public function testShouldBeStrikeIf10PinsKnokedInFirstBall()
    {
        $frame = new Frame(new Ball(10), new Ball(0));

        $this->assertTrue($frame->isStrike());
        $this->assertFalse($frame->isSpare());
    }


    public function testShouldBeSpareIfIsNotStrikeAnd10PinsKnokedInFrame()
    {
        $frame = new Frame(new Ball(3), new Ball(7));

        $this->assertFalse($frame->isStrike());
        $this->assertTrue($frame->isSpare());
    }
}
