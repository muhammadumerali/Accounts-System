<?php

namespace App\Http\Requests;

use App\Models\Credential;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCredentialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('credential_edit');
    }

    public function rules()
    {
        return [
            'platform' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'nullable',
            ],
        ];
    }
}
