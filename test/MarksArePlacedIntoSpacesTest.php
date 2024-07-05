<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use Kamishimoemon\TicTacToe\Mark;
use Kamishimoemon\TicTacToe\Space;

class MarksArePlacedIntoSpacesTest extends TestCase
{
	#[Test]
	#[DataProvider('marks')]
	function spacesShouldNotifyWhenTheyGetMarked (Mark $mark): void
	{
		$space = new Space();

		$space->onMark(fn($m) => $this->assertSame($mark, $m));

		$mark->mark($space);
	}

	public static function marks (): array
	{
		return [
			'X' => [Mark::X()],
			'O' => [Mark::O()],
		];
	}
}