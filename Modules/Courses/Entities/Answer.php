<?php

namespace Modules\Courses\Entities;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\ScopesTrait;
use Modules\Users\Entities\Client;

class Answer extends Model
{
    use SoftDeletes, CrudModel;

    protected $fillable = ['status', 'faq_id', 'true_answer','title'];

    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'client_answers');
    }
}
