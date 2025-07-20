<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Space;
use TicTacToe\Line;
use TicTacToe\Grid;
use TicTacToe\Mark;

require_once(__DIR__ . '/data_providers/marks.php');

class LinesNotifiesGridWhenCompletedTest extends TestCase
{
	use MarksDataProvider;

	#[Test]
	#[DataProvider('marks')]
	public function withOneSpace (Mark $mark): void
	{
		$line = new Line();

		$space = new Space();
		$space->attachLine($line);

		$grid = $this->createMock(Grid::class);
		$grid->expects($this->once())->method('lineCompleted')->with($this->identicalTo($line), $this->identicalTo($mark));

		$line->setGrid($grid);

		$space->mark($mark);
	}

	#[Test]
	#[DataProvider('marks')]
	public function withoutGrid (Mark $mark): void
	{
		$line = new Line();
		$space = new Space();

		$space->attachLine($line);

		$space->mark($mark);
		$this->assertTrue(true);
	}
}
