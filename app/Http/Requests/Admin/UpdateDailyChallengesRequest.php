<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDailyChallengesRequest extends FormRequest
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
            
            'name' => 'required|unique:daily_challenges,name,'.$this->route('daily_challenge'),
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif',
        ];
    }
}
