<?php

namespace Peeech\Infrastructure\Uploader;

use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Peeech\Domain\Uploader\ImageUploaderInterface;


class S3ImageUploader implements ImageUploaderInterface
{
    public function upload(Request $request,string $new_filename)
    {
        $s3client = S3Client::factory([
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
            'region' => 'us-east-2',
            'version' => 'latest',
        ]);
        $bucket = getenv('S3_BUCKET_NAME')?: die('No "S3_BUCKET_NAME" config var in found in env!');
        $image = fopen($_FILES['img_path']['tmp_name'],'rb');

        $result = $s3client->putObject([
            'ACL' => 'public-read',
            'Bucket' => $bucket,
            'Key' => $new_filename,
            'Body' => $image,
            'ContentType' => mime_content_type($_FILES['img_path']['tmp_name']),
        ]);

        //読み取り用のパスを返す
        return $result['ObjectURL'];

    }
}
