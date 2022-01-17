<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\PseudoTypes\True_;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'firstname'=>['required','min:2','alpha'],
            'lastname'=>['required','min:2','alpha'],
            'email'=>['required','unique:users','email'],
            'password'=>['required','min:6','max:12'],
            'cpassword'=>['required','min:6','max:12','required_with:password','same:password'],
            'status'=>['required'],
        ];
        return $rules;
    }
}
