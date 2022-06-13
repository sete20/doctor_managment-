

{!! field()->text('name', __('users::dashboard.clients.form.name')) !!}
{!! field()->email('email', __('users::dashboard.clients.form.email')) !!}
{!! field()->number('phone', __('users::dashboard.clients.form.phone')) !!}
{!! field()->password('password', __('users::dashboard.clients.form.password')) !!}
{!! field()->password('password_confirmation', __('users::dashboard.clients.form.password_confirmation')) !!}
{!! field()->number('points', 'النقاط') !!}
{!! \Helper\Field::checkBox('activation','حالة التفعيل',['checked' => ($model->activation != 'deactivate' ? true : false)]) !!}
{!! \Helper\Field::checkBox('remove_device','إعادة تهيئة الجهاز',['checked' =>  false]) !!}
