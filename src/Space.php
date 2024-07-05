<?php

declare(strict_types=1);

namespace Kamishimoemon\TicTacToe;

use function call_user_func;

class Space
{
	private array $listeners = [];

	public function onMark ($listener): void
	{
		$this->listeners[] = $listener;
	}

	public function mark (Mark $mark): void
	{
		foreach ($this->listeners as $listener) {
			$listener($mark);
		}
	}
}