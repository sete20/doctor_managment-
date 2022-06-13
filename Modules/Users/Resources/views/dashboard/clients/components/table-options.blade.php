<div class="btn-group">
    <a class="btn btn-success btn-sm" href="javascript:;" data-toggle="dropdown">
        <i class="fa fa-lg fa-cogs"></i>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu pull-right">

        <li>
            <a href="{{ url(route("dashboard.clients.notification.view").'?client='.$model->id) }}">
                <i class="fa fa-bell"></i> {{__('users::dashboard.clients.actions.send_notification')}}
            </a>
        </li>
        @can('show_clients')
            <li>
                <a href="{{ route("dashboard.clients.show", $model->id) }}">
                    <i class="fa fa-eye"></i> {{__('users::dashboard.clients.actions.show')}}
                </a>
            </li>
        @endcan
{{--        @can('edit_clients')--}}
            <li>
                <a href="{{ route("dashboard.clients.edit", $model->id) }}">
                    <i class="fa fa-pencil"></i> {{__('users::dashboard.clients.actions.update')}}
                </a>
            </li>
{{--        @endcan--}}
{{--        @can('delete_clients')--}}
            <li>
                <a href="javascript:;" onclick="deleteRow('{{ route("dashboard.clients.destroy", $model->id) }}')">
                    <i class="fa fa-trash-o"></i> {{__('users::dashboard.clients.actions.delete')}} </a>
            </li>
{{--        @endcan--}}
    </ul>
</div>