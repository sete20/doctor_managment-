@inject('chapters','Modules\Courses\Entities\Chapter')
{!!  field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('courses::dashboard.contents.cards.form.title').'-'.$code ,
             optional($model->translate($code))->title,
                  ['data-name' => 'title.'.$code]
             ) !!}
            {!! field()->textarea('description['.$code.']',
            __('courses::dashboard.contents.cards.form.description').'-'.$code ,
             optional($model->translate($code))->description,
                  ['data-name' => 'description.'.$code]
             ) !!}
        </div>
    @endforeach
</div>
{!! field()->select('chapter_id',__('courses::dashboard.contents.cards.form.chapter'),pluckModelsCols($chapters->Doctor()->get() ,'id','title',false,true)) !!}
{!! field()->file('video', 'الفيديو') !!}
@if($model->video_url_dashboard != '')
    @push('styles')
        <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
        <script src="https://unpkg.com/video.js/dist/video.js"></script>
        <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>
    @endpush
    <video id="my_video_1" class="video-js vjs-fluid vjs-default-skin" controls preload="auto" width="352" height="288"
           data-setup='{}'>
        <source src="{{$model->video_url_dashboard}}" type="application/x-mpegURL">
    </video>
    <br>
    @push('scripts')
        <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
        <script src="https://unpkg.com/video.js/dist/video.js"></script>
        <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>
        <script>
            var player = videojs('my_video_1');
            player.play();
        </script>
    @endpush
@endif
{!! field()->checkBox('status',__('courses::dashboard.contents.cards.form.status'),null,['checked' => $model->status]) !!}
@if ($model->trashed())
    {!!field()->checkBox('record_restore',__('courses::dashboard.contents.cards.form.restore')) !!}
@endif
