<?php

namespace Peeech\Infrastructure\Uploader;


use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Peeech\Domain\Uploader\ImageUploaderInterface;

class FilesystemImageUploader implements ImageUploaderInterface
{

    public function upload(Request $request, string $new_filename)
    {
        // アップロードしたファイルのパス
        $image = Image::make($request->img_path->getRealPath());

        // 保存先パス
        $path = '/images/' . $new_filename;

        // 画像を保存する
        $image->save(public_path() . $path);

        return $path;
    }
}