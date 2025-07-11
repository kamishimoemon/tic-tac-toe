<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Game\ClassicGame;
use TicTacToe\GameListener;
use TicTacToe\Mark;
use TicTacToe\Position;

class GameTiedTest extends TestCase
{
	#[Test]
	#[DataProvider('marksAndLosingLines')]
	function notifiesDrawWhenNoMovesAvailable (Mark $initialMark, array $positions): void
	{
		$game = new ClassicGame();

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
			'132465798' => [Position::ONE, Position::THREE, Position::TWO, Position::FOUR, Position::SIX, Position::FIVE, Position::SEVEN, Position::NINE, Position::EIGHT],
			'123547698' => [Position::ONE, Position::TWO, Position::THREE, Position::FIVE, Position::FOUR, Position::SEVEN, Position::SIX, Position::NINE, Position::EIGHT],
			'213546879' => [Position::TWO, Position::ONE, Position::THREE, Position::FIVE, Position::FOUR, Position::SIX, Position::EIGHT, Position::SEVEN, Position::NINE],
			'123465798' => [Position::ONE, Position::TWO, Position::THREE, Position::FOUR, Position::SIX, Position::FIVE, Position::SEVEN, Position::NINE, Position::EIGHT],
			'123546879' => [Position::ONE, Position::TWO, Position::THREE, Position::FIVE, Position::FOUR, Position::SIX, Position::EIGHT, Position::SEVEN, Position::NINE],
			'213546789' => [Position::TWO, Position::ONE, Position::THREE, Position::FIVE, Position::FOUR, Position::SIX, Position::SEVEN, Position::EIGHT, Position::NINE],
			'132465789' => [Position::ONE, Position::THREE, Position::TWO, Position::FOUR, Position::SIX, Position::FIVE, Position::SEVEN, Position::EIGHT, Position::NINE],
			'123647598' => [Position::ONE, Position::TWO, Position::THREE, Position::SIX, Position::FOUR, Position::SEVEN, Position::FIVE, Position::NINE, Position::EIGHT],
			'213647589' => [Position::TWO, Position::ONE, Position::THREE, Position::SIX, Position::FOUR, Position::SEVEN, Position::FIVE, Position::EIGHT, Position::NINE],
			'215364789' => [Position::TWO, Position::ONE, Position::FIVE, Position::THREE, Position::SIX, Position::FOUR, Position::SEVEN, Position::EIGHT, Position::NINE],
			'125364798' => [Position::ONE, Position::TWO, Position::FIVE, Position::THREE, Position::SIX, Position::FOUR, Position::SEVEN, Position::NINE, Position::EIGHT],
			'214356789' => [Position::TWO, Position::ONE, Position::FOUR, Position::THREE, Position::FIVE, Position::SIX, Position::SEVEN, Position::EIGHT, Position::NINE],
			'132458697' => [Position::ONE, Position::THREE, Position::TWO, Position::FOUR, Position::FIVE, Position::EIGHT, Position::SIX, Position::NINE, Position::SEVEN],
			'123457698' => [Position::ONE, Position::TWO, Position::THREE, Position::FOUR, Position::FIVE, Position::SEVEN, Position::SIX, Position::NINE, Position::EIGHT],
			'314256879' => [Position::THREE, Position::ONE, Position::FOUR, Position::TWO, Position::FIVE, Position::SIX, Position::EIGHT, Position::SEVEN, Position::NINE],
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
