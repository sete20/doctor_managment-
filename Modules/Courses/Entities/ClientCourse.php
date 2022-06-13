<?php

namespace Modules\Courses\Entities;

use Modules\Users\Entities\Client;
use Illuminate\Database\Eloquent\Model;

class ClientCourse extends Model 
{

    protected $table = 'client_course';
    public $timestamps = true;
    protected $fillable = array('client_id', 'course_id', 'status','price','offer_price','is_offered');
    static $status = ['pending','accepted','rejected'];

    public function client()
    {
        return $this->belongsTo(Client::class , 'client_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class , 'client_id');
    }
}