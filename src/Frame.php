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
}
