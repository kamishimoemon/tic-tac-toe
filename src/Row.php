<?php

declare(strict_types=1);

namespace Kamishimoemon\TicTacToe;

class Row
{
	private Grid $grid;
	private int $x = 0;
	private int $o = 0;

	public function __construct (Grid $grid, Space $space1, Space $space2, Space $space3)
	{
		$this->grid = $grid;
		$space1->attach($this);
		$space2->attach($this);
		$space3->attach($this);
	}

	public function spaceMarked (Space $space, Mark $mark): void
	{
		list($this->x, $this->o) = $mark->increment($this->x, $this->o);
		if ($this->x == 3 && $this->o == 0) {
			$this->completed($mark);
		}
		else if ($this->o == 3 && $this->x == 0) {
			$this->completed($mark);
		}
	}

	private function completed (Mark $mark): void
	{
		$this->grid->rowCompleted($this, $mark);
	}
}