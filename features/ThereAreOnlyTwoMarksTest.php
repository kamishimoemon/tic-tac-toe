<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use TicTacToe\Mark;

class ThereAreOnlyTwoMarksTest extends TestCase
{
	#[Test]
	function X (): void
	{
		$this->assertInstanceOf(Mark::class, Mark::X);
	}

	#[Test]
	function O (): void
	{
		$this->assertInstanceOf(Mark::class, Mark::O);
	}

	#[Test]
	function other (): void
	{
		$this->expectException(Error::class);
		$this->assertInstanceOf(Mark::class, new Mark('Y'));
	}
}
