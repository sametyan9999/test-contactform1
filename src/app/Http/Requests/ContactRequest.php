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
            'gender'      => 'required|integer',
            'email'       => 'required|email|max:255',

            // 📞 電話番号は3分割入力
            'tel1'        => 'required|digits_between:2,4',
            'tel2'        => 'required|digits_between:2,4',
            'tel3'        => 'required|digits_between:3,4',

            'address'     => 'required|string|max:255',
            'building'    => 'nullable|string|max:255', // ★ 任意入力
            'category_id' => 'required|integer|exists:categories,id',
            'detail'      => 'required|string|max:2000',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',

            // 📞 電話番号3分割のエラーメッセージ
            'tel1.required'        => '電話番号を入力してください',
            'tel2.required'        => '電話番号を入力してください',
            'tel3.required'        => '電話番号を入力してください',

            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問合せ内容は2000文字以内で入力してください',
        ];
    }
}