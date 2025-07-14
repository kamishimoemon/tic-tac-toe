<?php

declare(strict_types=1);

namespace TicTacToe\Game\Grid;

use TicTacToe\Game\Grid;
use TicTacToe\Mark;
use TicTacToe\InvalidMove;

class Space
{
	private Grid $grid;
	private ?Mark $mark = null;
	private array $lines = [];

	public function __construct (Grid $grid)
	{
		$this->grid = $grid;
	}

	public function addLine (Line $line): void
	{
		$this->lines[] = $line;
	}

	public function isMarked (): bool
	{
		return $this->mark !== null;
	}

	public function mark (Mark $mark): void
	{
		if ($this->mark !== null) {
			throw new InvalidMove();
		}

		$this->mark = $mark;

		$this->marked($mark);
	}

	public function unmark (): void
	{
		if ($this->mark !== null) {
			$this->mark = null;

			foreach ($this->lines as $line) {
				$line->spaceUnmarked($this);
			}
		}
	}

	private function marked (Mark $mark): void
	{
		$this->grid->spaceMarked();
		foreach ($this->lines as $line) {
			$line->spaceMarked($mark);
		}
	}

	public function completesLine (Space $space2, Space $space3): bool
	{
		if ($this->mark === null || $space2->mark === null || $space3->mark === null) {
			return false;
		}

		return $this->mark->equals($space2->mark) && $this->mark->equals($space3->mark);
	}
}
