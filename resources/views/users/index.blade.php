@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="card panel-primary filterable">
                    <div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">

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
        </div>
    </section>
@stop

{{-- page level styles --}}
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <style>
        div.dt-buttons {
            float: none;
            text-align: center;
        }
        .table tbody tr:hover td, .table tbody tr:hover th {
            background-color: lightgoldenrodyellow;
        }
    </style>
@endpush

{{-- page level scripts --}}
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>


        $(function () {
            var $usersTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, 'All']],
                scrollY: "45vh",
                dom: "lBfrtip",
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

            //
            // $('input[type=radio][name=deletedStatus]').change(function(){
            //     btnfilterUsers = $(this).val();
            //     $usersTable.draw();
            // });
            //
            // $(document).on('click', '.user-delete', function (e) {
            //     e.preventDefault();
            //     if (!confirm('Are you sure to delete this user?')) {
            //         return false;
            //     }
            //     const row = $(this).parents('tr');
            //     const form = $(this).parents('form');
            //     const url = form.attr('action');
            //
            //     $.post(url, form.serialize(), function (result) {
            //         row.fadeOut();
            //         $.notify({
            //             title: "<strong>" + result[0].toUpperCase() + ":</strong> ",
            //             message: result[1]
            //         }, {
            //             type: result[0]
            //         });
            //     }).fail(function () {
            //         $.notify({
            //             title: "<strong>" + result[0].toUpperCase() + ":</strong> ",
            //             message: result[1]
            //         }, {
            //             type: result[0]
            //         });
            //     })
            //
            // });
        });

    </script>
@endpush