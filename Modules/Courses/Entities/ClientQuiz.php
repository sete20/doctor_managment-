<?php

namespace Modules\Courses\Entities;

use Modules\Users\Entities\Client;
use Illuminate\Database\Eloquent\Model;

class ClientQuiz extends Model
{

    protected $table = 'client_quiz';
    public $timestamps = true;
    protected $fillable = array('client_id','quiz_id','wright_answers_count','question_count');
    protected $hidden = ['created_at' ,'updated_at'];

    public function quiz()
    {
        return $this->belongsTo(Lesson::class , 'quiz_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class , 'client_id');
    }
}