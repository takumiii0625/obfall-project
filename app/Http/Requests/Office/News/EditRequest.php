<?php

namespace App\Http\Requests\Office\News;

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

            'title' => [
                'bail',
                'required',
                'max:100',
            ],

            'news_image_url_1' => [
                'bail',
                'nullable',
                'max:8192',
            ],
            'news_image_url_2' => [
                'bail',
                'nullable',
                'max:8192',
            ],
            'news_image_url_3' => [
                'bail',
                'nullable',
                'max:8192',
            ],

            'content' => [
                'bail',
                'required',
                'max:1000',
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
