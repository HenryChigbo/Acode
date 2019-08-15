<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannersRequest extends FormRequest
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
        return [
            'photo_one' => 'nullable|mimes:png,jpg,jpeg,gif',
            'photo_two' => 'nullable|mimes:png,jpg,jpeg,gif',
            'photo_three' => 'nullable|mimes:png,jpg,jpeg,gif',
            'photo_four' => 'nullable|mimes:png,jpg,jpeg,gif',
            'photo_five' => 'nullable|mimes:png,jpg,jpeg,gif',
        ];
    }
}
