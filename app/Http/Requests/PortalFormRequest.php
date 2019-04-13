<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortalFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:40',
            'color' => 'required|string',
            'logo' => 'required',
            'background' => 'required',
        ];
    }

    public function getData()
    {
        $data = $this->only(['name', 'color', 'logo', 'background', 'password']);
        $data['access'] = $this->has('access');

        return $data;
    }

}
