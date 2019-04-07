<?php

namespace BowlingGame;

use BowlingGame\Frame;

interface IFrame
{
    public function setNextFrame(IFrame $next);

    public function getPinsOf(int $ball): int;

    public function getPins(): int;

    public function isStrike(): bool;

    public function isSpare(): bool;

    public function getScore(): int;
}
