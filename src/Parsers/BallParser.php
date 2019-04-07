<?php

namespace BowlingGame\Parsers;

use BowlingGame\Ball;
use InvalidArgumentException;

class BallParser
{
    public static function build() : self
    {
        return new self();
    }


    public function parse(string $text, ?int $previous = 0) : Ball
    {
        if($text == '-') return Ball::generate(0);
        if($text == 'X') return Ball::generate(10);
        if($text == '/') return Ball::generate(10 - $previous);
        if(preg_match('/\A\d\z/', $text)) return Ball::generate((int)$text);

        throw new InvalidArgumentException('Invalid value for score of ball');
    }
}
