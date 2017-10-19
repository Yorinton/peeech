<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'sex' => 'required',
            'year' => 'required|integer',
            'month' => 'required|integer',
            'day' => 'required|integer',
            'added_idol' => 'required',
            'region' => 'required',
            'purpose' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ニックネームを入力して下さい',
            'name.max:20' => 'ニックネームは20文字以内でご入力下さい',
            'email.required' => 'メールアドレスは必須です(非公開)',
            'email.email' => 'メールアドレスの形式で入力して下さい',
            'email.unique:users,email' => '入力されたメールアドレスは登録済みです',
            'sex.required' => '性別を選択して下さい',
            'year.required' => '生まれた年を指定して下さい',
            'year.integer' => '生まれた年を指定して下さい',
            'month.required' => '生まれた月を指定して下さい',
            'month.integer' => '生まれた月を指定して下さい',
            'day.required' => '生まれた日を指定して下さい',
            'day.integer' => '生まれた日を指定して下さい',
            'added_idol.required' => '好きなアイドルを一組以上選択して下さい',
            'region.required' => '地域を選択して下さい',
            'purpose.required' => 'ご利用目的を選択して下さい',
        ];
    }
}
