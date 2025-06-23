<?php

declare(strict_types=1);

namespace TicTacToe;

class Space
{
	private bool $marked = false;
	private array $lines = [];

	public function attach (Line $line): void
	{
		$this->lines[] = $line;
	}

	public function mark (Mark $mark): void
	{
		if ($this->marked) {
			throw new InvalidMove();
		}

		$this->marked = true;
		foreach ($this->lines as $line) {
			$line->spaceMarked($this, $mark);
		}
	}
}