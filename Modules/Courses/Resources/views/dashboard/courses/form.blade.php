@inject('doctors','Modules\Doctors\Entities\Doctor')
@inject('categories','Modules\Category\Entities\Category')
{!!  Helper\FieldV2::langNavTabs() !!}

<div class="tab-content">
    @foreach (config('translatable.locales') as $code)
        <div id="first_{{$code}}" class="tab-pane fade @if($loop->first) in active @endif">
            {!! Helper\FieldV2::text('title',__('courses::dashboard.courses.form.title'),optional(optional($model)->translate($code))->title,['multi_lang' => true , 'code' => $code]) !!}
            {!! Helper\FieldV2::textarea('description',__('courses::dashboard.courses.form.description'),optional(optional($model)->translate($code))->description,['multi_lang' => true ,'code' => $code]) !!}
            {!! Helper\FieldV2::textarea('note',__('courses::dashboard.courses.form.note'),optional(optional($model)->translate($code))->description,['multi_lang' => true ,'code' => $code]) !!}
        </div>
    @endforeach
</div>

{{--{!! field()->number('offer_price',__('courses::dashboard.courses.form.offer_price')) !!}--}}
{!! field()->select('category_id',__('courses::dashboard.courses.form.category'),pluckModelsCols($categories->get() ,'id','title',false,true)) !!}
{!! field()->select('doctor_id',__('courses::dashboard.courses.form.doctor'),$doctors->pluck('name','id')->toArray()) !!}
{!! field()->file('image',__('category::dashboard.categories.form.image'), $model->getFirstMediaUrl('images')) !!}
{!! field()->file('intro_video','فيديو الانترو', $model->getFirstMediaUrl('intro_video')) !!}
{!! Helper\FieldV2::checkBox('status',__('courses::dashboard.courses.form.status'),['checked' => $model->status]) !!}
{{--{!! Helper\FieldV2::checkBox('is_offered',__('courses::dashboard.courses.form.is_offered'),['checked' => $model->is_offered]) !!}--}}
@if ($model->trashed())
    {!! Helper\FieldV2::checkBox('restore',__('courses::dashboard.courses.form.restore')) !!}
@endif
