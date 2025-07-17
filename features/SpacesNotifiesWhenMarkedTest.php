<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Space;
use TicTacToe\Grid;
use TicTacToe\Line;
use TicTacToe\Mark;

require_once(__DIR__ . '/data_providers/marks.php');

class SpacesNotifiesWhenMarkedTest extends TestCase
{
	use MarksDataProvider;

	#[Test]
	#[DataProvider('marks')]
	public function itsGrid (Mark $mark): void
	{
		$space = new Space();

		$grid = $this->createMock(Grid::class);
		$grid->expects($this->once())->method('spaceMarked')->with($this->identicalTo($space));

		$space->setGrid($grid);

		$space->mark($mark);
	}

	#[Test]
	#[DataProvider('marks')]
	public function attachedLines (Mark $mark): void
	{
		$space = new Space();

		$line = $this->createMock(Line::class);
		$line->expects($this->once())->method('spaceMarked')->with($this->identicalTo($space), $this->identicalTo($mark));

		$space->attachLine($line);

		$space->mark($mark);
	}
}
