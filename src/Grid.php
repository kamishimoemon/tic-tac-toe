<?php

declare(strict_types=1);

namespace TicTacToe;

interface Grid
{
	function spaceMarked (Space $space): void;
	function spaceUnmarked (Space $space): void;
	function lineCompleted (Line $line, Mark $mark): void;
}