<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Experience extends Model
{
    protected $fillable = [
        'client_name', 'company_logo', 'position', 'project_type',
        'start_date', 'end_date', 'is_current', 'location', 'description',
        'technologies', 'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getTechnologiesArrayAttribute(): array
    {
        if (!$this->technologies) return [];
        return array_map('trim', explode(',', $this->technologies));
    }

    public function getDurationAttribute(): string
    {
        $start = $this->start_date;
        $end = $this->is_current ? Carbon::now() : $this->end_date;
        $months = $start->diffInMonths($end);
        $years = intdiv($months, 12);
        $rem = $months % 12;
        $parts = [];
        if ($years > 0) $parts[] = $years . ' yr' . ($years > 1 ? 's' : '');
        if ($rem > 0) $parts[] = $rem . ' mo' . ($rem > 1 ? 's' : '');
        return implode(' ', $parts) ?: '< 1 mo';
    }
}
