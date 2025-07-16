<?php

declare(strict_types=1);

namespace TicTacToe;

class Space
{
	private bool $marked = false;
	private ?Mark $mark = null;
	private array $lines = [];

	public function attach (Line $line): void
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

		foreach ($this->lines as $line) {
			$line->spaceMarked($this, $mark);
		}
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
}