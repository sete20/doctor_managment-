<?php

namespace Modules\Doctors\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Core\Traits\ScopesTrait;
use Modules\Courses\Entities\Course;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable ,SoftDeletes,ScopesTrait;

    protected $table = 'doctors';
    protected $fillable = ['name', 'status','image','email','password'];

    public function cources()
    {
        return $this->belongsTo(Course::class, 'doctor_id');
    }
}
