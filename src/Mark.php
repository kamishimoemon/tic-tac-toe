<?php

declare(strict_types=1);

namespace TicTacToe;

enum Mark
{
	/**
	 * @todo: Agregar una tercera opcion: NONE (NullObject).
	 */
	case X;
	case O;
	case NONE;

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

	public static function xo (): array
	{
		return [self::X, self::O];
	}
}
