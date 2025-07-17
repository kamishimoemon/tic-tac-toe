<?php

declare(strict_types=1);

namespace TicTacToe\Grid;

use TicTacToe\Grid;
use TicTacToe\Space;
use TicTacToe\Line;
use TicTacToe\Mark;

class NullGrid implements Grid
{
	public function spaceMarked (Space $space): void {}
	public function spaceUnmarked (Space $space): void {}
	public function lineCompleted (Line $line, Mark $mark): void {}
}