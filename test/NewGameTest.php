<?php

declare(strict_types=1);

require_once(__DIR__ . '/TicTacToeTestCase.php');

use PHPUnit\Framework\Attributes\Test;
use TicTacToe\Game;

class NewGameTest extends TicTacToeTestCase
{
    #[Test]
    function NewGame (): void
    {
        $game = Game::new();
        $this->assertInstanceOf(Game::class, $game);
    }
}
