<?php

namespace BowlingGame;

use InvalidArgumentException;

class Game
{
    /**
     * @var IFrame[]
     */
    private $frames;

    public function __construct()
    {
        $this->frames = [];
    }


    public function addFrame(IFrame $frame) : self
    {
        if($this->frames) {
            $lastFrame = $this->frames[count($this->frames) - 1];
            $lastFrame->setNextFrame($frame);
        }
        $this->frames[] = $frame;

        return $this;

    }


    public function getScore() : int
    {
        return array_reduce(
            $this->frames,
            function (int $score, IFrame $frame) { return $score + $frame->getScore(); },
            0
        );
    }
}
