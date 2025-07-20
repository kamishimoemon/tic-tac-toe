<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Space;
use TicTacToe\Line;
use TicTacToe\Grid;
use TicTacToe\Mark;

require_once(__DIR__ . '/../features/data_providers/marks.php');

class LineTest extends TestCase
{
	use MarksDataProvider;

	#[Test]
	#[DataProvider('marks')]
	public function completedWithoutGrid (Mark $mark): void
	{
		$line = new Line();
		$space = new Space();

		$space->attachLine($line);

		$space->mark($mark);
		$this->assertTrue(true);
	}
}
