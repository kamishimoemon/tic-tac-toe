<?php

declare(strict_types=1);

namespace TicTacToe;

enum Mark
{
	case X;
	case O;

	public function not (): Mark
	{
		return match ($this) {
			self::X => Mark::O,
			self::O => Mark::X,
		};
	}

	public function validateTurn (Mark $mark): void
	{
		if ($this === $mark) {
			throw new InvalidMove();
		}
	}


	public function spaceMarked (Space $space, SpaceListener $listener): void
	{
		match ($this) {
			self::X => $listener->spaceMarkedWithX($space, $this),
			self::O => $listener->spaceMarkedWithO($space, $this),
		};
	}

	public function increment (Line $line): void
	{
		match ($this) {
			self::X => $line->incrementX(),
			self::O => $line->incrementO(),
		};
	}

	public function mark (Space $space): void
	{
		$space->mark($this);
	}

	public function equals (Mark $mark): bool
	{
		return $this === $mark;
	}
}
