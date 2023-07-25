<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contents()
    {
        return $this->hasMany(CourseContent::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attends()
    {
        return $this->hasMany(CourseUser::class);
    }
}
