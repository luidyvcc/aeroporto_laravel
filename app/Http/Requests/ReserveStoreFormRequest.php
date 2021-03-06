<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\CheckAvailableFlight;

class ReserveStoreFormRequest extends FormRequest
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
        // return [
        //     'user_id' => 'required|exists:users,id',
        //     'flight_id' => 'required|exists:flights,id',
        //     'date_reserved' => 'required|date',
        //     'status' => 'required|in:reserved,canceled,paid,concluded',
        // ];
        return [
            'user_id' => 'required|exists:users,id',
            'flight_id' => [
                'required','
                exists:flights,id',
                new CheckAvailableFlight,
            ],
            'date_reserved' => 'required|date',
            'status' => [
                'required',
                Rule::in(['reserved','canceled','paid','concluded'])
            ],
        ];
    }
}
