<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
            "title" => ['required','string','max:255'],
            "startdate" => ['required','date','before:enddate','after:yesterday'],
            "enddate" =>  ['required','date','after:startdate'],
            "content" => 'required',
            
            
        ];
    }
    public function messages()
    {
        return [
            "startdate.before" => "Start Date must be before End Date.",
            "startdate.after" => "Start Date must be today onwards.",
            "enddate.after" => "End Date must be after Start Date.",
        ];
    }
}
