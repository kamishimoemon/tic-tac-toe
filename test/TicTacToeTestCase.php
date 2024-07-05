<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Kamishimoemon\TicTacToe\Mark;

abstract class TicTacToeTestCase extends TestCase
{
	public static function marks (): array
	{
		return [
			'X' => [Mark::X()],
			'O' => [Mark::O()],
		];
	}
}