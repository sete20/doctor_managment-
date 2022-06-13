<?php

namespace Modules\Log\Entities;

use Spatie\Activitylog\Models\Activity as SpatieActivity;

class Activity extends SpatieActivity
{
    protected $appends = ['action_description'];

    public function getActionDescriptionAttribute()
    {
        $subject = explode('\\', $this->subject_type);
        $subject = $subject[count($subject) - 1];
        $causer = $this->causer;
        $action = $this->description;

        return
            __('log::dashboard.logs.activities.helper_words.head_title') .
            ( $causer ? $causer->name :   __('log::dashboard.logs.activities.helper_words.unknown_user') ).
            __('log::dashboard.logs.activities.actions.' . $action) .
            __('log::dashboard.logs.activities.helper_words.the').
            $subject.
            __('log::dashboard.logs.activities.helper_words.with_id').
            $this->subject_id
            ;
    }

    public function getModelNameAttribute()
    {
        $subject = explode('\\', $this->subject_type);
        return $subject[count($subject) - 1];
    }
}
