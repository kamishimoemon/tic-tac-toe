<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use TicTacToe\Game;
use TicTacToe\GameListener;
use TicTacToe\Mark;
use TicTacToe\Position;

class GameOverTest extends TestCase
{
	#[Test]
	function notifiesDrawWhenNoMovesAvailable (): void
	{
		$game = Game::new();

		$listener = $this->createMock(GameListener::class);
		$listener->expects($this->once())->method('gameOver')->with($this->identicalTo($game));
		$game->attach($listener);

		$mark = Mark::X;
		foreach (Position::cases() as $position) {
			$game->place($mark, $position);
			$mark = $mark->not();
		}
	}
}
