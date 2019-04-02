<?php

namespace BowlingGame;

use InvalidArgumentException;

class Ball
{
    /**
     * @var int
     */
    private $pins;

    public function __construct(int $pins)
    {
        if($pins > 10)
            throw new InvalidArgumentException(
                'count of pins should be equel or less than 10'
            );

        if($pins <  0)
            throw new InvalidArgumentException(
                'count of pins should be equel or greater than 0'
            );

        $this->pins = $pins;
    }


    public function getPins()
    {
        return $this->pins;
    }
}
