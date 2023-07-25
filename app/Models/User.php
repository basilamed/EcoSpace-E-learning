<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'birthPlace',
        'birthCountry',
        'birthDate',
        'jmbg',
        'picture',
        'contact',
        'role',
        'gender',
        'email',
        'password',
        'approved'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attends()
    {
        return $this->hasMany(CourseUser::class);
    }
    public function ownsCourse($course)
    {
        return $this->courses->contains($course);
    }
    public function attendsCourse($course)
    {
        $attend = $this->attends->where('course_id', $course->id)->first();
        return $attend ? true : false;
    }
    public function answers()
    {
        return $this->hasMany(AnswerUser::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }

}
