<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterForm extends FormRequest
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
            "name"=>"required|string|max:25|min:5",
            "email"=>"required|email|unique:users,email",
            "password"=>"required|string|min:6|max:20"
        ];
    }
    public function messages(): array
    {
        return [
            "name.required"=>"Name is required , kindly enter your name",
            "email.required"=>"Email is required",
            "email.email"=>"Email must be a valid email address",
            "email.unique"=>"Email already exists",
            "password.required"=>"Password is required",
        ];
    }

    public function attributes(): array
    {
        return [
            "name"=>"Full Name",
            "email"=>"Email Address",
            "password"=>"Password"
        ];
    }

    public function failedValidation(Validator $validator){

        throw new HttpResponseException(response()->json([
            "status"=>"error",
            "message"=>"validation error",
            "errors"=>$validator->errors(),
        ],422));
    }



}
