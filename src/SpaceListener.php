<?php

declare(strict_types=1);

namespace Kamishimoemon\TicTacToe;

interface SpaceListener
{
	function spaceMarked (Space $space, Mark $mark): void;
}