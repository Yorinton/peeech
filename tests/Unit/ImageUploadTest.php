<?php

namespace Tests\Unit;

use Peeech\Infrastructure\Uploader\S3ImageUploader;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImageUploadTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testImageUpload()
    {

        $uploader = new S3ImageUploader();
        $uploader->upload();

        $this->assertTrue(true);
    }
}
