<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateAuctionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:50',
            'description' => 'required|min:10|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'starting_bid' => 'required|integer',
            'increment_percent' => 'required_without:increment_fixed|numeric|integer|max:50',
            'increment_fixed' => 'required_without:increment_percent|numeric|integer',
            'category' => 'required|string',
            'nsfw' => 'nullable',
            'image' => 'required',
            'image.*' => 'required|image|mimes:jpeg,jpg,png'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
     
        // converting date and hour to datetime
        if ($this->has(['start_date', 'start_time'])) {
            $start_datetime = $this->input('start_date')." ".$this->input('start_time');
            $this->merge(['start_date' => $start_datetime]);
        }

        if ($this->has(['end_date', 'end_time'])) {
            $end_datetime = $this->input('end_date')." ".$this->input('end_time');
            $this->merge(['end_date' => $end_datetime]);
        }

        // determine if minimum increment is percentage or fixed
        if ($this->has('increment_val')) {
            if ($this->has('percent_check') && $this->input('percent_check')) // percentual
                $this->merge(['increment_percent' => $this->input('increment_val')]);
            else // fixed
                $this->merge(['increment_fixed' => $this->input('increment_val')]);
        }
    }
}
