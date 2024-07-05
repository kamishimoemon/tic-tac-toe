<?php

declare(strict_types=1);

namespace Kamishimoemon\TicTacToe;

abstract class Mark
{
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
	public static function new (): X
	{
		static $singleton = new X();
		return $singleton;
	}
}

class O extends Mark
{
	public static function new (): O
	{
		static $singleton = new O();
		return $singleton;
	}
}