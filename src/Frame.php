<?php

namespace BowlingGame;

use InvalidArgumentException;

class Frame
{
    /**
     * @var Ball[]
     */
    private $balls;

    /**
     * @var ?Frame
     */
    private $next;

    function __construct(Ball $first, Ball $second, ?self $next = null)
    {
        if($first->getPins() + $second->getPins() > 10)
            throw new InvalidArgumentException(
                'count of pins should be equel or less than 10'
            );

        $this->balls  = [$first, $second];
        $this->next   = $next;
    }


    public function getPinsOf(int $ball) : int
    {
        return $this->balls[$ball - 1]->getPins();
    }


    public function getPins() : int
    {
        return array_reduce(
            $this->balls,
            function (int $sum, Ball $ball) { return $sum + $ball->getPins(); },
            0
        );
    }


    public function isStrike() : bool
    {
        return $this->getPinsOf(1) == 10;
    }


    public function isSpare() : bool
    {
        return !$this->isStrike() && $this->getPins() == 10;
    }


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
