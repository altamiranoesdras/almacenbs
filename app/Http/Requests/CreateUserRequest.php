<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CreateUserRequest extends FormRequest
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
        return User::$rules;
    }

    public function messages()
    {
        return User::$messages;
    }

    public function all($keys = null)
    {
        $inputs = parent::input();


        $inputs['password'] = bcrypt($inputs['password']);

        return $inputs;
    }

}
