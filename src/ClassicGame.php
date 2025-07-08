<?php

declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Game\Grid;

class ClassicGame extends Game
{
	public static function new (): Game
	{
		return new ClassicGame();
	}
}
