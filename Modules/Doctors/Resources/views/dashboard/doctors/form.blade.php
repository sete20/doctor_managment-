{!! Helper\FieldV2::text('name',__('doctors::dashboard.doctors.form.name')) !!}
{!! field()->email('email',__('doctors::dashboard.doctors.form.email')) !!}
{!! field()->password('password',__('doctors::dashboard.doctors.form.password')) !!}

{!! Helper\FieldV2::fileWithPreview('image',__('doctors::dashboard.doctors.form.image'),['url' => $model->image]) !!}
{!! Helper\FieldV2::checkBox('status',__('doctors::dashboard.doctors.form.status'),['checked' => $model->status]) !!}
@if ($model->trashed())
    {!! Helper\FieldV2::checkBox('restore',__('doctors::dashboard.doctors.form.restore')) !!}
@endif
