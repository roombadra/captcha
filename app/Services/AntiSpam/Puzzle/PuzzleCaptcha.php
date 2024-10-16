<?php

namespace App\Services\AntiSpam\Puzzle;

use App\Services\AntiSpam\CaptchaInterface;
use Illuminate\Session\SessionManager;

class PuzzleCaptcha implements CaptchaInterface
{
    public const WIDTH = 350;
    public const HEIGHT = 200;
    public const PIECE_WIDTH = 80;
    public const PIECE_HEIGHT = 50;
    private const SESSION_KEY = 'puzzles';
    private const PRECISION = 3;

    private $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session->driver(); // get the actual session store
    }

    public function generateKey(): string
    {
        $now = time();
        $x = mt_rand(0, self::WIDTH - self::PIECE_WIDTH);
        $y = mt_rand(0, self::HEIGHT - self::PIECE_HEIGHT);
        $puzzles = $this->session->get(self::SESSION_KEY, []);
        $puzzles[] = ['key' => $now, 'solution' => [$x, $y]];
        $this->session->put(self::SESSION_KEY, array_slice($puzzles, -10));
        return $now;
    }

    public function veryify(string $key, string $answer): bool
    {
        $expected = $this->getSolution($key);
        if ($expected === null) {
            return false;
        }

        // remove puzzle from session
        $puzzles = $this->session->get(self::SESSION_KEY);
        $filtered = array_filter($puzzles, fn ($puzzle) => $puzzle['key'] !== intval($key));
        $this->session->put(self::SESSION_KEY, $filtered);

        $got = $this->stringToArray($answer);
        return abs($expected[0] - $got[0]) <= self::PRECISION && abs($expected[1] - $got[1]) <= self::PRECISION;
    }

    /**
     * @return int[]|null
     */
    public function getSolution(string $key): ?array
    {
        $puzzles = $this->session->get(self::SESSION_KEY, []);
        foreach ($puzzles as $puzzle) {
            if ($puzzle['key'] !== intval($key)) {
                continue;
            }
            return $puzzle['solution'];
        }
        return null;
    }

    /**
     * @param int[]
     */
    private function stringToArray(string $s): array
    {
        $parts = explode('-', $s, 2);
        if (count($parts) !== 2) {
            return [-1, -1];
        }
        return [intval($parts[0]), intval($parts[1])];
    }
}
