<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'date',
        'groupe',
        'course_name',
        'details',
        'professor_id',
    ];

    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id');
    }
}
