<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseHearing extends Model
{
    use HasFactory;

    protected $table = 'case_hearings';

    protected $fillable = [
        'case_id',
        'hearing_date',
        'hearing_time',
        'court_room',
        'hearing_status',
        'next_hearing_date',
        'outcome_notes',
    ];

    protected $casts = [
        'hearing_date' => 'date',
        'next_hearing_date' => 'date',
    ];

    public function legalCase()
    {
        return $this->belongsTo(LegalCase::class, 'case_id');
    }
}
