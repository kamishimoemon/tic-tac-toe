<?php

declare(strict_types=1);

namespace Kamishimoemon\TicTacToe;

interface RowListener
{
	function rowCompleted (Row $row): void;
}