<?php

declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Grid\NullGrid;

/**
 * @todo: Crear pruebas unitarias para esta clase.
 */
class Line
{
	private Grid $grid;
	private int $total = 0;
	private int $x = 0;
	private int $o = 0;

	public function __construct ()
	{
		$this->grid = new NullGrid();
	}

	public function setGrid (Grid $grid): void
	{
		$this->grid = $grid;
	}

	public function incrementTotal (): void
	{
		$this->total++;
	}

	public function incrementX (): void
	{
		$this->x++;
	}

	public function incrementO (): void
	{
		$this->o++;
	}

	public function spaceMarked (Space $space, Mark $mark): void
	{
		$mark->increment($this);
		if ($this->x == $this->total || $this->o == $this->total) {
			$this->completed($mark);
		}
	}

	public function spaceUnmarked (Space $space): void
	{

	}

	private function completed (Mark $mark): void
	{
		$this->grid->lineCompleted($this, $mark);
	}
}