<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuctionFiltersRequest extends FormRequest
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
            'filter_check_category' => 'nullable|string',
            'owner_filter' => 'nullable|string',
            'filter_check_timeframe' => 'nullable|string',
            'min_bid' => 'nullable|integer',
            'max_bid' => 'nullable|integer'
        ];
    }
}
