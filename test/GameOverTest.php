<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Game;
use TicTacToe\GameListener;
use TicTacToe\Mark;
use TicTacToe\Position;

class GameOverTest extends TestCase
{
	#[Test]
	#[DataProvider('marks')]
	function notifiesDrawWhenNoMovesAvailable (Mark $initialMark): void
	{
		$game = Game::new();

		$listener = $this->createMock(GameListener::class);
		$listener->expects($this->once())->method('gameOver')->with($this->identicalTo($game));
		$game->addGameListener($listener);

		$mark = $initialMark;
		foreach (Position::cases() as $position) {
			$game->place($mark, $position);
			$mark = $mark->not();
		}
	}

	public static function marks (): array
	{
		return [
			'X' => [Mark::X],
			'O' => [Mark::O],
		];
	}
}
