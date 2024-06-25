<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'first_name'=> 'String|max:255',
            'last_name'=> 'String|max:255',
            'phone'=> [ 'string', 'max:13', 'regex:/^\+?[0-9]{7,13}$/'],
            'email'=> 'email',
            'gender'=> 'String|in:male,female,others',
//            'company_id'=> 'required|Exist:companies,id',
        ];
    }
}
