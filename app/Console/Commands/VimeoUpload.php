<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Courses\Entities\Lesson;
use Vimeo\Vimeo;

class VimeoUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vimeo:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage video upload from local storage to vimeo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        \Log::info("Vimeo Cron Started");

        $client_id = env('VIMEO_CLIENT_ID');
        $client_secret = env('VIMEO_CLIENT_SECRET');
        $access_token = env('VIMEO_ACCESS_TOKEN');

        $client = new Vimeo($client_id, $client_secret, $access_token);

        $videos = Lesson::where('status', 'new_video')->where('created_at', '<', now()->subHours(5))->get();

         if ($videos) {
             foreach ($videos as $video) {
                 if(file_exists($video->source)) {
                     unlink(public_path($video->source));
                     $video->delete();
                 }
             }
         }

        $videos = Lesson::where(function($query) {
            $query->where('type', 'video')
                ->where('video_status', 'in_progress')
                ->orWhere('video_status', 'processing');
        })->where('video_status', '!=', 'new_video')->get();
        foreach ($videos as $video) {
            if ($video->video_status === 'complete') {

                $video->update([
                    'video_status' => 'complete'
                ]);
            }
            if ($video->video_status === 'in_progress') {

                $response_status = $client->request($video->vimeo_url . '?fields=transcode.status');

                $status = $response_status['body']['transcode']['status'] ?? 0;


                if ($status === 'complete') {
                    $video->update([
                        'video_status' => 'complete',
                    ]);
                    unlink(public_path($video->source));

                } elseif ($status === 'in_progress') {
                    $video->update([
                        'video_status' => 'in_progress',
                    ]);
                } else {
                    $video->update([
                        'video_status' => null,
                        'vimeo_url' => null
                    ]);
                }
            } else {
                $file_name = $video->source;
                $splitter = explode("/", $file_name);
                $video_name = end($splitter);

                $path = base_path("storage/app/public/videos/" . $video_name);

                $uri = $client->upload($path, array(
                    "name" => $video->name,
                    "description" => "Video Created by " . $video->creator?->name
                ));

                $response_link = $client->request($uri . '?fields=link');
                $vimeo_id = substr(strrchr($response_link['body']['link'], '/'), 1);
                $link = $response_link['body']['link'];

                $video->update([
                    'vimeo_url' => $uri,
                    'vimeo_id' => $vimeo_id,
                    'video_status' => 'in_progress',
                ]);

                $response_status = $client->request($uri . '?fields=transcode.status');
                $status = $response_status['body']['transcode']['status'];

                if ($status === 'complete') {
                    $video->update([
                        'video_status' => 'complete',
                    ]);
                } elseif ($status === 'in_progress') {
                    $video->update([
                        'video_status' => 'in_progress',
                    ]);
                } else {
                    $video->update([
                        'video_status' => null,
                        'vimeo_url' => null
                    ]);
                }
            }
        }
        // \Log::info("Vimeo Cron Ended");
    }
}
