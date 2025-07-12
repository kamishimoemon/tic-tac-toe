<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Space;
use TicTacToe\Mark;
use TicTacToe\InvalidMove;

require_once(__DIR__ . '/data_providers/marks.php');

class SpacesCannotBeMarkedTwiceTest extends TestCase
{
	use MarksDataProvider;

	#[Test]
	#[DataProvider('marks')]
	public function withTheSameMark (Mark $mark): void
	{
		$this->expectException(InvalidMove::class);
		$space = new Space();
		$space->mark($mark);
		$space->mark($mark);
	}

	#[Test]
	#[DataProvider('marks')]
	public function withTheOppositeMark (Mark $mark): void
	{
		$this->expectException(InvalidMove::class);
		$space = new Space();
		$space->mark($mark);
		$space->mark($mark->not());
	}
}
