<?php

declare(strict_types=1);

namespace TicTacToe;

class Game
{
        private array $spaces = [];
        private ?Mark $currentMark = null;
        private array $listeners = [];

        public function place (Mark $mark, Position $position): void
        {
                if ($this->currentMark !== null) {
                        $this->currentMark->validateTurn($mark);
                }

		if (isset($this->spaces[$position->value])) {
			throw new InvalidMove();
		}

                $this->spaces[$position->value] = $mark;
                $this->currentMark = $mark;

                if (count($this->spaces) === count(Position::cases())) {
                        $this->gameOver();
                }
        }

        public function attach (GameListener $listener): void
        {
                $this->listeners[] = $listener;
        }

        private function gameOver (): void
        {
                foreach ($this->listeners as $listener) {
                        $listener->gameOver($this);
                }
        }

        public static function new (): Game
        {
                return new Game();
        }
}
