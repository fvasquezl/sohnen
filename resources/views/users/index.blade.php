@extends('layouts.master')

@section('content')
    <div class="col-lg-12 my-3">
        <div class="card card-outline card-info">
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover" id="users-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th width="100px">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop

{{-- page level styles --}}
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
@endpush

{{-- page level scripts --}}
@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
    <script src="{{ asset('js/common.js') }}"></script>

    <script>

        let $usersTable;

        $(function () {
            $usersTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, 'All']],
                scrollY: "45vh",

                dom: '"<\'row\'<\'col-md-6\'B><\'col-md-6\'f>>" +\n' +
                    '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
                    '"<\'row\'<\'col-sm-12 col-md-5\'i ><\'col-sm-12 col-md-7\'p>>"',

                buttons: {
                    dom: {
                        container: {
                            tag: 'div',
                            className: 'flexcontent'
                        },
                        buttonLiner: {
                            tag: null
                        }
                    },

                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i> Excel',
                            title: 'Products to Excel',
                            titleAttr: 'Excel',
                            className: 'btn btn-success',
                            init: function(api, node, config) {
                                $(node).removeClass('btn-secondary buttons-html5 buttons-excel')
                            },
                            columns: [0,1,2,3]
                        },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn selectTable btn-primary',
                        },
                        // {
                        //     text: '<i class="fas fa-user-plus"></i> Create User',
                        //     title: 'Create User',
                        //     className: 'btn btn-primary',
                        //     init: function(api, node, config) {
                        //         $(node).removeClass('btn-secondary buttons-html5')
                        //     },
                        //     attr: {
                        //         id: 'create_user_btn'
                        //     }
                        // },
                    ],
                },

                ajax: {
                    url: '{!! route('users.index') !!}',
                },

                columns: [
                    {"data": "id", name: 'id'},
                    {"data": "name", name: 'name'},
                    {"data": "email", name: 'email'},
                    {"data": "created_at", name: 'created_at'},
                    {data: 'Action', name: 'Action', orderable: false, searchable: false},
                ]

            });

        });

    </script>
@endpush
