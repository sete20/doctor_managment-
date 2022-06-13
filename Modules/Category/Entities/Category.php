<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ScopesTrait;
use Modules\Courses\Entities\Course;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use Translatable , SoftDeletes , ScopesTrait , InteractsWithMedia;

    protected $with 					    = ['translations','children'];
  	protected $fillable 					= ['status' , 'type' , 'category_id' ,'description'];
  	public $translatedAttributes 	        = [ 'title','description'];
    public $translationModel 			    = CategoryTranslation::class;

    public function parent()
    {
        return $this->belongsTo(Category::class,  'category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function scopeMainCategories($query)
    {
        return $query->where('category_id', '=', null);
    }
}
