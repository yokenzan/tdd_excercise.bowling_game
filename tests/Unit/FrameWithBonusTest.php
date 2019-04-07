<?php

namespace Tests\Unit;

use BowlingGame\Ball;
use BowlingGame\Frame;
use BowlingGame\FrameWithBonus;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FrameWithBonusTest extends TestCase
{
    public function testShouldThrowExceptionIfKnockedPinsOfFirst2BallsGreaterThan10()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'count of pins should be equel or less than 10'
        );

        new FrameWithBonus(new Ball(10), new Ball(10));
    }


    public function testShouldReturnCountOfKnokedPinsOfEachBall()
    {
        $frame = new FrameWithBonus(new Ball(4), new Ball(2), new Ball(6));

        $this->assertEquals(4, $frame->getPinsOf(1));
        $this->assertEquals(2, $frame->getPinsOf(2));
        $this->assertEquals(6, $frame->getPinsOf(3));
    }


    public function testStrikeOrSpareShouldBeDeterminedByFirst2Balls()
    {
        $spareFrame    = new FrameWithBonus(new Ball(4),  new Ball(6), new Ball(6));
        $strikeFrame   = new FrameWithBonus(new Ball(10), new Ball(0), new Ball(6));
        $ordinaryFrame = new FrameWithBonus(new Ball(4),  new Ball(2), new Ball(6));

        $this->assertTrue($spareFrame    ->isSpare());
        $this->assertFalse($strikeFrame  ->isSpare());
        $this->assertFalse($ordinaryFrame->isSpare());

        $this->assertFalse($spareFrame   ->isStrike());
        $this->assertTrue($strikeFrame   ->isStrike());
        $this->assertFalse($ordinaryFrame->isStrike());
    }
}
