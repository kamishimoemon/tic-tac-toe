<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use TicTacToe\Game\ClassicGame;
use TicTacToe\GameListener;
use TicTacToe\Mark;

require_once(__DIR__ . '/data_providers/marks_with_losing_lines.php');

class ClassicGameTiedTest extends TestCase
{
	use MarksWithLosingLinesDataProvider;

	#[Test]
	#[DataProvider('marksWithLosingLines')]
	function notifiesDrawWhenNoMovesAvailable (Mark $initialMark, array $positions): void
	{
		$game = new ClassicGame();

		$listener = $this->createMock(GameListener::class);
		$listener->expects($this->once())->method('gameOver')->with($this->identicalTo($game));
		$game->addGameListener($listener);

		$mark = $initialMark;
		foreach ($positions as $position) {
			$game->place($mark, $position);
			$mark = $mark->not();
		}
	}
}
