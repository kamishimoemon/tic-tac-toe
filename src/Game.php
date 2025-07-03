<?php

declare(strict_types=1);

namespace TicTacToe;

class Game
{
	private array $spaces = [];

	public function place (Mark $mark, Position $position): void
	{
		if (isset($this->spaces[$position->value])) {
			throw new InvalidMove();
		}

		$this->spaces[$position->value] = $mark;
	}

	public static function new (): Game
	{
		return new Game();
	}
}
