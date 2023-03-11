@isset($team)
    @if(!$team->trashed())
                <a title="Edit" href="{{ route('teams.edit', [$team->id]) }}"><i class="icon-pencil4"></i></a>
        <input type="hidden" id="delete-route-path-delete-{{$team->id}}" name="delete-route-path" value="{{ route('team.delete',[$team->id])}}">
        <a title="Inactive" href="javascript:void(0)" id="delete-{{$team->id}}" class="delete-row" data-row-id="{{$team->id}}" data-url="{{ route('team.delete',[$team->id])}}"><i class="icon-trash-alt text-danger" ></i></a>
    @else
        <input type="hidden" id="restore-route-path" name="restore-route-path"
               value=" {{ route('team.restore',[$team->id])}}">
        <a title="Restore" href="javascript:void(0)" class="restore-row" data-row-id="{{$team->id}}" data-url_restore="{{ route('team.restore',[$team->id]) }}"><i
                class="icon-database-refresh text-success-800"></i></a>

        <input type="hidden" id="permanent-delete-route-path" name="permanently-delete-route-path"
               value="{{ route('team.permanent.delete',[$team->id])}}">
        <a title="Permanently Delete" href="javascript:void(0)" class="permanent-delete-row"
           data-row-id="{{$team->id}}" data-url_delete="{{ route('team.permanent.delete',[$team->id])}}"><i class="icon-trash text-danger-800" ></i></a>
    @endif
@endisset
