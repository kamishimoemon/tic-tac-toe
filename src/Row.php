<?php

declare(strict_types=1);

namespace Kamishimoemon\TicTacToe;

class Row implements SpaceListener
{
	private int $x = 0;
	private int $o = 0;
	private array $listeners = [];

	public function __construct (Space $space1, Space $space2, Space $space3)
	{
		$space1->addListener($this);
		$space2->addListener($this);
		$space3->addListener($this);
	}

	public function addListener (RowListener $listener): void
	{
		$this->listeners[] = $listener;
	}

	public function spaceMarked (Space $space, Mark $mark): void
	{
		if ($mark instanceof X) {
			$this->x++;
			if ($this->x == 3 && $this->o == 0) {
				$this->completed();
			}
		}
		else if ($mark instanceof O) {
			$this->o++;
			if ($this->o == 3 && $this->x == 0) {
				$this->completed();
			}
		}
	}

	private function completed (): void
	{
		foreach ($this->listeners as $listener) {
			$listener->rowCompleted($this);
		}
	}
}