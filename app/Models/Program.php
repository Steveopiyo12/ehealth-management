<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'eligibility',
        'start_date',
        'end_date',
        'capacity',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationship with clients through enrollments
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'enrollments')
            ->withPivot('enrollment_date', 'status', 'notes')
            ->withTimestamps();
    }

    // Relationship with enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Get count of enrolled clients
    public function getEnrolledCountAttribute()
    {
        return $this->enrollments()->count();
    }

    // Get available capacity
    public function getAvailableCapacityAttribute()
    {
        return $this->capacity - $this->enrolled_count;
    }
}
