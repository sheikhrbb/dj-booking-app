<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = ['section', 'content'];

    protected $casts = [
        'social_links' => 'array',
    ];
}
