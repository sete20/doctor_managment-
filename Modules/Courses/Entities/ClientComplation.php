<?php

namespace Modules\Courses\Entities;

use App\Traits\GetAttribute;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;
use Modules\Users\Entities\Client;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ClientComplation extends Model
{
   protected $table = 'client_completions';

   protected $fillable = ['lesson_id','client_id'];

   public function client()
   {
       return $this->belongsTo(Client::class,'client_id');
   }

   public function lesson()
   {
       return $this->belongsTo(Lesson::class,'client_id');
   }
}