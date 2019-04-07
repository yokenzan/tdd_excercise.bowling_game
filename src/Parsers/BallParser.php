<?php

namespace BowlingGame\Parsers;

use BowlingGame\Ball;
use InvalidArgumentException;

class BallParser
{
    public function parse(string $text, ?int $previous = 0) : Ball
    {
        if($text == 'X') return Ball::generate(10);
        if($text == '/') return Ball::generate(10 - $previous);
        if(preg_match('/\A\d\z/', $text)) return Ball::generate((int)$text);

        throw new InvalidArgumentException('Invalid value for score of ball');
    }
}
