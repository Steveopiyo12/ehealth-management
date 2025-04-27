<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'program_id',
        'enrollment_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
    ];
    
    // Ensure proper date format for SQLite database
    public function setEnrollmentDateAttribute($value)
    {
        $this->attributes['enrollment_date'] = date('Y-m-d', strtotime($value));
    }

    // Relationship with client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relationship with program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
