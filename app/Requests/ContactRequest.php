<?php
namespace App\Requests;

class ContactRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|max:255',
            'csrf_token' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'First name is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'email.max' => 'Email address must not exceed 255 characters',
            'message.required' => 'Message is required',
            'message.max' => 'Message must not exceed 255 characters',
            'csrf_token.required' => 'Security token is missing'
        ];
    }

    /**
     * Get sanitized registration data
     */
    public function getRegistrationData(): array
    {
        return [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'message' => $this->input('message')
        ];
    }
}
