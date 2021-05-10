<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFiltersRequest extends FormRequest
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
            'fts' => 'nullable|string',
            'filter_check_auction' => 'nullable|string',
            'owner_filter' => 'nullable|string',
            'user_min_rating' => 'nullable|integer',
            'join_from' => 'nullable|date',
            'join_to' => 'nullable|date'
        ];
    }
}
