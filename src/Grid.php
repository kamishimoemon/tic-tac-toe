<?php

declare(strict_types=1);

namespace TicTacToe;

interface Grid
{
	public function lineCompleted (Line $line, Mark $mark): void;
}