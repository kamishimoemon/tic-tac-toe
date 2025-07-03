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

	public function spaceMarked (Space $space, SpaceListener $listener): void
	{
		match ($this) {
			self::X => $listener->spaceMarkedWithX($space, $this),
			self::O => $listener->spaceMarkedWithO($space, $this),
		};
	}

	public function increment (int $x, int $o): array
	{
		return match ($this) {
			self::X => [$x + 1, $o],
			self::O => [$x, $o + 1],
		};
	}

	public function mark (Space $space): void
	{
		$space->mark($this);
	}
}
