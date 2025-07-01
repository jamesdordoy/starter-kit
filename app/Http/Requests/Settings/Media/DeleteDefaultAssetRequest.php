<?php

namespace App\Http\Requests\Settings\Media;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDefaultAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $media = $this->route('mediaItem');

        return $media && $media->collection_name === 'default';
    }
}
