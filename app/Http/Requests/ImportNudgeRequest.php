<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportNudgeRequest extends FormRequest
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
            'sample_file' => 'required',
            'schedule_at' => 'required'
//            'sample_file' => 'required|mimes:application/vnd.ms-excel'
        ];
    }


    public function messages(){
        return [
            'sample_file.required' => 'Please select nudge excel file',
            'schedule_at.required' => 'Please select SMS schedule date and time.'
//            'sample_file.mimes' => 'Please upload valid excel'
        ];
    }
}
