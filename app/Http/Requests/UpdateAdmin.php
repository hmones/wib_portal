<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateAdmin extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => 'required|string',
            'email'    => 'required|email|unique:admins,email,' . auth()->guard('admin')->user()->id,
            'password' => 'sometimes|nullable|confirmed|string|min:8',
        ];
    }

    public function validated()
    {
        $data = parent::validated();

        if (data_get($data, 'password')) {
            Arr::set($data, 'password', bcrypt($data['password']));
        } else {
            Arr::forget($data, 'password');
        }

        return $data;
    }
}
