<?php

namespace Peeech\Domain\Uploader;

use Illuminate\Http\Request;

interface ImageUploaderInterface
{
    public function upload(Request $request,string $new_filename);
}