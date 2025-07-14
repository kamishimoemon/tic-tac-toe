<?php

declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Game\Grid;

abstract class Game
{
	protected Grid $grid;
	private ?Mark $currentMark = null;
	private array $listeners = [];

	protected function __construct ()
	{
		$this->grid = new Grid($this);
	}

	public function addGameListener (GameListener $listener): void
	{
		$this->listeners[] = $listener;
	}

	public function place (Mark $mark, Position $position): void
	{
		if ($this->currentMark !== null) {
			$this->currentMark->validateTurn($mark);
		}

		$this->grid->markSpace($mark, $position);

		$this->currentMark = $mark;
	}

	public function gridCompleted (): void
	{
		foreach ($this->listeners as $listener) {
			$listener->gameOver($this);
		}
	}

	public function lineCompleted (Mark $mark): void
	{
		foreach ($this->listeners as $listener) {
			$listener->gameOver($this, $mark);
		}
	}
}
