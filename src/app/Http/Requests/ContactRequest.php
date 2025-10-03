<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name'   => 'required|string|max:255',
            'first_name'  => 'required|string|max:255',
            'gender'      => 'required|in:1,2,3', // 1=男性,2=女性,3=その他のみ許可
            'email'       => 'required|email|max:255',

            //  電話番号は3分割入力
            'tel1'        => 'required|digits_between:2,4|numeric',
            'tel2'        => 'required|digits_between:2,4|numeric',
            'tel3'        => 'required|digits_between:3,4|numeric',

            'address'     => 'required|string|max:255',
            'building'    => 'nullable|string|max:255', //  任意入力
            'category_id' => 'required|exists:categories,id',
            'detail'      => 'required|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'gender.in'            => '性別は「男性・女性・その他」から選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',

            // 電話番号のエラーメッセージ
            'tel1.required'        => '電話番号を入力してください',
            'tel1.numeric'         => '電話番号を入力してください',
            'tel2.required'        => '電話番号を入力してください',
            'tel2.numeric'         => '電話番号を入力してください',
            'tel3.required'        => '電話番号を入力してください',
            'tel3.numeric'         => '電話番号を入力してください',

            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問い合わせ内容は2000文字以内で入力してください',
        ];
    }
}