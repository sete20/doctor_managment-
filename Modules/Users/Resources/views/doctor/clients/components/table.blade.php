
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
                    url: "{{ url(route('doctor.clients.datatable')) }}",
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
                responsive: true,
                order: [[1, "desc"]],
                columns: [
                    {data: 'id', className: 'dt-center'},
                    {data: 'name', className: 'dt-center'},
                    {data: 'email', className: 'dt-center'},
                    {data: 'phone', className: 'dt-center'},
                    {data: 'created_at', visible:true,className: 'dt-center'},
                    {data: "points",responsivePriority: 1,className: 'dt-center',

                        render: function (data, type, full, meta) {

                            if (data > 0 ) {
                                return `<span class="badge badge-primary">`+data+`</span>`;
                            } else {
                                return `<span class="badge badge-danger">`+data+`</span>`;
                            }
                        },
                    },
                    {data: "status",responsivePriority: 1,className: 'dt-center',

                        render: function (data, type, full, meta) {

                            if (data == 'active') {
                                return `<span class="badge badge-success"> {{__('app::dashboard.datatable.active')}} </span>`;
                            }else if (data == 'pending') {
                                return `<span class="badge badge-primary"> {{__('app::dashboard.datatable.pending')}} </span>`;
                            } else {
                                return `<span class="badge badge-danger"> {{__('app::dashboard.datatable.unactive')}} </span>`;
                            }
                        },
                    },
                ],
                "fnDrawCallback": function() {
                    //Initialize checkbos for enable/disable user
                    $("[name='switch']").bootstrapSwitch({size: "small", onColor:"success", offColor:"danger"});
                },
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
                ],
            });

    }

    jQuery(document).ready(function () {
        tableGenerate();
    });
</script>