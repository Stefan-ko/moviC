<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
class ImageService
{
    protected $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }
    public function storeAndCropImage($file, $folder, $width, $height)
    {
        $path = $file->store($folder);
        $url = Storage::url($path);
        $image = $this->imageManager->read(storage_path('app/' . $path));
        $image->resize($width, $height);
        $image->save();

        return $url;
    }

    public function storeAndCropMultipleImages($files, $folder, $width, $height)
    {
        $urls = [];
        foreach ($files as $file) {
            $urls[] = $this->storeAndCropImage($file, $folder, $width, $height);
        }

        return $urls;
    }
}
