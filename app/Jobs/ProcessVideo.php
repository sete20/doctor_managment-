<?php

namespace App\Jobs;

use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProcessVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;

    /**
     * ProcessVideo constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $model = $this->model;
        $mediaItem = $model->getFirstMedia('videos');

        $lowBitrate = (new X264)->setKiloBitrate(144);
        $midBitrate = (new X264)->setKiloBitrate(480);
        $highBitrate = (new X264)->setKiloBitrate(1080);

        FFMpeg::fromDisk('local')
            ->open($mediaItem->id . '/' . $mediaItem->file_name)
            ->exportForHLS()
            ->setSegmentLength(10)// optional
            ->setKeyFrameInterval(48)// optional
            ->addFormat($lowBitrate)
            ->addFormat($midBitrate)
            ->addFormat($highBitrate)
            ->toDisk('media')
            ->save(($mediaItem->id . '/' . $mediaItem->file_name));

        FFMpeg::fromDisk('local')
            ->open($mediaItem->id . '/' . $mediaItem->file_name)
            ->getFrameFromSeconds(2)
            ->export()
            ->toDisk('media')
            ->save($mediaItem->id . '/' . 'thumb.png');

        File::deleteDirectory(Storage::disk('local')->getAdapter()->getPathPrefix().$mediaItem->id);
        File::delete(Storage::disk('media')->getAdapter()->getPathPrefix().$mediaItem->id.'/'.$mediaItem->file_name);

        $mediaItem = Media::find($mediaItem->id);
        $mediaItem->disk = 'media';
        $mediaItem->conversions_disk = 'media';
        $mediaItem->setCustomProperty('144', $mediaItem->name.'_0_144.m3u8');
        $mediaItem->setCustomProperty('480',  $mediaItem->name.'_1_480.m3u8');
        $mediaItem->setCustomProperty('1080',  $mediaItem->name.'_2_1080.m3u8');

        $model->video_status = 'ready';
        $model->save();
        $mediaItem->save();
    }
}
