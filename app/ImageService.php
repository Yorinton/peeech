<?php

namespace App;

use Intervention\Image\Facades\Image;
use App\Repositories\User\UserRepositoryInterface;
use Peeech\Domain\Uploader\ImageUploaderInterface;


/**
 *
 */
class ImageService
{

    protected $userRepository;
    protected $uploader;

    public function __construct(UserRepositoryInterface $userRepository, ImageUploaderInterface $uploader)
    {
        $this->userRepository = $userRepository;
        $this->uploader = $uploader;
    }

    public function upload($request, $id)
    {
        //ファイル名取得
        $filename = $request->img_path->getClientOriginalName();


        $ext = substr($filename, strrpos($filename, '.') + 1);
        if (strtolower($ext) !== 'png' && strtolower($ext) !== 'jpg' && strtolower($ext) !== 'gif') {
            echo '画像以外のファイルが指定されています。画像ファイル(png/jpg/jpeg/gif)を指定して下さい';
            exit();
        }
        $tmpname = str_replace('/tmp/', '', $_FILES['img_path']['tmp_name']);
        $new_filename = 'profiles/' . $id . '-' . time() . '-' . $tmpname . '.' . $ext;

        $path = $this->uploader->upload($request, $new_filename);

        $this->userRepository->updateUserProfsById($id, 'img_path', $path);

    }

}
