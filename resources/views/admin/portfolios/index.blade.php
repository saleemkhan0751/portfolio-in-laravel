@extends("layouts.app")

@section("title", "Portfolio Management")

@section("content")
    @php
        if(!isset($portfolio)){
            $portfolio = null;
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">@isset($portfolio) Update Portfolio @else Create Portfolio @endisset</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="panel-body">
                    @if(!isset($portfolio))
                        {{ Form::open(['route' => ['portfolios.store'],'files' => true,'class' => 'form-horizontal']) }}
                    @else
                        {{ Form::model($portfolio, ['route' => ['portfolios.update', $portfolio->id], 'class' => 'form-horizontal']) }}
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="name">Name<span class="text-danger">*</span></label>
                            {!! Form::text('type', old('type'), ['id'=> 'type','class' => 'form-control', 'required', 'placeholder' => 'type']) !!}
                            {!! $errors->first('type', '<label id="code-error" class="validation-error-label" for="type">:message</label>') !!}
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Image:</label>
                                <input name="image" type="file" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 text-right mt-28">
                            <button type="submit" class="btn bg-slate-700">@isset($portfolio) Update @else Create @endisset</button>
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
                    <h5 class="panel-title text-semibold">List Portfolio </h5>
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
                        <th>Type</th>
                        <th>Image</th>
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
                ajax: "{{ route('portfolios.index') }}",
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'type', name: 'type'},
                    {data: 'picture', name: 'picture'},
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
                                columns: [1, 2, 3, 4, 5,6,7,8]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                            className: 'btn bg-blue btn-icon',
                            columns: [1, 2, 3, 4]
                        }
                    ]
                }
            });
        });
    </script>
@endpush

