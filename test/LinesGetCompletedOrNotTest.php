<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Mark;
use TicTacToe\Space;
use TicTacToe\Line;
use TicTacToe\Grid;

class LinesGetCompletedOrNotTest extends TestCase
{
	#[Test]
	#[DataProvider('marks')]
	function linesGetCompletedWhenAllTheirSpacesGetMarkedWithTheSameMark (Mark $mark): void
	{
		$grid = $this->createMock(Grid::class);
		$space1 = new Space();
		$space2 = new Space();
		$space3 = new Space();
		$line = new Line($grid, $space1, $space2, $space3);

		$grid->expects($this->once())->method('lineCompleted')->with($this->identicalTo($line), $this->identicalTo($mark));

		$mark->mark($space1);
		$mark->mark($space2);
		$mark->mark($space3);
	}

	#[Test]
	#[DataProvider('allMarksUncompletedCombinations')]
	function linesDoNotGetCompletedWhenTheirSpacesGetMarkedWithDifferentMarks (Mark $mark1, Mark $mark2, Mark $mark3): void
	{
		$grid = $this->createMock(Grid::class);
		$space1 = new Space();
		$space2 = new Space();
		$space3 = new Space();
		$line = new Line($grid, $space1, $space2, $space3);

		$grid->expects($this->never())->method('lineCompleted');

		$mark1->mark($space1);
		$mark2->mark($space2);
		$mark3->mark($space3);
	}

	public static function marks (): array
	{
		return [
			'X' => [Mark::X()],
			'O' => [Mark::O()],
		];
	}

	public static function allMarksUncompletedCombinations (): array
	{
		return [
			'XXO' => [Mark::X(), Mark::X(), Mark::O()],
			'XOX' => [Mark::X(), Mark::O(), Mark::X()],
			'OXX' => [Mark::O(), Mark::X(), Mark::X()],
			'OOX' => [Mark::O(), Mark::O(), Mark::X()],
			'OXO' => [Mark::O(), Mark::X(), Mark::O()],
			'XOO' => [Mark::X(), Mark::O(), Mark::O()],
		];
	}
}