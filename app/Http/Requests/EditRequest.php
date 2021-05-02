<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function autorize() {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
//            'auction-title' => 'min:5|max:50|nullable',
//            'auction-description' => 'min:10|max:255|nullable',
//            'auction-start-date' => 'date|nullable',
//            'auction-end-date' => 'date|after:start_date|nullable',
//            'auction-starting-bid' => 'integer|nullable',
//            'auction-category' => 'string|nullable',
//            'auction-nsfw' => 'nullable',
        ];
    }

}
