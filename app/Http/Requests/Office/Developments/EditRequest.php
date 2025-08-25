<?php

namespace App\Http\Requests\Office\Developments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Enums\PublishList;
use App\Enums\ServiceList;

class EditRequest extends FormRequest
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

            'category' => [
                'bail',
                'required',
                'max:100',
            ],

            'title' => [
                'bail',
                'required',
                'max:100',
            ],

            'inhouse_developments_image_url' => [
                'bail',
                'nullable',
                'max:8192',
            ],


            'content' => [
                'bail',
                'required',
                'max:1000',
            ],

            'inhouse_developments_home_page_url' => [
                'bail',
                'nullable',
                'max:100',
            ],

            'status' => [
                'bail',
                'required',
                Rule::in(PublishList::getKeys()),
            ],

        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.in'       => '正しい値を入力または選択してください。',
            '*.max'      => ':max文字以内でご入力ください。',
            '*.required' => '必須項目です。',
            '*.regex'      => '正しい値を入力または選択してください。',
        ];
    }
}
