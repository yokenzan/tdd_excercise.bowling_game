<?php

namespace Tests\Unit;

use BowlingGame\Ball;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BallTest extends TestCase
{
    public function testShouldBeInstanciationableWithFactoryMehtod()
    {
        $instance = Ball::generate(4);
        $this->assertEquals(new Ball(4), $instance);
    }


    public function testShouldReturnCountOfKnokedPins()
    {
        $pins   = 5;
        $object = Ball::generate($pins);
        $this->assertEquals($pins, $object->getPins());
    }


    public function testShouldThrowExceptionIfKnokedPinsAreGreaterThan10()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'count of pins should be equel or less than 10'
        );

        $pins   = 11;
        $object = Ball::generate($pins);
    }


    public function testShouldThrowsExceptionIfKnokedPinsAreLessThan0()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'count of pins should be equel or greater than 0'
        );

        $pins   = -1;
        $object = Ball::generate($pins);
    }
}
