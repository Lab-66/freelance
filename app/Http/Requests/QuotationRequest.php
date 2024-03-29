<?php

namespace App\Http\Requests;

use Efriandika\LaravelSettings\Facades\Settings;

class QuotationRequest extends Request
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
            'customer_id' => 'required',
            'date' => 'required|date_format:"'.Settings::get('date_format').'"',
            'exp_date' => 'required|date_format:"'.Settings::get('date_format').'"',
            'payment_term' => 'required',
            'sales_person_id' => 'required',
            'sales_team_id' => 'required',
            'grand_total' => 'required',
            'total' => 'required',
            'final_price' => 'required',
        ];
    }
}
