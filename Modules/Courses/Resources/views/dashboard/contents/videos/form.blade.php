@inject('chapters','Modules\Courses\Entities\Chapter')
<style>
    .progress {
        display: none;
    }
</style>

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
{!! field()->select('chapter_id',__('courses::dashboard.contents.cards.form.chapter'),pluckModelsCols($chapters->get() ,'id','title',false,true)) !!}



<div id="video-box" class="form-group">
    <label class="devo-label parag" for="video"> الفيديو </label>
    <span class="required">*</span>
    <input placeholder="اختر ملف" type="file" id="video" name="video" class="dropify"/>
</div>
<div class="progress mt-3" style="height: 25px">
    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
         aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
         style="width: 75%; height: 100%">75%
    </div>
</div>
{{--@if($model->video_url_dashboard != '')--}}
{{--    @push('styles')--}}
{{--        <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">--}}
{{--        <script src="https://unpkg.com/video.js/dist/video.js"></script>--}}
{{--        <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>--}}
{{--    @endpush--}}
{{--    <video id="my_video_1" class="video-js vjs-fluid vjs-default-skin" controls preload="auto" width="352" height="288"--}}
{{--           data-setup='{}'>--}}
{{--        <source src="{{$model->video_url_dashboard}}" type="application/x-mpegURL">--}}
{{--    </video>--}}
{{--    <br>--}}
{{--    @push('scripts')--}}
{{--        <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">--}}
{{--        <script src="https://unpkg.com/video.js/dist/video.js"></script>--}}
{{--        <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>--}}
{{--        <script>--}}
{{--            var player = videojs('my_video_1');--}}
{{--            player.play();--}}
{{--        </script>--}}
{{--    @endpush--}}
{{--@endif--}}
{!! field()->checkBox('status',__('courses::dashboard.contents.cards.form.status'),null,['checked' => $model->status]) !!}
@if ($model->trashed())
    {!!field()->checkBox('record_restore',__('courses::dashboard.contents.cards.form.restore')) !!}
@endif


@push('scripts')
    <!-- Resumable JS -->
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function () {

            $('#submit').prop('disabled', true);
            $('#submit').css('opacity', '0.3');
            $('#submit').text('في انتظار رفع الفيديو ...');


            $('form').submit(function () {
                $(this).find('button[type=submit]').prop('disabled', true);
                $(this).find('button[type=submit]').css('opacity', '0.3');
            });

            let browseFile = $('#video');
            let resumable = new Resumable({
                chunkSize: 10 * 1024 * 1024, // 10MB
                testChunks: false,
                throttleProgressCallbacks: 1,
                target: '{{ route('dashboard.chunk.upload') }}',
                query: {_token: '{{ csrf_token() }}'},// CSRF token
                fileType: ['mp4'],
                headers: {
                    'Accept': 'application/json'
                },
                withCredentials: true,
            });

            resumable.assignBrowse(browseFile[0]);

            resumable.on('fileAdded', function (file) { // trigger when file picked
                showProgress();
                resumable.upload() // to actually start uploading.
            });

            resumable.on('fileProgress', function (file) { // trigger when file progress update
                updateProgress(Math.floor(file.progress() * 100));
            });

            resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
                response = JSON.parse(response)
                $('#submit').prop('disabled', false)
                $('#submit').css('opacity', '1')
                $('#submit').text('اضافة')
            });

            resumable.on('fileError', function (file, response) { // trigger when there is any error
                if (resumable.files.length > 0) {
                    resumable.upload() // to actually start uploading.
                }
            });


            let progress = $('.progress');

            function showProgress() {
                progress.find('.progress-bar').css('width', '0%');
                progress.find('.progress-bar').html('0%');
                progress.find('.progress-bar').removeClass('bg-success');
                progress.show();
            }

            function updateProgress(value) {
                progress.find('.progress-bar').css('width', `${value}%`)
                progress.find('.progress-bar').html(`${value}%`)
            }

            function hideProgress() {
                progress.hide();
            }


        });
    </script>
@endpush
