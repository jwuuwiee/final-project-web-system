<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;


class AvatarService
{
    private const SIZE = 300;
    private const DIRECTORY = 'avatars';
    private const DISK = 'public';

    public function store(UploadedFile $file): string
    {
        $info = @getimagesize($file->getRealPath());

        if ($info === false) {
            throw new RuntimeException('The uploaded file is not a valid image.');
        }

        [$width, $height, $type] = $info;

        $source = match ($type) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($file->getRealPath()),
            IMAGETYPE_PNG => imagecreatefrompng($file->getRealPath()),
            default => throw new RuntimeException('Only JPG and PNG images are supported.'),
        };

        $side = min($width, $height);
        $srcX = (int) (($width - $side) / 2);
        $srcY = (int) (($height - $side) / 2);

        $canvas = imagecreatetruecolor(self::SIZE, self::SIZE);
        imagefill($canvas, 0, 0, imagecolorallocate($canvas, 255, 255, 255));
        imagecopyresampled($canvas, $source, 0, 0, $srcX, $srcY, self::SIZE, self::SIZE, $side, $side);

        ob_start();
        imagejpeg($canvas, null, 85);
        $jpeg = ob_get_clean();

        imagedestroy($source);
        imagedestroy($canvas);

        $path = self::DIRECTORY . '/' . Str::uuid() . '.jpg';
        Storage::disk(self::DISK)->put($path, $jpeg);

        return $path;
    }

   
    public function delete(?string $path): void
    {
        if ($path) {
            Storage::disk(self::DISK)->delete($path);
        }
    }
}
