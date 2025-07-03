<?php

declare(strict_types=1);

namespace TicTacToe;

interface GameListener
{
	public function gameOver (Game $game): void;
}
