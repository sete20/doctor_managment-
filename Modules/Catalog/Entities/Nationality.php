<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;
use Modules\User\Entities\Client;

class Nationality extends Model 
{
    use CrudModel,SoftDeletes, HasTranslations;

    protected $table = 'nationalities';
    public $timestamps = true;
    protected $fillable 		  = [ 'status','title' ];
    public $translatable  = [ 'title' ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

}