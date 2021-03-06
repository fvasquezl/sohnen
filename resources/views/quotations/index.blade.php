@extends('layouts.master')


@section('content-header')
@include('layouts.partials.contentHeader',$info =[
'title' =>'Quotations',
'subtitle' => 'Administration',
'breadCrumbs' =>['quotations','index']
])
@stop

@section('content')
    <div class="col-lg-12">
        <div class="card card-outline card-info">

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- @include('products.shared.searchForm',[$brands,$categories])--}}

                <table class="table table-striped table-bordered table-hover nowrap" id="quotationsTable">
                    <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Condition</th>
                        <th>PercentOfRetail</th>
                        <th>SalePrice</th>
                        <th>UserID</th>
                        <th>DateAdded</th>
                        <th>CustomerName</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
{{--    @include('products.shared.modal',$categories)--}}
{{--   @include('products.shared.modalQuote')--}}
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap4.min.css"/>
@endpush

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

    <script src="{{ asset('js/common.js') }}"></script>

    <script>

        let $quotationsTable;

        let customerName = "{{Session::get('CustomerName')}}";
        let percentOfRetail = "{{Session::get('PercentOfRetail')}}";

        function format(d){

            let result = '';
            $.map(d,function(value,index) {
                result += `<tr><td><strong>`+index+'</strong></td><td>'+value+`</td></tr>`;
            });

            return `<table id="map">`+result+`</table>`;
        }


        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $quotationsTable = $('#quotationsTable').DataTable({
                pageLength: 25,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                processing: true,
                stateSave: true,
                serverSide:true,
                scrollY: "53vh",
                dom: '"<\'row\'<\'col-md-6\'B><\'col-md-6\'f>>" +\n' +
                    '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
                    '"<\'row\'<\'col-md-12 col-md-5\'i ><\'col-md-12 col-md-7\'p>>"',

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
                            columns: [1,2,3,4,5,6,7,8]
                        },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn selectTable btn-primary',
                        }
                    ],
                },

                ajax: {
                    url: '{!! route('quotations.index') !!}',
                },
                columns: [
                    {data:"SKU"},
                    {data:"Brand"},
                    {data:"Model"},
                    {data:"Description"},
                    {data:"Qty"},
                    {data:"Condition"},
                    {data:"PercentOfRetail"},
                    {data:"SalePrice"},
                    {data:"UserID"},
                    {data:"DateAdded"},
                    {data:"CustomerName"},
                    {data:"Action"},
                ],
                columnDefs: [
                    {
                        targets: [7],
                        className: "text-right",
                        render: $.fn.dataTable.render.number( ',', '.', 2, '$ ' )
                    },
                    {
                        targets: [1,2,4,5,6],
                        className: "text-center"
                    },
                    {
                        name: 'Action',
                        searchable:false,
                        targets: [11],
                        orderable:false,
                       // visible: false,
                    },

                ]
            });

            $(document).on('click','.delete-btn',function(e) {
                e.stopPropagation();
                e.stopImmediatePropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('id');
                let url = `/quotations/` + rowId;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        let request = $.ajax({
                            url: url,
                            type: 'delete',
                            dataType: 'json',
                        });
                        request.done(function (data) {
                            Swal.fire(
                                'Deleted!',
                                data.message,
                                'success'
                            );
                            $quotationsTable.draw();
                        });
                        request.fail(function (jqXHR, textStatus, errorThrown) {
                            Swal.fire('Failed!', "There was something wrong", "warning");
                        });
                    }
                });
            });

        });

    </script>
@endpush
