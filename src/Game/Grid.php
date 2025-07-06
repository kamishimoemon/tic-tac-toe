<?php

declare(strict_types=1);

namespace TicTacToe\Game;

use TicTacToe\Game;
use TicTacToe\Mark;
use TicTacToe\Position;
use TicTacToe\InvalidMove;
use TicTacToe\Game\Grid\Space;
use TicTacToe\Game\Grid\Line;

class Grid
{
	private Game $game;
	private array $spacesByPosition = [];

	public function __construct (Game $game)
	{
		$this->game = $game;

		foreach (Position::cases() as $position) {
			$this->spacesByPosition[$position->value] = new Space($this);
		}

		// Row 1
		new Line($this, $this->spacesByPosition[Position::ONE->value], $this->spacesByPosition[Position::TWO->value], $this->spacesByPosition[Position::THREE->value]);
		// Row 2
		new Line($this, $this->spacesByPosition[Position::FOUR->value], $this->spacesByPosition[Position::FIVE->value], $this->spacesByPosition[Position::SIX->value]);
		// Row 3
		new Line($this, $this->spacesByPosition[Position::SEVEN->value], $this->spacesByPosition[Position::EIGHT->value], $this->spacesByPosition[Position::NINE->value]);
		// Column 1
		new Line($this, $this->spacesByPosition[Position::ONE->value], $this->spacesByPosition[Position::FOUR->value], $this->spacesByPosition[Position::SEVEN->value]);
		// Column 2
		new Line($this, $this->spacesByPosition[Position::TWO->value], $this->spacesByPosition[Position::FIVE->value], $this->spacesByPosition[Position::EIGHT->value]);
		// Column 3
		new Line($this, $this->spacesByPosition[Position::THREE->value], $this->spacesByPosition[Position::SIX->value], $this->spacesByPosition[Position::NINE->value]);
		// Diagonal 1
		new Line($this, $this->spacesByPosition[Position::ONE->value], $this->spacesByPosition[Position::FIVE->value], $this->spacesByPosition[Position::NINE->value]);
		// Diagonal 2
		new Line($this, $this->spacesByPosition[Position::THREE->value], $this->spacesByPosition[Position::FIVE->value], $this->spacesByPosition[Position::SEVEN->value]);
	}

	public function markSpace (Mark $mark, Position $position): void
	{
		$this->spacesByPosition[$position->value]->mark($mark);
	}

	public function spaceMarked (): void
	{
		foreach ($this->spacesByPosition as $space) {
			if (!$space->isMarked()) {
				return;
			}
		}

		$this->game->gridCompleted();
	}

	public function lineCompleted (Mark $mark): void
	{
		$this->game->lineCompleted($mark);
	}
}
