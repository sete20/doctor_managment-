@extends('app::dashboard.layouts.doctor-app')
@section('title', __('courses::dashboard.contents.routes.index'))
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('doctor.home')) }}">{{ __('app::dashboard.index.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('courses::dashboard.contents.routes.index')}}</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">

                        {{--                    @permission('add_academies')--}}
                        <div class="table-toolbar">
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="actions">
                                        <div class="btn-group">
                                            <a class="btn btn-sm green dropdown-toggle" href="javascript:;"
                                               data-toggle="dropdown">
                                                <i class="fa fa-plus"></i> {{__('app::dashboard.buttons.add_new')}}
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{ url(route('doctor.cards.create')) }}">
                                                        {{__('courses::dashboard.contents.btn.add_card')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url(route('doctor.quiz.create')) }}">
                                                        {{__('courses::dashboard.contents.btn.add_quiz')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url(route('doctor.videos.create')) }}">
                                                        {{__('courses::dashboard.contents.btn.add_video')}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                    @endpermission--}}


                        {{-- DATATABLE FILTER --}}
                        <div class="row">
                            <div class="portlet box grey-cascade">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        {{__('app::dashboard.datatable.search')}}
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="filter_data_table">
                                        <div class="panel-body">
                                            <form id="formFilter" class="horizontal-form">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('app::dashboard.datatable.form.date_range')}}
                                                                </label>
                                                                <div id="reportrange" class="btn default form-control">
                                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                                    <span> </span>
                                                                    <b class="fa fa-angle-down"></b>
                                                                    <input type="hidden" name="from">
                                                                    <input type="hidden" name="to">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('app::dashboard.datatable.form.soft_deleted')}}
                                                                </label>
                                                                <div class="mt-radio-list">
                                                                    <label class="mt-radio">
                                                                        {{__('app::dashboard.datatable.form.delete_only')}}
                                                                        <input type="radio" value="only"
                                                                               name="deleted"/>
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio">
                                                                        {{__('app::dashboard.datatable.form.with_deleted')}}
                                                                        <input type="radio" value="with"
                                                                               name="deleted"/>
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('app::dashboard.datatable.form.status')}}
                                                                </label>
                                                                <div class="mt-radio-list">
                                                                    <label class="mt-radio">
                                                                        {{__('app::dashboard.datatable.form.active')}}
                                                                        <input type="radio" value="1" name="status"/>
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio">
                                                                        {{__('app::dashboard.datatable.form.unactive')}}
                                                                        <input type="radio" value="0" name="status"/>
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            @inject('chapters','Modules\Courses\Entities\Chapter')
                                                            {!! \Helper\Field::select('chapter_id',__('courses::dashboard.contents.form.chapter'),pluckModelsCols(
                                                            $chapters->Doctor()->get(),'id','title',false,true)) !!}
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                            <div class="form-actions">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                        id="search">
                                                    <i class="fa fa-search"></i>
                                                    {{__('app::dashboard.datatable.search')}}
                                                </button>
                                                <button class="btn btn-sm red btn-outline filter-cancel">
                                                    <i class="fa fa-times"></i>
                                                    {{__('app::dashboard.datatable.reset')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END DATATABLE FILTER --}}


                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">
                                {{__('courses::dashboard.contents.routes.index')}}
                            </span>
                            </div>
                        </div>

                        {{-- DATATABLE CONTENT --}}
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTable">
                                <thead>
                                <tr>
                                    <th>
                                        <a href="javascript:;" onclick="CheckAll()">
                                            {{__('app::dashboard.buttons.select_all')}}
                                        </a>
                                    </th>
                                    <th>#</th>
                                    <th>{{__('courses::dashboard.contents.datatable.title')}}</th>
                                    <th>{{__('courses::dashboard.contents.datatable.type')}}</th>
                                    <th>{{__('courses::dashboard.contents.datatable.course')}}</th>
                                    <th>{{__('courses::dashboard.contents.datatable.chapter_id')}}</th>
                                    <th>{{__('courses::dashboard.contents.datatable.status')}}</th>
                                    <th>{{__('courses::dashboard.contents.datatable.created_at')}}</th>
                                    <th>{{__('courses::dashboard.contents.datatable.options')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button type="submit" id="deleteChecked" class="btn red btn-sm"
                                        onclick="deleteAllChecked('{{ url(route('doctor.contents.deletes')) }}')">
                                    {{__('app::dashboard.datatable.delete_all_btn')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

    <script>
        function tableGenerate(data = '') {

            var dataTable =
                $('#dataTable').DataTable({
                    "createdRow": function (row, data, dataIndex) {
                        if (data["deleted_at"] != null) {
                            $(row).addClass('danger');
                        }
                    },
                    ajax: {
                        url: "{{ url(route('doctor.contents.datatable')) }}",
                        type: "GET",
                        data: {
                            req: data,
                        },
                    },
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
                    },
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    responsive: !0,
                    order: [[1, "desc"]],
                    columns: [
                        {data: 'id', className: 'dt-center'},
                        {data: 'id', className: 'dt-center'},
                        {data: 'title', className: 'dt-center'},
                        {data: 'type', className: 'dt-center'},
                        {data: 'course', className: 'dt-center'},
                        {data: 'chapter_id', className: 'dt-center'},
                        {data: 'status', className: 'dt-center'},
                        {data: 'created_at', className: 'dt-center'},
                        {data: 'id', responsivePriority: 1},
                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            width: '30px',
                            className: 'dt-center',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                          <input type="checkbox" value="` + data + `" class="group-checkable" name="ids">
                          <span></span>
                        </label>
                      `;
                            },
                        },
                        {
                            targets: 6,
                            width: '30px',
                            className: 'dt-center',
                            render: function (data, type, full, meta) {

                                if (full.type == 'video' && full.video_status == 'process') {

                                    return `<span class="badge badge-warning"> في مرحلة المعالجة </span>`;
                                }

                                if (data == 1) {
                                    return `<span class="badge badge-success"> {{__('app::dashboard.datatable.active')}} </span>`;
                                } else {
                                    return `<span class="badge badge-danger"> {{__('app::dashboard.datatable.unactive')}} </span>`;
                                }
                            },
                        },
                        {
                            targets: -1,
                            width: '13%',
                            title: '{{__('courses::dashboard.contents.datatable.options')}}',
                            className: 'dt-center',
                            orderable: false,
                            render: function (data, type, full, meta) {

                                var editUrl = '';
                                var showUrl = '';

                                switch (full.type) {
                                    case 'video':
                                        // Edit
                                        editUrl = '{{ route("doctor.videos.edit", ":id") }}';
                                        editUrl = editUrl.replace(':id', data);
                                        // Show
                                        showUrl = '{{ route("doctor.videos.show", ":id") }}';
                                        showUrl = showUrl.replace(':id', data);
                                        break;
                                    case 'card':
                                        // Edit
                                        editUrl = '{{ route("doctor.cards.edit", ":id") }}';
                                        editUrl = editUrl.replace(':id', data);
                                        break;
                                    case 'quiz':
                                        // Edit
                                        editUrl = '{{ route("doctor.quiz.edit", ":id") }}';
                                        editUrl = editUrl.replace(':id', data);
                                        // Show
                                        showUrl = '{{ route("doctor.quiz.show", ":id") }}';
                                        showUrl = showUrl.replace(':id', data);

                                        break;
                                }

                                // Delete
                                var deleteUrl = '{{ route("doctor.contents.destroy", ":id") }}';
                                deleteUrl = deleteUrl.replace(':id', data);

                                if (showUrl != '') {
                                    return `
                                    <a href="` + showUrl + `" class="btn btn-sm green" title="Show" style="    padding: 4px 7px;">
                                      <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="` + editUrl + `" class="btn btn-sm blue" title="Edit" style="    padding: 4px 7px;">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" onclick="deleteRow('` + deleteUrl + `')" class="btn btn-sm red" style="    padding: 4px 7px;">
                                      <i class="fa fa-trash"></i>
                                    </a>`
                                        ;
                                } else {
                                    return `
                                    <a href="` + editUrl + `" class="btn btn-sm blue" title="Edit" style="    padding: 4px 7px;">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" onclick="deleteRow('` + deleteUrl + `')" class="btn btn-sm red" style="    padding: 4px 7px;">
                                      <i class="fa fa-trash"></i>
                                    </a>`
                                        ;
                                }

                            },
                        },
                    ],
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [10, 25, 50, 100, 500],
                        ['10', '25', '50', '100', '500']
                    ],
                    buttons: [
                        {
                            extend: "pageLength",
                            className: "btn blue btn-outline",
                            text: "{{__('app::dashboard.datatable.pageLength')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible',
                                columns: [1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        },
                        {
                            extend: "print",
                            className: "btn blue btn-outline",
                            text: "{{__('app::dashboard.datatable.print')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible',
                                columns: [1, 3, 4, 5, 6, 7, 8, 9]
                            }
                        },
                        {
                            extend: "pdf",
                            className: "btn blue btn-outline",
                            text: "{{__('app::dashboard.datatable.pdf')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible',
                                columns: [1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        },
                        {
                            extend: "excel",
                            className: "btn blue btn-outline ",
                            text: "{{__('app::dashboard.datatable.excel')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible',
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
                            }
                        },
                        {
                            extend: "colvis",
                            className: "btn blue btn-outline",
                            text: "{{__('app::dashboard.datatable.colvis')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible',
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
                            }
                        }
                    ]
                });
        }

        jQuery(document).ready(function () {
            tableGenerate();
        });
    </script>

@stop
