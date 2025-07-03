<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Game;
use TicTacToe\Mark;
use TicTacToe\Position;
use TicTacToe\InvalidMove;

class PlayersTakeTurnsTest extends TestCase
{
	#[Test]
	#[DataProvider('marksAndAllValidPositions')]
	function playersCanPlaceOppositeMarksInTurn (Mark $mark, Position $p1, Position $p2): void
	{
		$game = Game::new();
		$game->place($mark, $p1);
		$game->place($mark->not(), $p2);
		$this->assertTrue(true);
	}

	#[Test]
	#[DataProvider('marksAndAllValidPositions')]
	function playersCanNotPlaceTheSameMarkTwiceInARow (Mark $mark, Position $p1, Position $p2): void
	{
		$this->expectException(InvalidMove::class);

		$game = Game::new();
		$game->place($mark, $p1);
		$game->place($mark, $p2);
	}

	public static function marksAndAllValidPositions (): array
	{
		$values = [];
		foreach (Mark::cases() as $mark) {
			foreach (Position::cases() as $p1) {
				foreach (Position::cases() as $p2) {
					if ($p1 !== $p2) {
						$values[$mark->name . $p1->value . $p2->value] = [$mark, $p1, $p2];
					}
				}
			}
		}
		return $values;
	}
}
