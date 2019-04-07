<?php

namespace BowlingGame;

use InvalidArgumentException;

class FrameWithBonus implements IFrame
{
    /**
     * @var Frame[]
     */
    private $frames;

    function __construct(Ball $first, ?Ball $second = null, ?Ball $bonus = null)
    {
        $this->frames[] = new Frame($first, $second);
        $this->frames[] = new Frame($bonus ?? Ball::generate(0));
    }


    /**
     * {@inheritDoc}
     */
    public function getPinsOf(int $ball) : int
    {
        if($ball < 1 && $ball > 3)
            throw new InvalidArgumentException('ball index should be between 1 and 3');

        return $this->frames[($ball - 1) / 2]->getPinsOf($ball % 2 ? 1 : 2);
    }


    /**
     * {@inheritDoc}
     */
    public function getPins() : int
    {
        return array_reduce(
            $this->frames,
            function (int $sum, Frame $frame) { return $sum + $frame->getPins(); },
            0
        );
    }


    /**
     * {@inheritDoc}
     */
    public function isStrike() : bool
    {
        return $this->frames[0]->isStrike();
    }


    /**
     * {@inheritDoc}
     */
    public function isSpare() : bool
    {
        return $this->frames[0]->isSpare();
    }


    /**
     * {@inheritDoc}
     */
    public function getScore() : int
    {
        return $this->getPins();
    }


    /**
     * {@inheritDoc}
     */
    public function setNextFrame(IFrame $next)
    {
        // nothing to do
        return;
    }


    protected function calc(Frame $previous) : int
    {
        if($previous->isSpare())
            return $this->getPinsOf(1)          + $previous->getPins();

        if($previous->isStrike())
            return $this->getPinsWithoutBonus() + $previous->getPins();

        return $previous->getPins();
    }


    private function getPinsWithoutBonus() : int
    {
        return $this->frames[0]->getPins();
    }
}
