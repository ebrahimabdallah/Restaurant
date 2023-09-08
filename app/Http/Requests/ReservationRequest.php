<?php

namespace App\Http\Requests;

use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'tel_number' => 'required',
            'email' => 'required',
            'res_data' => ['required',new DateBetween,new TimeBetween],
            'table_id' => 'required',
            'gust_number' => 'required',
        ];
    }
    
}
