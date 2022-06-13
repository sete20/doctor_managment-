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

{!! field()->checkBox('status',__('courses::dashboard.contents.cards.form.status'),null,['checked' => $model->status]) !!}
@if ($model->trashed())
    {!!field()->checkBox('record_restore',__('courses::dashboard.contents.cards.form.restore')) !!}
@endif
