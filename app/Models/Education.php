<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'institution', 'institution_logo', 'degree', 'field_of_study',
        'start_date', 'end_date', 'is_current', 'gpa', 'description', 'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'gpa' => 'float',
        'sort_order' => 'integer',
    ];
}
