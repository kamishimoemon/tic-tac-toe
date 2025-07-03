<?php

declare(strict_types=1);

namespace TicTacToe;

class Game
{
	private array $spaces = [];
	private ?Mark $currentMark = null;

	public function place (Mark $mark, Position $position): void
	{
		if ($this->currentMark !== null) {
			$this->currentMark->validateTurn($mark);
		}

		if (isset($this->spaces[$position->value])) {
			throw new InvalidMove();
		}

		$this->spaces[$position->value] = $mark;
		$this->currentMark = $mark;
	}

	public static function new (): Game
	{
		return new Game();
	}
}
