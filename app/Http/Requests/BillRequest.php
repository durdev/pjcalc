<?php

namespace App\Http\Requests;

use App\Models\Bill;
use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
        $recurrences = array_keys(Bill::getRecurrences());
        
        return [
            'maxAmount'  => 'nullable|sometimes|min:0', 
            'name'       => 'required', 
            'recurrence' => 'required|digits_between:' . min($recurrences) . ',' . max($recurrences)
        ];
    }

}
