<?php

declare(strict_types=1);

namespace TicTacToe\Game;

use TicTacToe\Game;
use TicTacToe\Mark;
use TicTacToe\Position;

use SplQueue;

class DeathmatchGame extends Game
{
	private SplQueue $history;

	public function __construct ()
	{
		parent::__construct();
		$this->history = new SplQueue;
	}

	public function place (Mark $mark, Position $position): void
	{
		parent::__construct();
		$this->history->push($position);
		if ($this->history->count() > 6) {
			$this->grid->unmarkSpace(
				$this->history->shift()
			);
		}
	}
}
