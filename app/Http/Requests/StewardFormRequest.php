<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StewardFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function messages(): array
    {
        return [
            'race_session.required' => 'Race Session is required',
            'track_name.required' => 'Track Name is required',
            'turn_number.required' => 'Turn Number is required',
            'your_race_number.required' => 'Please Provide Your Race Number',
            'offending_car_race_number.required' => 'Please Provide Offending Car Race Number',
            'video_link.required' => 'Please provide the video link',
            'comments.required' => 'You must provide comments',
        ];
    }

    public function rules(): array
    {
        return [
            'turn_number' => 'required',
            'your_race_number' => 'required',
            'offending_car_race_number' => 'required',
            'video_link' => 'required',
            'comments' => 'required',
        ];
    }
}
