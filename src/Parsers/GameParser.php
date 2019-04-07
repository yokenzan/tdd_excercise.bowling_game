<?php

namespace BowlingGame\Parsers;

use BowlingGame\Game;

class GameParser
{
    private const SEPARATOR_FRAME = '|';

    /**
     * @var FrameParser
     */
    private $frameParser;


    public static function build() : self
    {
        return new self(FrameParser::build());
    }


    public function __construct(FrameParser $frameParser)
    {
        $this->frameParser = $frameParser;
    }


    public function parse(string $text) : Game
    {
        $textFrames = explode(
            self::SEPARATOR_FRAME,
            str_replace('||', FrameParser::SEPARATOR_BONUS, $text)
        );

        $game = new Game();

        foreach($textFrames as $textFrame)
            $game->addFrame($this->frameParser->parse($textFrame));

        return $game;
    }
}
