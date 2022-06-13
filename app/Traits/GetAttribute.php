<?php

namespace App\Traits;

use App\Models\Attachment;

trait GetAttribute
{
    public $multiple_attachment = false;


    public function attachmentRelation()
    {
        $relation = $this->multiple_attachment ? 'morphMany' : 'morphOne';
        return $this->$relation(Attachment::class, 'attachmentable');
    }

    public function getAttachmentAttribute()
    {
        if($this->multiple_attachment)
        {
            if($this->attachmentRelation()->count())
            {
                $return = [];

                foreach ($this->attachmentRelation()->get() as $photo)
                {
                    array_push($return , asset($photo->path));
                }

            }else{
                $return = [asset('img/logo.png')];
            }

        }else{

            $return =  $this->attachmentRelation()->count() ?
                asset($this->attachmentRelation()->first()->path) : null;
        }

        return $return;
    }


    public function getFiles($usage = [])
    {
        $response = [];
        foreach ($this->getMedia('resources') as $resource):
            array_push($response , $resource->getUrl());
        endforeach;
        return $response;
    }
}