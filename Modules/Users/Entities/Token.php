<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class Token extends Model 
{

    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = array('os', 'serial_number','token');

    public function tokenable()
    {
        return $this->morphTo();
    }



    public function scopeCheckType($query,$relation)
    {
        $type = '';

        switch ($relation)
        {
            case 'clients':
                $type = 'Modules\Users\Entities\Client';
                break;
        }

        $query->where('tokenable_type' , $type);
    }
}