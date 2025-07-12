<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Space;
use TicTacToe\Mark;
use TicTacToe\InvalidMove;

class SpacesCannotBeMarkedTwiceTest extends TestCase
{
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

	public static function marks (): array
	{
		return [
			'X' => [Mark::X],
			'O' => [Mark::O],
		];
	}
}
