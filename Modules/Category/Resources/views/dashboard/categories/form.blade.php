{!! \Helper\Field::text('title',__('category::dashboard.categories.form.title'),null,['multi_lang' => true ,'model' => $model]) !!}
{!! \Helper\Field::textarea('description',__('category::dashboard.categories.form.description'),null,['multi_lang' => true ,'model' => $model]) !!}
{!! \Helper\Field::checkBox('status',__('category::dashboard.categories.form.status'),['checked' => $model->status]) !!}
@if ($model->trashed())
    {!! \Helper\Field::checkBox('restore',__('category::dashboard.categories.form.restore')) !!}
@endif

<input type="hidden" name="category_id" id="root_category" value="{{$model->category_id}}">

@push('scripts')

    <script type="text/javascript">
        $(function () {

            $('#jstree').jstree({
                core: {
                    multiple: false
                }
            });

            $('#jstree').on("changed.jstree", function (e, data) {
                $('#root_category').val(data.selected);
            });

        });
    </script>

@endpush
