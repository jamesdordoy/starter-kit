<?php

namespace App\Http\Requests\Settings\Media;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    const MIMES = 'xls,xlsx,csv,doc,docx,pdf,txt,jpg,jpeg,png';

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
    public function rules(): array
    {
        return [
            'file' => [
                'sometimes',
                'file',
                'max:2000',
                'mimes:'.collect(explode(',', $this->get('mimes', self::MIMES)))
                    ->filter(fn ($mime) => in_array($mime, explode(',', self::MIMES)))
                    ->implode(','),
            ],
            'files' => [
                'sometimes',
                'array',
            ],
            'files.*' => [
                'file',
                'max:2000',
                'mimes:'.collect(explode(', ', $this->get('mimes', self::MIMES)))
                    ->filter(fn ($mime) => in_array($mime, explode(', ', self::MIMES)))
                    ->implode(', '),
            ],
        ];
    }
}
