<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{

//    protected $table = 'shobeak_home';
//    public $timestamps = true;
//    protected $fillable = array('section_id','content', 'order');
    public $contents = [
        'categories',
    ];



//    //////////////////////////////
//    /// get attributes
//    public function getTransAttribute()
//    {
//
//    }
//
//    //////////////////////////////////
//    /// scopes
//
//    public function scopeactive($query)
//    {
//        $query->where('is_active' , 1);
//    }
}