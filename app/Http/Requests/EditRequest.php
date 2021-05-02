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
//            'title' => 'min:5|max:50|nullable',
//            'description' => 'min:10|max:255|nullable',
//            'start-date' => 'date|nullable',
//            'end-date' => 'date|after:start_date|nullable',
//            'starting-bid' => 'integer|nullable',
//            'category' => 'string|nullable',
//            'nsfw' => 'nullable',
        ];
    }

}
