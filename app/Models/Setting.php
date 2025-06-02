<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'uri', 'method', 'label'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('site_logo')->singleFile();
    }
}
