<?php

declare(strict_types=1);

require_once(__DIR__ . '/TicTacToeTestCase.php');

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Mark;
use TicTacToe\Space;
use TicTacToe\Row;
use TicTacToe\Grid;

class RowsGetCompletedOrNotTest extends TicTacToeTestCase
{
	#[Test]
	#[DataProvider('marks')]
	function rowsGetCompletedWhenAllTheirSpacesGetMarkedWithTheSameMark (Mark $mark): void
	{
		$grid = $this->createMock(Grid::class);
		$space1 = new Space();
		$space2 = new Space();
		$space3 = new Space();
		$row = new Row($grid, $space1, $space2, $space3);

		$grid->expects($this->once())->method('rowCompleted')->with($this->identicalTo($row), $this->identicalTo($mark));

		$mark->mark($space1);
		$mark->mark($space2);
		$mark->mark($space3);
	}

	#[Test]
	#[DataProvider('allMarksUncompletedCombinations')]
	function rowsDoNotGetCompletedWhenTheirSpacesGetMarkedWithDifferentMarks (Mark $mark1, Mark $mark2, Mark $mark3): void
	{
		$grid = $this->createMock(Grid::class);
		$space1 = new Space();
		$space2 = new Space();
		$space3 = new Space();
		$row = new Row($grid, $space1, $space2, $space3);

		$grid->expects($this->never())->method('rowCompleted');

		$mark1->mark($space1);
		$mark2->mark($space2);
		$mark3->mark($space3);
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