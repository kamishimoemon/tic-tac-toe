<?php

declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Grid\NullGrid;

class Space
{
	private Grid $grid;
	private ?Mark $mark = null;
	private array $lines = [];

	public function __construct ()
	{
		$this->grid = new NullGrid();
	}

	public function setGrid (Grid $grid): void
	{
		$this->grid = $grid;
	}

	public function attachLine (Line $line): void
	{
		$line->incrementTotal();
		$this->lines[] = $line;
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

			$this->unmarked();
		}
	}

	private function marked (Mark $mark): void
	{
		$this->grid->spaceMarked($this);
		foreach ($this->lines as $line) {
			$line->spaceMarked($this, $mark);
		}
	}

	private function unmarked (): void
	{
		$this->grid->spaceUnmarked($this);
		foreach ($this->lines as $line) {
			$line->spaceUnmarked($this);
		}
	}
}