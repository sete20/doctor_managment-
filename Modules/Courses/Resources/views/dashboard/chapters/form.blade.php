@inject('chapters','Modules\Courses\Entities\Course')
{!!  Helper\FieldV2::langNavTabs() !!}

<div class="tab-content">
    @foreach (config('translatable.locales') as $code)
        <div id="first_{{$code}}" class="tab-pane fade @if($loop->first) in active @endif">
            {!! Helper\FieldV2::text('title',__('courses::dashboard.chapters.form.title'),optional(optional($model)->translate($code))->title,['multi_lang' => true , 'code' => $code]) !!}
         </div>
    @endforeach
</div>

{!! Helper\FieldV2::select('course_id',__('courses::dashboard.chapters.form.course'),pluckModelsCols($chapters->get() ,'id','title',false,true)) !!}
{!! Helper\FieldV2::number('order',__('courses::dashboard.chapters.form.order')) !!}
{!! Helper\FieldV2::checkBox('status',__('courses::dashboard.chapters.form.status'),['checked' => $model->status]) !!}

{!! field()->multiFileUpload('resources','المصادر') !!}

@if($model->getMedia('resources'))
    @foreach($model->getMedia('resources') as $media)

        <div class="cbp-item web-design graphic" id="attach-{{$media->id}}">
            <div class="cbp-caption">
                <div class="cbp-caption-defaultWrap">
                    <img src="{{str_contains($media->mime_type,'image')? $media->getUrl() : asset('uploads/file.png')}}" alt="" style="max-width: 300px">
                </div>
                <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                        <div class="cbp-l-caption-body">
                            <a
                                    target="_blank"
                                    href="{{$media->getUrl()}}"
                                    class="cbp-singlePage cbp-l-caption-buttonLeft btn green uppercase btn green uppercase"
                                    rel="nofollow">
                                <i class="fa fa-eye"></i>
                                عرض
                            </a>
                            <a
                                    href="javascript:;"
                                    onclick="deleteRow('{{url(route('dashboard.chapters.resources.delete',[$model->id,'resources',$media->id]))}}',{{$media->id}})"
                                    class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase"
                                    rel="`nofollow">
                                <i class="fa fa-trash"></i>
                                حذف
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cbp-l-grid-projects-desc uppercase text-center">{{$media->name}}</div>
        </div>
    @endforeach
@endif
@if ($model->trashed())
    {!! Helper\FieldV2::checkBox('restore',__('courses::dashboard.chapters.form.restore')) !!}
@endif
