<?php

namespace BowlingGame\Parsers;

use BowlingGame\Frame;
use BowlingGame\FrameWithBonus;
use BowlingGame\IFrame;

class FrameParser
{
    public const SEPARATOR_BONUS = '!';

    /**
     * @var BallParser
     */
    private $ballParser;


    public static function build() : self
    {
        return new self(BallParser::build());
    }


    public function __construct(BallParser $ballParser)
    {
        $this->ballParser = $ballParser;
    }


    public function parse(string $text) : IFrame
    {
        $withBonus = strpos($text,self::SEPARATOR_BONUS) !== false;

        $ballTexts = str_split(
            str_replace(self::SEPARATOR_BONUS, '', $text)
        );

        $balls     = [];
        $previous  = null;

        foreach($ballTexts as $index => $ballText)
            $balls[] = $previous = $this->ballParser->parse(
                $ballText, $index % 2 ? $previous->getPins() : null
            );

        return $withBonus
            ? new FrameWithBonus(...$balls)
            : new Frame(...$balls);
    }
}
