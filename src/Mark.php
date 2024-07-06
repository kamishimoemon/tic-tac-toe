<?php

declare(strict_types=1);

namespace Kamishimoemon\TicTacToe;

abstract class Mark
{
	public abstract function spaceMarked (Space $space, SpaceListener $listener): void;
	public abstract function increment (int $x, int $o): array;

	public function mark (Space $space): void
	{
		$space->mark($this);
	}

	public static final function X (): Mark
	{
		return X::new();
	}

	public static final function O (): Mark
	{
		return O::new();
	}
}

class X extends Mark
{
	public function spaceMarked (Space $space, SpaceListener $listener): void
	{
		$listener->spaceMarkedWithX($space, $this);
	}

	public function increment (int $x, int $o): array
	{
		return [$x + 1, $o];
	}

	public static function new (): X
	{
		static $singleton = new X();
		return $singleton;
	}
}

class O extends Mark
{
	public function spaceMarked (Space $space, SpaceListener $listener): void
	{
		$listener->spaceMarkedWithO($space, $this);
	}

	public function increment (int $x, int $o): array
	{
		return [$x, $o + 1];
	}

	public static function new (): O
	{
		static $singleton = new O();
		return $singleton;
	}
}