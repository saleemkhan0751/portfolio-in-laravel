@extends("layouts.app")

@section("title", "Team Management")

@section("content")
    @php
        if(!isset($team)){
            $team = null;
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">@isset($team) Update Team @else Create Team @endisset</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="panel-body">
                    @if(!isset($team))
                        {{ Form::open(['route' => ['teams.store'],'files' => true,'class' => 'form-horizontal']) }}
                    @else
                        {{ Form::model($team, ['route' => ['teams.update', $team->id], 'class' => 'form-horizontal']) }}
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="name">Name<span class="text-danger">*</span></label>
                            {!! Form::text('name', old('name'), ['id'=> 'name','class' => 'form-control', 'required', 'placeholder' => 'name']) !!}
                            {!! $errors->first('name', '<label id="code-error" class="validation-error-label" for="name">:message</label>') !!}
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="name">Role<span class="text-danger">*</span></label>
                            {!! Form::text('role', old('role'), ['id'=> 'role','class' => 'form-control', 'required', 'placeholder' => 'role']) !!}
                            {!! $errors->first('role', '<label id="code-error" class="validation-error-label" for="role">:message</label>') !!}
                        </div>
                    </div>
                        <div class="row mt-5">
                            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="name">Instagram Url<span class="text-danger">*</span></label>
                                {!! Form::text('Instagram_url', old('Instagram_url'), ['id'=> 'Instagram_url','class' => 'form-control', 'required', 'placeholder' => 'Instagram_url']) !!}
                                {!! $errors->first('Instagram_url', '<label id="code-error" class="validation-error-label" for="Instagram_url">:message</label>') !!}
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="name">Facebook Url<span class="text-danger">*</span></label>
                                {!! Form::text('facebook_url', old('facebook_url'), ['id'=> 'facebook_url','class' => 'form-control', 'required', 'placeholder' => 'facebook url']) !!}
                                {!! $errors->first('facebook_url', '<label id="code-error" class="validation-error-label" for="facebook_url">:message</label>') !!}
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="name">Twitter Url<span class="text-danger">*</span></label>
                                {!! Form::text('twitter_url', old('twitter_url'), ['id'=> 'role','class' => 'form-control', 'required', 'placeholder' => 'Twitter Url']) !!}
                                {!! $errors->first('twitter_url', '<label id="code-error" class="validation-error-label" for="twitter_url">:message</label>') !!}
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="name">Linkedin Url<span class="text-danger">*</span></label>
                                {!! Form::text('linkedin_url', old('linkedin_url'), ['id'=> 'linkedin_url','class' => 'form-control', 'required', 'placeholder' => 'Linkedin Url']) !!}
                                {!! $errors->first('linkedin_url', '<label id="code-error" class="validation-error-label" for="linkedin_url">:message</label>') !!}
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Picture:</label>
                                    <input name="image" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                    <div class="row ">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 text-right mt-28">
                            <button type="submit" class="btn bg-slate-700">@isset($team) Update @else Create @endisset</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">List Team </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <table class="table" id="usersDataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>role</th>
                        <th>Facebook Url</th>
                        <th>Twitter Url</th>
                        <th>Linkedin Url</th>
                        <th>Instagram Url</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push("before-app-script")
    <!-- Theme JS files -->
    <script src="{{ asset('admin/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script
        src="{{ asset('admin/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js') }}"></script>
    <script
        src="{{ asset('admin/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js') }}"></script>
    <script
        src="{{ asset('admin/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
@endpush

@push("after-app-script")
    {{--    <script src="{{ asset('admin/global_assets/js/demo_pages/datatables_extension_buttons_html5.js') }}"></script>--}}
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            $.extend($.fn.dataTable.defaults, {
                autoWidth: false,
                dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    searchPlaceholder: 'Type to filter...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: {
                        'first': 'First',
                        'last': 'Last',
                        'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                        'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                    }
                }
            });
            $('#usersDataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('teams.index') }}",
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'picture', name: 'picture'},
                    {data: 'role', name: 'role'},
                    {data: 'facebook_url', name: 'facebook_url'},
                    {data: 'twitter_url', name: 'twitter_url'},
                    {data: 'linkedin_url', name: 'linkedin_url'},
                    {data: 'Instagram_url', name: 'Instagram_url'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                buttons: {
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5,6,7,8,9,10,11]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5,6,7,8,9,10,11]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5,6,7,8,9,10,11]
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                            className: 'btn bg-blue btn-icon',
                            columns: [1, 2, 3, 4, 5,6,7,8,9,10,11]
                        }
                    ]
                }
            });
        });
    </script>
@endpush

