<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTest extends Model
{
    use HasFactory;

    protected $table = 'student_tests';

    protected $fillable = [
        'customer_id',
        'company_id',
        'batch_id',
        'test_name',
        'test_date',
        'total_marks',
        'results',
    ];

    protected $casts = [
        'test_date' => 'date',
        'results' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
