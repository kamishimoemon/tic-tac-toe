<?php

declare(strict_types=1);

use TicTacToe\Mark;

trait MarksDataProvider
{
	public static function marks (): array
	{
		return [
			'X' => [Mark::X],
			'O' => [Mark::O],
		];
	}
}
