<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'number' => 'required|integer|min:1|max:100',
            'reserve_date' => 'required',
            'reserve_time' => 'required',
            'review' => 'max:100',
        ];
    }

    public function messages(){
        return [
        'number.required' => '人数を入力してください',
        'number.min' => '人数は１人以上としてください',
        'number.max' => '人数は100人以下としてください',
        'reserve_date.required' => '日付を入力してください',
        'reserve_time.required' => '時間を入力してください',
        'review.max' => '100文字以内としてください。',
        ];
    }
}
