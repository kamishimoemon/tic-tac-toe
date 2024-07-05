<?php

declare(strict_types=1);

namespace Kamishimoemon\TicTacToe;

/**
 * @todo: remove this
 */
use function call_user_func;

class Space
{
	private bool $marked = false;
	private array $listeners = [];

	public function addListener (SpaceListener $listener): void
	{
		$this->listeners[] = $listener;
	}

	public function mark (Mark $mark): void
	{
		if ($this->marked) {
			throw new InvalidMove();
		}

		$this->marked = true;
		foreach ($this->listeners as $listener) {
			$listener->spaceMarked($this, $mark);
		}
	}
}