<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonsRequest extends FormRequest
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
            
            'name' => 'min:1|max:70|required',
            'description' => 'min:1|max:70|required',
            'avatar' => 'nullable|mimes:png,jpg,jpeg,gif',
            'color_background' => 'required',
            'color_foreground' => 'required',
        ];
    }
}
