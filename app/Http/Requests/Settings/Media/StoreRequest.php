<?php

namespace App\Http\Requests\Settings\Media;

use App\Http\Requests\BaseFormRequest;

class StoreRequest extends BaseFormRequest
{
    const MIMES = 'xls,xlsx,csv,doc,docx,pdf,txt,jpg,jpeg,png';

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
                sprintf('max:%s', config('media-library.max_file_size', 2000)),
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
                sprintf('max:%s', config('media-library.max_file_size', 2000)),
                'mimes:'.collect(explode(', ', $this->get('mimes', self::MIMES)))
                    ->filter(fn ($mime) => in_array($mime, explode(', ', self::MIMES)))
                    ->implode(', '),
            ],
        ];
    }
}
