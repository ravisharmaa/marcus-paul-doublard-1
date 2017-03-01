<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $rules = [
                'full_name' =>  'required',
                'email'     =>  'required | email',
                'message'   =>  'required',
                'CaptchaCode' => 'required | valid_captcha'
    ];

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
        return $this->rules;
    }

    public function messages()
    {
        return [
            'full_name.required'        =>      '*Please enter your full name.',
            'email.required'            =>      '*Please enter your email address.',
            'message.required'          =>      '*Please enter your message.',
            'CaptchaCode.required'      =>      '*Please enter the captcha code.'
        ];
    }
}
