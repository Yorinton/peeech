<?php

namespace App;

use Intervention\Image\Facades\Image;
use App\Repositories\User\UserRepositoryInterface;


/**
 *
 */
class ImageService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function upload($request, $id)
    {
        //ファイル名取得
        $filename = $request->img_path->getClientOriginalName();
        //アップロードしたファイルのパス
        $image = Image::make($request->img_path->getRealPath());
        //保存先パス
        $path = '/images/user_profiles/' . $filename;
        //画像を保存する
        $image->save(public_path() . $path);

        $this->userRepository->updateUserProfsById($id, 'img_path', $path);

    }

}
