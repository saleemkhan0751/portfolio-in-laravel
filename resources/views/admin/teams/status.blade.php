@isset($team)
    @if($team->trashed())
        <label class="label label-danger label-roundless">Inactive</label>
    @else
        <label class="label label-success label-roundless">Active</label>
    @endif
@endisset

