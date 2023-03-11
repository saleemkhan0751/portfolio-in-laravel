@isset($service)
    @if(!$service->trashed())
                <a title="Edit" href="{{ route('services.edit', [$service->id]) }}"><i class="icon-pencil4"></i></a>
        <input type="hidden" id="delete-route-path-delete-{{$service->id}}" name="delete-route-path" value="{{ route('service.delete',[$service->id])}}">
        <a title="Inactive" href="javascript:void(0)" id="delete-{{$service->id}}" class="delete-row" data-row-id="{{$service->id}}" data-url="{{ route('service.delete',[$service->id])}}"><i class="icon-trash-alt text-danger" ></i></a>
    @else
        <input type="hidden" id="restore-route-path" name="restore-route-path"
               value=" {{ route('service.restore',[$service->id])}}">
        <a title="Restore" href="javascript:void(0)" class="restore-row" data-row-id="{{$service->id}}" data-url_restore="{{ route('service.restore',[$service->id]) }}"><i
                class="icon-database-refresh text-success-800"></i></a>

        <input type="hidden" id="permanent-delete-route-path" name="permanently-delete-route-path"
               value="{{ route('service.permanent.delete',[$service->id])}}">
        <a title="Permanently Delete" href="javascript:void(0)" class="permanent-delete-row"
           data-row-id="{{$service->id}}" data-url_delete="{{ route('service.permanent.delete',[$service->id])}}"><i class="icon-trash text-danger-800" ></i></a>
    @endif
@endisset
