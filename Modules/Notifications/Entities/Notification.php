<?php

namespace Modules\Notifications\Entities;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\Client;

class Notification extends Model
{
    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('notifiable_type', 'notifiable_id', 'title', 'body');

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function clients()
    {
        return $this->morphedByMany(Client::class, 'notifiable')->withPivot('is_read');
    }

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachmentable');
    }

    public function getPhotoAttribute()
    {
        return $this->image ? asset($this->image->path) : null;
    }


    /////////////////////////////////////
    /// get Attribute
    public function getTypeAttribute()
    {
        return $this->SwitchNotification($this->notifiable_type, 'type');
    }

    public function getIsGeneralAttribute()
    {
        return $this->SwitchNotification($this->notifiable_type, 'general');

    }

    public function getResourcesAttribute()
    {
        return $this->SwitchNotification($this->notifiable_type, 'resources');
    }

    /**
     * @param $notifiable_type
     * @param string $response
     * @return string
     */
    public function SwitchNotification($notifiable_type, $response = 'type'): string
    {
        switch ($notifiable_type) {
            case 'Modules\Courses\Entities\Course':
                $type = [
                    'type' => 'course',
                    'general' => 0,
                    'resources' => 'Modules\Courses\Transformers\Api\CourseResource',
                ];
                break;
            case 'Modules\Courses\Entities\Chapter':
                $type = [
                    'type' => 'chapter',
                    'general' => 0,
                    'resources' => 'Modules\Courses\Transformers\Api\ChapterResource',
                ];
                break;
            case 'Modules\Courses\Entities\Lesson':
                $type = [
                    'type' => 'lesson',
                    'general' => 0,
                    'resources' => 'Modules\Courses\Transformers\Api\LessonResource',
                ];
                break;
            default :
                $type = [
                    'type' => 'general',
                    'general' => 1,
                    'resources' => 'Modules\Notifications\Transformers\Api\LessonResource',
                ];
        }
        return $type[$response];
    }
}