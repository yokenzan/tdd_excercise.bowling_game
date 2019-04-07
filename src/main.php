#! /usr/bin/env php
<?php

namespace BowlingGame;

require_once __DIR__ . '/../vendor/autoload.php';

use BowlingGame\Parsers\GameParser;

print GameParser::build()->parse($argv[1])->getScore();
