<?php

namespace Modules\Courses\Entities;

use Modules\Users\Entities\Client;
use Illuminate\Database\Eloquent\Model;

class ClientAnswer extends Model
{

    protected $table = 'client_answers';
    public $timestamps = true;
    protected $fillable = array('client_id', 'faq_id', 'answer_id');

    public function client()
    {
        return $this->belongsTo(Client::class , 'client_id');
    }

    public function question()
    {
        return $this->belongsTo(Faq::class , 'faq_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class , 'answer_id');
    }
}