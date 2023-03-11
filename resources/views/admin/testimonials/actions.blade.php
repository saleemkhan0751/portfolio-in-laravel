@isset($testimonial)
    @if(!$testimonial->trashed())
                <a title="Edit" href="{{ route('testimonials.edit', [$testimonial->id]) }}"><i class="icon-pencil4"></i></a>
        <input type="hidden" id="delete-route-path-delete-{{$testimonial->id}}" name="delete-route-path" value="{{ route('testimonial.delete',[$testimonial->id])}}">
        <a title="Inactive" href="javascript:void(0)" id="delete-{{$testimonial->id}}" class="delete-row" data-row-id="{{$testimonial->id}}" data-url="{{ route('testimonial.delete',[$testimonial->id])}}"><i class="icon-trash-alt text-danger" ></i></a>
    @else
        <input type="hidden" id="restore-route-path" name="restore-route-path"
               value=" {{ route('testimonial.restore',[$testimonial->id])}}">
        <a title="Restore" href="javascript:void(0)" class="restore-row" data-row-id="{{$testimonial->id}}" data-url_restore="{{ route('testimonial.restore',[$testimonial->id]) }}"><i
                class="icon-database-refresh text-success-800"></i></a>

        <input type="hidden" id="permanent-delete-route-path" name="permanently-delete-route-path"
               value="{{ route('testimonial.permanent.delete',[$testimonial->id])}}">
        <a title="Permanently Delete" href="javascript:void(0)" class="permanent-delete-row"
           data-row-id="{{$testimonial->id}}" data-url_delete="{{ route('testimonial.permanent.delete',[$testimonial->id])}}"><i class="icon-trash text-danger-800" ></i></a>
    @endif
@endisset
