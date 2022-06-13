<?php

namespace Modules\Courses\Repositories\Doctor;

use App\Jobs\ProcessVideo;
use FFMpeg\Format\Video\X264;
use Helper\NotificationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Courses\Entities\Lesson;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Support\Facades\File;

class VideoRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Lesson::class);
        $this->largeFile = [
            'video'
        ];
        $this->fileAttribute = [
            'video' => 'videos'
        ];
    }

    public function getModel()
    {
        return $this->model->Doctor();
    }

    public function prepareData(array $data, Request $request, $is_create = true): array
    {
        $data['order'] = $request->order ? $request->order : $this->model->count() + 1;
        $data['type'] = 'video';
        unset($data['title']);
        unset($data['description']);
        return parent::prepareData($data, $request, $is_create);
    }

    public function modelCreated($model, $request, $is_created = true): void
    {
        $this->translateTable($model, $request);
        $model->video_status = 'process';
        $model->save();
        ProcessVideo::dispatch($model)->onQueue('process_video');
        parent::modelCreated($model, $request, $is_created);
    }

    public function commitedAction($model, $request, $event_type = "create"): void
    {
        if($event_type == 'created'){
            if ($model->chapter->course->acceptedRequests()->count())
                NotificationHelper::sendNotification($model,
                    $model->chapter->course->acceptedRequests()->pluck('client_id')->toArray(), 'clients',
                    __('app::dashboard.notifications.new_lesson_title'),
                    __('app::dashboard.notifications.new_lesson_body_for_course') . optional(optional($model->chapter)->course)->translate(locale())->title);
        }

        parent::commitedAction($model, $request, $event_type);
    }

    public function modelUpdated($model, $request): void
    {
        $this->translateTable($model, $request);
        $model->video_status = 'process';
        $model->save();
        ProcessVideo::dispatch($model)->onQueue('process_video');

        parent::modelUpdated($model, $request);
    }

    public function translateTable($model, $request)
    {
        foreach ($request['title'] as $locale => $value) {

            $model->translateOrNew($locale)->title = $value;
            $model->translateOrNew($locale)->description = isset($request['description'][$locale]) ? $request['description'][$locale] : null;
        }

        $model->save();
    }

}
