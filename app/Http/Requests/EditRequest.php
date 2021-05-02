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
            'title' => 'min:5|max:50|required',
            'description' => 'min:10|max:255|required',
            'start_date' => 'date|required',
            'end_date' => 'date|after:start_date|required',
            "increment" => "integer|required",
            'starting_bid' => 'integer|required',
            'category' => 'string|required',
            'nsfw' => 'nullable',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation() {
        // Converting date and hour to datetime
        if ($this->has(['start_date', 'start_time'])) {
            $start_datetime = $this->input('start_date') . " " . $this->input('start_time');
            $this->merge(['start_date' => $start_datetime]);
        }

        if ($this->has(['end_date', 'end_time'])) {
            $end_datetime = $this->input('end_date') . " " . $this->input('end_time');
            $this->merge(['end_date' => $end_datetime]);
        }
    }
}
