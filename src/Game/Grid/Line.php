<?php

declare(strict_types=1);

namespace TicTacToe\Game\Grid;

use TicTacToe\Game\Grid;
use TicTacToe\Mark;

class Line
{
	private Grid $grid;
	private Space $space1;
	private Space $space2;
	private Space $space3;

	public function __construct (Grid $grid, Space $space1, Space $space2, Space $space3)
	{
		$this->grid = $grid;
		$this->space1 = $space1;
		$this->space2 = $space2;
		$this->space3 = $space3;

		$space1->addLine($this);
		$space2->addLine($this);
		$space3->addLine($this);
	}

	public function spaceMarked (Mark $mark): void
	{
		if ($this->space1->completesLine($this->space2, $this->space3)) {
			$this->grid->lineCompleted($mark);
		}
	}
}
