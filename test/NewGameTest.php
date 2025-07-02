<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use TicTacToe\Game;

class NewGameTest extends TestCase
{
    #[Test]
    function NewGame (): void
    {
        $game = Game::new();
        $this->assertInstanceOf(Game::class, $game);
    }
}
