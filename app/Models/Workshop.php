<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'speaker_name',
        'capacity',
        'start_time',
        'end_time',
        'location',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * ตรวจสอบว่าที่นั่งเต็มหรือยัง
     */
    public function isFull(): bool
    {
        return $this->registrations()->count() >= $this->capacity;
    }

    /**
     * จำนวนที่นั่งที่เหลืออยู่
     */
    public function remainingSeats(): int
    {
        return max(0, $this->capacity - $this->registrations()->count());
    }
}
