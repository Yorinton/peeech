<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Peeech\Domain\Uploader\ImageUploaderInterface;
use Peeech\Infrastructure\Uploader\S3ImageUploader;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Peeech\Domain\Uploader\ImageUploaderInterface',
            'Peeech\Infrastructure\Uploader\S3ImageUploader'
        );
    }
}
