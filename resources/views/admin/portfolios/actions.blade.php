@isset($portfolio)
    @if(!$portfolio->trashed())
                <a title="Edit" href="{{ route('portfolios.edit', [$portfolio->id]) }}"><i class="icon-pencil4"></i></a>
        <input type="hidden" id="delete-route-path-delete-{{$portfolio->id}}" name="delete-route-path" value="{{ route('portfolio.delete',[$portfolio->id])}}">
        <a title="Inactive" href="javascript:void(0)" id="delete-{{$portfolio->id}}" class="delete-row" data-row-id="{{$portfolio->id}}" data-url="{{ route('portfolio.delete',[$portfolio->id])}}"><i class="icon-trash-alt text-danger" ></i></a>
    @else
        <input type="hidden" id="restore-route-path" name="restore-route-path"
               value=" {{ route('portfolio.restore',[$portfolio->id])}}">
        <a title="Restore" href="javascript:void(0)" class="restore-row" data-row-id="{{$portfolio->id}}" data-url_restore="{{ route('portfolio.restore',[$portfolio->id]) }}"><i
                class="icon-database-refresh text-success-800"></i></a>

        <input type="hidden" id="permanent-delete-route-path" name="permanently-delete-route-path"
               value="{{ route('portfolio.permanent.delete',[$portfolio->id])}}">
        <a title="Permanently Delete" href="javascript:void(0)" class="permanent-delete-row"
           data-row-id="{{$portfolio->id}}" data-url_delete="{{ route('portfolio.permanent.delete',[$portfolio->id])}}"><i class="icon-trash text-danger-800" ></i></a>
    @endif
@endisset
