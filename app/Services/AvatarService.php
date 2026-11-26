<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class AvatarService
{
    private const SIZE = 300;
    private const DIRECTORY = 'avatars';
    private const DISK = 'public';

    public function store(UploadedFile $file): string
    {
        if (! extension_loaded('gd')) {
            throw ValidationException::withMessages([
                'avatar' => 'Enable the PHP GD extension to process avatars.',
            ]);
        }

        $source = @imagecreatefromstring(
            file_get_contents($file->getRealPath())
        );

        if ($source === false) {
            throw ValidationException::withMessages([
                'avatar' => 'The image could not be processed.',
            ]);
        }

        $canvas = imagecreatetruecolor(
            self::SIZE,
            self::SIZE
        );

        try {
            $width = imagesx($source);
            $height = imagesy($source);
            $side = min($width, $height);

            $srcX = (int) (($width - $side) / 2);
            $srcY = (int) (($height - $side) / 2);

            imagefill(
                $canvas,
                0,
                0,
                imagecolorallocate($canvas, 255, 255, 255)
            );

            imagecopyresampled(
                $canvas,
                $source,
                0,
                0,
                $srcX,
                $srcY,
                self::SIZE,
                self::SIZE,
                $side,
                $side,
            );

            ob_start();

            try {
                if (! imagejpeg($canvas, null, 85)) {
                    throw new RuntimeException(
                        'Could not encode the avatar.'
                    );
                }

                $jpeg = ob_get_contents();
            } finally {
                ob_end_clean();
            }

            $path = self::DIRECTORY.'/'.Str::uuid().'.jpg';

            if (! Storage::disk(self::DISK)->put($path, $jpeg)) {
                throw new RuntimeException(
                    'Could not save the avatar.'
                );
            }

            return $path;
        } finally {
            imagedestroy($source);
            imagedestroy($canvas);
        }
    }

    public function delete(?string $path): void
    {
        if (
            $path !== null
            && preg_match(
                '/\Aavatars\/[a-f0-9-]{36}\.jpg\z/',
                $path
            ) === 1
        ) {
            Storage::disk(self::DISK)->delete($path);
        }
    }
}
