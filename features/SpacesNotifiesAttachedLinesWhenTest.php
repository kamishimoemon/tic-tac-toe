<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Space;
use TicTacToe\Line;
use TicTacToe\Mark;
use TicTacToe\InvalidMove;

require_once(__DIR__ . '/data_providers/marks.php');

class SpacesNotifiesAttachedLinesWhenTest extends TestCase
{
	use MarksDataProvider;

	#[Test]
	#[DataProvider('marks')]
	public function marked (Mark $mark): void
	{
		$space = new Space();

		$line = $this->createMock(Line::class);
		$line->expects($this->once())->method('spaceMarked')->with($this->identicalTo($space), $this->identicalTo($mark));

		$space->attach($line);

		$space->mark($mark);
	}

	#[Test]
	#[DataProvider('marks')]
	public function unmarked (Mark $mark): void
	{
		$space = new Space();
		$space->mark($mark);

		$line = $this->createMock(Line::class);
		$line->expects($this->once())->method('spaceUnmarked')->with($this->identicalTo($space));

		$space->attach($line);

		$space->unmark();
	}
}
