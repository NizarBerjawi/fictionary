<?php

namespace App\Fictionary\Profiles\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * The validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:profiles,username',
            'date_of_birth' => 'sometimes|date_format:Y-m-d',
            'gender' => 'nullable|sometimes|string',
            'country' => 'nullable|sometimes|string',
            'genres' => 'sometimes|array',
            'genres.*' => 'uuid',
            'photo' => 'sometimes|json',
            'about_me' => 'nullable|sometimes|string'
        ];
    }
}
