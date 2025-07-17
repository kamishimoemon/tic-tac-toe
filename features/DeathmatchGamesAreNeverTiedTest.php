<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Game\DeathmatchGame;
use TicTacToe\GameListener;
use TicTacToe\Mark;
use TicTacToe\Position;

require_once(__DIR__ . '/data_providers/marks_with_losing_lines.php');

class DeathmatchGamesAreNeverTiedTest extends TestCase
{
	use MarksWithLosingLinesDataProvider;

	#[Test]
	#[DataProvider('marksWithLosingLines')]
	function test (Mark $initialMark, array $positions): void
	{
		$game = new DeathmatchGame();

		$listener = $this->createMock(GameListener::class);
		$listener->expects($this->never())->method('gameOver');
		$game->addGameListener($listener);

		$mark = $initialMark;
		foreach ($positions as $position) {
			$game->place($mark, $position);
			$mark = $mark->not();
		}
	}
}
