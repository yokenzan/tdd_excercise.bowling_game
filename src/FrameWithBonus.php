<?php

namespace BowlingGame;

use InvalidArgumentException;

class FrameWithBonus implements IFrame
{
    /**
     * @var Frame[]
     */
    private $frames;

    function __construct(Ball $first, Ball $second, ?Ball $third = null)
    {
        $isStrike = $first->getPins() == 10;
        $isSpare  = !$isStrike && $first->getPins() + $second->getPins() == 10;

        if(!$isStrike && !$isSpare && func_num_args() == 3)
            throw new InvalidException(
                "neighter strike and spare frame doesn't have any bonus"
            );

        if($isStrike) {
            $this->frames[] = new Frame($first);
            $this->frames[] = new Frame($second);
            $this->frames[] = new Frame($third);
            return;
        }

        if($isSpare) {
            $this->frames[] = new Frame($first, $second);
            $this->frames[] = new Frame($third);
            return;
        }

        $this->frames[] = new Frame($first, $second);
    }


    /**
     * {@inheritDoc}
     */
    public function getPinsOf(int $ball) : int
    {
        if($ball < 1 && $ball > 3)
            throw new InvalidArgumentException('ball index should be between 1 and 3');

        if($ball == 1)
            return $this->frames[0]->getPinsOf(1);

        if($ball == 2)
            return $this->frames[0]->isStrike()
                ? $this->frames[1]->getPinsOf(1)
                : $this->frames[0]->getPinsOf(2);

        if($ball == 3)
            return $this->frames[0]->isStrike()
                ? $this->frames[1]->getPinsOf(2)
                : $this->frames[1]->getPinsOf(1);
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


    /**
     * {@inheritDoc}
     */
    public function calc(Frame $previous) : int
    {
        if($previous->isSpare())
            return $this->getPinsOf(1) + $previous->getPins();

        if($previous->isStrike())
            return $this->isStrike()
                ? $this->getPinsOf(1) + $this->getPinsOf(2) + $previous->getPins()
                : $this->getPinsOf(1) + $previous->getPins();

        return $previous->getPins();
    }
}
