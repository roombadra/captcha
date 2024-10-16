<?php

namespace App\Services\AntiSpam\Puzzle;

use Illuminate\Http\Response;
use Intervention\Image\ImageManager;
use App\Services\AntiSpam\CaptchaGenerator;

class PuzzleGenerator implements CaptchaGenerator
{
    public function __construct(private readonly PuzzleCaptcha $puzzleCaptcha)
    {
    }
    public function generate(string $key): Response
    {
        $position = $this->puzzleCaptcha->getSolution($key);
        if (!$position) {
            return new Response(null, 404);
        }
        [$x, $y] = $position;
        // Utiliser la méthode asset() pour obtenir l'URL de l'image
        $backgroundPath = asset('me.png');
        $piecePath = asset('puzzle-piece.png');

        $manager = new ImageManager();
        $image = $manager->make($backgroundPath);
        $piece = $manager->make($piecePath);
        $hole = clone $piece;
        $piece->insert($image, 'top-left', -$x, -$y)
            ->mask($hole, true);
        $image
            ->resizeCanvas(
                PuzzleCaptcha::PIECE_WIDTH,
                0,
                'left',
                true,
                'rgba(0,0,0,0)'
            )
            ->insert($piece, 'top-right')
            ->insert($hole->opacity(60), 'top-left', $x, $y);


        return $image->response('png');
    }
}
