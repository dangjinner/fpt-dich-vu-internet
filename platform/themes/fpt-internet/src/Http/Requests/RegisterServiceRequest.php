<?php

namespace Theme\FptInternet\Http\Requests;

use Botble\Support\Http\Requests\Request;

class RegisterServiceRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required|string',
            'service' => 'required|string',
        ];
    }
}
