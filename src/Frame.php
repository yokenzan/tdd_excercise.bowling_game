<?php

namespace BowlingGame;

use InvalidArgumentException;

class Frame implements IFrame
{
    /**
     * @var Ball[]
     */
    private $balls;

    /**
     * @var ?IFrame
     *
     * @throws  InvalidArgumentException
     */
    private $next;

    /**
     * @throws  InvalidArgumentException
     */
    function __construct(Ball $first, ?Ball $second = null)
    {
        $second = $second ?? new Ball(0);

        if($first->getPins() + $second->getPins() > 10)
            throw new InvalidArgumentException(
                'count of pins should be equel or less than 10'
            );

        $this->balls  = [$first, $second];
    }


    /**
     * {@inheritDoc}
     */
    public function setNextFrame(IFrame $next)
    {
        $this->next = $next;
    }


    /**
     * {@inheritDoc}
     *
     * @throws  InvalidArgumentException
     */
    public function getPinsOf(int $ball) : int
    {
        if($ball < 1 && $ball > 2)
            throw new InvalidArgumentException('ball index should be between 1 and 2');

        return $this->balls[$ball - 1]->getPins();
    }


    /**
     * {@inheritDoc}
     */
    public function getPins() : int
    {
        return array_reduce(
            $this->balls,
            function (int $sum, Ball $ball) { return $sum + $ball->getPins(); },
            0
        );
    }


    /**
     * {@inheritDoc}
     */
    public function isStrike() : bool
    {
        return $this->getPinsOf(1) == 10;
    }


    /**
     * {@inheritDoc}
     */
    public function isSpare() : bool
    {
        return !$this->isStrike() && $this->getPins() == 10;
    }


    /**
     * {@inheritDoc}
     */
    public function getScore() : int
    {
        return $this->next ? $this->next->calc($this) : $this->getPins();
    }


    protected function calc(self $previous) : int
    {
        if($previous->isSpare())
            return $this->getPinsOf(1) + $previous->getPins();

        if($previous->isStrike())
            return $this->getScore()   + $previous->getPins();

        return $previous->getPins();
    }
}
