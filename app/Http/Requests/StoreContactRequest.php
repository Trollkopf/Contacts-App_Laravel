<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('contacts', 'email')
                    ->where('user_id', auth()->id())
                    ->ignore(request()->route('contact'))
            ],
            'phone_number' => [
                'required',
                'digits:9',
                Rule::unique('contacts', 'phone_number')
                    ->where('user_id', auth()->id())
                    ->ignore(request()->route('contact'))
            ],
            'age' => 'required|numeric|min:1|max:255',
            'profile_picture' =>  'image|nullable',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'You already have a contact with this email',
            'phone_number.unique' => 'You already have a contact with this phone number'
        ];
    }
}
