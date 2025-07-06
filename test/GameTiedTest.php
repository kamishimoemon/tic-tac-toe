<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Game;
use TicTacToe\GameListener;
use TicTacToe\Mark;
use TicTacToe\Position;

class GameTiedTest extends TestCase
{
	#[Test]
	#[DataProvider('marksAndLosingLines')]
	function notifiesDrawWhenNoMovesAvailable (Mark $initialMark, array $positions): void
	{
		$game = Game::new();

		$listener = $this->createMock(GameListener::class);
		$listener->expects($this->once())->method('gameOver')->with($this->identicalTo($game));
		$game->addGameListener($listener);

		$mark = $initialMark;
		foreach ($positions as $position) {
			$game->place($mark, $position);
			$mark = $mark->not();
		}
	}

	public static function marksAndLosingLines(): array
	{
		$losingLines = [
			'214365789' => [Position::TWO, Position::ONE, Position::FOUR, Position::THREE, Position::SIX, Position::FIVE, Position::SEVEN, Position::EIGHT, Position::NINE],
		];

		$values = [];
		foreach (Mark::cases() as $mark) {
			foreach ($losingLines as $lineName => $positions) {
				$values[$mark->name . '@' . $lineName] = [$mark, $positions];
			}
		}

		return $values;
	}
}
