<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Game;
use TicTacToe\GameListener;
use TicTacToe\Mark;
use TicTacToe\Position;

class PlayerWinsTest extends TestCase
{
	#[Test]
	#[DataProvider('marksAndWinningLines')]
	function notifiesGameOverWhenAPlayerCompletesALine (Mark $winningMark, Position $winningPosition1, Position $winningPosition2, Position $winningPosition3): void
	{
		$game = Game::new();

		$listener = $this->createMock(GameListener::class);
		$listener->expects($this->once())->method('gameOver')->with($this->identicalTo($game), $this->identicalTo($winningMark));
		$game->addGameListener($listener);

		$losingPositions = [];
		foreach (Position::cases() as $pos) {
			if ($pos !== $winningPosition1 && $pos !== $winningPosition2 && $pos !== $winningPosition3) {
				$losingPositions[] = $pos;
			}
		}

		$losingMark = $winningMark->not();

		$game->place($winningMark, $winningPosition1);
		$game->place($losingMark, $this->removeRandomPosition($losingPositions));
		$game->place($winningMark, $winningPosition2);
		$game->place($losingMark, $this->removeRandomPosition($losingPositions));
		$game->place($winningMark, $winningPosition3);
	}

	private function removeRandomPosition (&$positions): Position
	{
		$randomKey = array_rand($positions);
		$pos = $positions[$randomKey];
		unset($positions[$randomKey]);
		return $pos;
	}

	public static function marksAndWinningLines(): array
	{
		$winningLines = [
			'Row1' => [Position::ONE, Position::TWO, Position::THREE],
			'Row2' => [Position::FOUR, Position::FIVE, Position::SIX],
			'Row3' => [Position::SEVEN, Position::EIGHT, Position::NINE],
			'Column1' => [Position::ONE, Position::FOUR, Position::SEVEN],
			'Column2' => [Position::TWO, Position::FIVE, Position::EIGHT],
			'Column3' => [Position::THREE, Position::SIX, Position::NINE],
			'Diagonal1' => [Position::ONE, Position::FIVE, Position::NINE],
			'Diagonal2' => [Position::THREE, Position::FIVE, Position::SEVEN],
		];

		$values = [];
		foreach (Mark::cases() as $mark) {
			foreach ($winningLines as $lineName => $positions) {
				$values[$mark->name . '@' . $lineName] = [$mark, ...$positions];
			}
		}

		return $values;
	}
}
