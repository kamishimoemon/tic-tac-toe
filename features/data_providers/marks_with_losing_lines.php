<?php

declare(strict_types=1);

use TicTacToe\Mark;
use TicTacToe\Position;

trait MarksWithLosingLinesDataProvider
{
	public static function marksWithLosingLines(): array
	{
		$losingLines = [
			'214365789' => [Position::TWO, Position::ONE, Position::FOUR, Position::THREE, Position::SIX, Position::FIVE, Position::SEVEN, Position::EIGHT, Position::NINE],
			'132465798' => [Position::ONE, Position::THREE, Position::TWO, Position::FOUR, Position::SIX, Position::FIVE, Position::SEVEN, Position::NINE, Position::EIGHT],
			'123547698' => [Position::ONE, Position::TWO, Position::THREE, Position::FIVE, Position::FOUR, Position::SEVEN, Position::SIX, Position::NINE, Position::EIGHT],
			'213546879' => [Position::TWO, Position::ONE, Position::THREE, Position::FIVE, Position::FOUR, Position::SIX, Position::EIGHT, Position::SEVEN, Position::NINE],
			'123465798' => [Position::ONE, Position::TWO, Position::THREE, Position::FOUR, Position::SIX, Position::FIVE, Position::SEVEN, Position::NINE, Position::EIGHT],
			'123546879' => [Position::ONE, Position::TWO, Position::THREE, Position::FIVE, Position::FOUR, Position::SIX, Position::EIGHT, Position::SEVEN, Position::NINE],
			'213546789' => [Position::TWO, Position::ONE, Position::THREE, Position::FIVE, Position::FOUR, Position::SIX, Position::SEVEN, Position::EIGHT, Position::NINE],
			'132465789' => [Position::ONE, Position::THREE, Position::TWO, Position::FOUR, Position::SIX, Position::FIVE, Position::SEVEN, Position::EIGHT, Position::NINE],
			'123647598' => [Position::ONE, Position::TWO, Position::THREE, Position::SIX, Position::FOUR, Position::SEVEN, Position::FIVE, Position::NINE, Position::EIGHT],
			'213647589' => [Position::TWO, Position::ONE, Position::THREE, Position::SIX, Position::FOUR, Position::SEVEN, Position::FIVE, Position::EIGHT, Position::NINE],
			'215364789' => [Position::TWO, Position::ONE, Position::FIVE, Position::THREE, Position::SIX, Position::FOUR, Position::SEVEN, Position::EIGHT, Position::NINE],
			'125364798' => [Position::ONE, Position::TWO, Position::FIVE, Position::THREE, Position::SIX, Position::FOUR, Position::SEVEN, Position::NINE, Position::EIGHT],
			'214356789' => [Position::TWO, Position::ONE, Position::FOUR, Position::THREE, Position::FIVE, Position::SIX, Position::SEVEN, Position::EIGHT, Position::NINE],
			'132458697' => [Position::ONE, Position::THREE, Position::TWO, Position::FOUR, Position::FIVE, Position::EIGHT, Position::SIX, Position::NINE, Position::SEVEN],
			'123457698' => [Position::ONE, Position::TWO, Position::THREE, Position::FOUR, Position::FIVE, Position::SEVEN, Position::SIX, Position::NINE, Position::EIGHT],
			'314256879' => [Position::THREE, Position::ONE, Position::FOUR, Position::TWO, Position::FIVE, Position::SIX, Position::EIGHT, Position::SEVEN, Position::NINE],
		];

		$values = [];
		foreach (Mark::xo() as $mark) {
			foreach ($losingLines as $lineName => $positions) {
				$values[$mark->name . '@' . $lineName] = [$mark, $positions];
			}
		}

		return $values;
	}
}
