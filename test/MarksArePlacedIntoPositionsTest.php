<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Mark;
use TicTacToe\Position;
use TicTacToe\ClassicGame;
use TicTacToe\InvalidMove;

class MarksArePlacedIntoPositionsTest extends TestCase
{
	#[Test]
	#[DataProvider('marksAndPositions')]
	function aMarkCanBePlacedIntoAnyPositionOfANewGame (Mark $mark, Position $pos): void
	{
		$game = ClassicGame::new();
		$game->place($mark, $pos);
		$this->assertTrue(true);
	}

	#[Test]
	#[DataProvider('marksMarksAndPositions')]
	function aMarkCanNotBePlacedIntoANonEmptyPosition (Mark $m1, Mark $m2, Position $pos): void
	{
		$this->expectException(InvalidMove::class);
		$game = ClassicGame::new();
		$game->place($m1, $pos);
		$game->place($m2, $pos);
	}

	public static function marksAndPositions (): array
	{
		$values = [];
		foreach (Mark::cases() as $mark) {
			foreach (Position::cases() as $pos) {
				$values[$mark->name.$pos->value] = [$mark, $pos];
			}
		}
		return $values;
	}

	public static function marksMarksAndPositions (): array
	{
		$values = [];
		foreach (Mark::cases() as $mark) {
			foreach (Position::cases() as $pos) {
				$values[$mark->name.$mark->name.$pos->value] = [$mark, $mark, $pos];
				$values[$mark->name.$mark->not()->name.$pos->value] = [$mark, $mark->not(), $pos];
			}
		}
		return $values;
	}
}
