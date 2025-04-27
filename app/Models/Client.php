<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'id_number',
        'gender',
        'date_of_birth',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'postal_code',
        'emergency_contact',
        'emergency_phone',
        'medical_history',
    ];

    // Get the client's full name
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Relationship with programs through enrollments
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'enrollments')
            ->withPivot('enrollment_date', 'status', 'notes')
            ->withTimestamps();
    }

    // Relationship with enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
