<?php

namespace App\Http\Requests\API\Businesses;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'categories' => 'array',
            'categories.*' => 'filled',
            'price' => 'array',
            'price.*' => 'filled',
            'limit' => 'filled|integer',
            'offset' => 'filled|integer',
            'sort_by' => 'filled|in:name,price',
            'sort_type' => 'filled|required_with:sort_by|in:asc,desc'
        ];
    }
}
