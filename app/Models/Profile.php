<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'tagline', 'email', 'phone', 'location', 'website',
        'github', 'linkedin', 'twitter', 'instagram', 'about',
        'avatar', 'resume_file', 'open_to_work',
    ];

    protected $casts = [
        'open_to_work' => 'boolean',
    ];

    public static function getMain(): self
    {
        return self::firstOrNew(['id' => 1]);
    }
}
