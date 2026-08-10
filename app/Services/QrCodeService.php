<?php

namespace App\Services;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QrCodeService
{
    public static function generatePng(string $data, string $prefix = 'qr'): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle(320),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $svgData = $writer->writeString($data);

        $directory = public_path('uploads/restaurant/qr');
        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        $filename = $prefix . '_' . time() . '_' . uniqid() . '.svg';
        $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
        file_put_contents($filePath, $svgData);

        return 'uploads/restaurant/qr/' . $filename;
    }
}
