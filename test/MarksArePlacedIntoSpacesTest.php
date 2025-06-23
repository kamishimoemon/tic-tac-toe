<?php

declare(strict_types=1);

require_once(__DIR__ . '/TicTacToeTestCase.php');

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Mark;
use TicTacToe\Space;
use TicTacToe\Line;
use TicTacToe\InvalidMove;

class MarksArePlacedIntoSpacesTest extends TicTacToeTestCase
{
	#[Test]
	#[DataProvider('marks')]
	function spacesShouldNotifyWhenTheyGetMarked (Mark $mark): void
	{
		$space = new Space();

		$line = $this->createMock(Line::class);
		$line->expects($this->once())->method('spaceMarked')->with($this->identicalTo($space), $this->identicalTo($mark));

		$space->attach($line);
		$mark->mark($space);
	}

	#[Test]
	#[DataProvider('marks')]
	function spacesCanGetMarkedOnlyOneTime (Mark $mark): void
	{
		$this->expectException(InvalidMove::class);
		$space = new Space();
		$mark->mark($space);
		$mark->mark($space);
	}

	#[Test]
	#[DataProvider('marks')]
	function spacesShouldNotifyOnlyTheFirtTimeTheyGetMarked (Mark $mark): void
	{
		$space = new Space();

		$line = $this->createMock(Line::class);
		$line->expects($this->once())->method('spaceMarked')->with($this->identicalTo($space), $this->identicalTo($mark));

		$space->attach($line);
		$mark->mark($space);

		try {
			$mark->mark($space);
		}
		catch (InvalidMove $ime) {}
	}
}