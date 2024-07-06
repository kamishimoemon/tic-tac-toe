<?php

declare(strict_types=1);

namespace Kamishimoemon\TicTacToe;

class Space
{
	private bool $marked = false;
	private array $rows = [];

	public function attach (Row $row): void
	{
		$this->rows[] = $row;
	}

	public function mark (Mark $mark): void
	{
		if ($this->marked) {
			throw new InvalidMove();
		}

		$this->marked = true;
		foreach ($this->rows as $row) {
			$row->spaceMarked($this, $mark);
		}
	}
}