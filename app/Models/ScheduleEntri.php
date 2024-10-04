<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ScheduleEntri extends Model
{
    use HasFactory;

    protected $table = 'schedule_entries';

    protected $fillable = [
        'day',
        'session',
        'start_time',
        'end_time',
        'grub',
        'course',
        'room',
        'credits',
        'schedule_id',
        'lecturer_id',
    ];

    public function schedules(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    // Relasi dengan model Lecturer
    public function lecturers()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id'); // Pastikan kolom 'lecturer_id' ada di tabel schedule_entries
    }

    
}
