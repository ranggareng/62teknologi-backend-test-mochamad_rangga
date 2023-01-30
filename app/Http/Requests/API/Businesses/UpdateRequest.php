<?php

namespace App\Http\Requests\API\Businesses;

use Illuminate\Foundation\Http\FormRequest;

// Custom Rule
use App\Rules\ContainRule;
use App\Rules\PhotoFromBusinessRule;
use App\Rules\OperationalFromBusinessRule;

class UpdateRequest extends FormRequest
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
            'name' => 'required|max:191',
            'phone' => 'required|max:15',
            'address1' => 'required',
            'address2' => 'nullable',
            'address3' => 'nullable',
            'city' => [
                'required',
                'exists:master_cities,code',
                new ContainRule('state'),
            ],
            'country' => 'required|in:ID',
            'state' => 'required|exists:master_states,code',
            'zip_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'price' => 'required|min:1|max:5',
            'transactions' => 'nullable|array',
            'transactions.*' => 'required|exists:master_transactions,id',
            'category' => 'required|array',
            'category.*' => 'required|exists:master_categories,id',
            'photos' => 'required|array',
            'photos.*' => [
                'required',
                new PhotoFromBusinessRule($this->id)
            ],
            'new_photos' => 'required|array',
            'new_photos.*' => 'required|image',
            'operational' => 'required|array',
            'operational.*' => 'required|array',
            'operational.*.id' => [
                'required',
                new OperationalFromBusinessRule($this->id)
            ],
            'operational.*.day' => 'required|min:0|max:6',
            'operational.*.start' => 'required',
            'operational.*.end' => 'required',
            'operational.*.is_overnight' => 'required|boolean'
        ];
    }
}
