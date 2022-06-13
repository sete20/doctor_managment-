<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model 
{

    protected $table = 'attachments';
    public $timestamps = true;
    protected $fillable = array('path','usage');

    public function attachmentable()
    {
        return $this->morphTo();
    }

}