<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Rules\AfterToday;
use Carbon\Carbon;

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
            'start_date' => ['required', 'date', new AfterToday],
            'end_date' => 'required|date|after:start_date',
            'starting_bid' => 'required|integer',
            'increment_percent' => 'required_without:increment_fixed|numeric|integer|min:1|max:50',
            'increment_fixed' => 'required_without:increment_percent|numeric|integer|min:1',
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
            $start_datetime = Carbon::createFromFormat('Y-m-d H:i', $this->input('start_date')." ".$this->input('start_time'));
            $start_datetime->setTimezone('Europe/London');
            $this->merge(['start_date' => $start_datetime]);
        }

        if ($this->has(['end_date', 'end_time'])) {
            $end_datetime = Carbon::createFromFormat('Y-m-d H:i', $this->input('end_date')." ".$this->input('end_time'));
            $this->merge(['end_date' => $end_datetime]);
        }

        if ($this->has('starting_bid')) {
            $this->merge(['starting_bid' => ceil($this->input('starting_bid') * 100)]);
        }

        // determine if minimum increment is percentage or fixed
        if ($this->has('increment_val')) {
            if ($this->has('percent_check') && $this->input('percent_check')) // percentual
                $this->merge(['increment_percent' => $this->input('increment_val')]);
            else // fixed
                $this->merge(['increment_fixed' => ceil($this->input('increment_val') * 100)]);
        }
    }
}
