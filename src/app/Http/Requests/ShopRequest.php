<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'store_name' => 'required|max:50',
            'area' => 'required|string|max:20',
            'genre' => 'required|string|max:20',
            'overview' => 'required|max:255',
            'picture' => 'required',
        ];
    }

    public function messages(){
        return [
        'store_name.required' => '店名を入力してください',
        'store_name.max' => '店名は50文字以内としてださい',
        'area.required' => 'エリアを入力してください',
        'area.string' => 'エリアは都道府県名を入力してください',
        'area.max' => 'エリアは20文字以内としてださい',
        'genre.required' => 'ジャンルを入力してください',
        'genre.string' => 'ジャンルは文字列を入力してください',
        'genre.max' => 'ジャンルは20文字以内としてださい',
        'overview.required' => '概要を入力してください',
        'overview.max' => '概要は255文字以内としてださい',
        'picture.required' => '画像を登録してください',
        ];
    }
}