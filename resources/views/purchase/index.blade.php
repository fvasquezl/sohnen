@extends('layouts.master')

@section('content')
    <div class="col-lg-12 my-3">
        <div class="card card-outline card-info">
            <div class="card-body">
                 @include('purchase.partials.formSearch',[$btsLoadIds,$loadDates])
                <table class="table table-striped table-bordered table-hover nowrap" id="purchasesTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>BTSSKU</th>
                        <th>Brand</th>
                        <th>ScreenSize</th>
                        <th>MFGSKU</th>
                        <th>ItemDescription</th>
                        <th>CategoryName</th>
                        <th>Qty</th>
                        <th>EstimatedRetail</th>
                        <th>Price</th>
                        <th>BTSLoadID</th>
                        <th>SohnenLoadID</th>
                        <th>LoadDate</th>
                        <th>AddedDate</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
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
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="{{ asset('js/common.js') }}"></script>

    <script>

        let $purchasesTable;

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#datePicker').datetimepicker({
                format: 'YYYY-MM-DD',
                autoclose: true,
                todayBtn: true,
            });

            $purchasesTable = $('#purchasesTable').DataTable({
                pageLength: 25,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                processing: true,
                stateSave: true,
                serverSide:true,
                scrollY: "56vh",
                scrollX:true,

                dom:"<'row'<'col-sm-12 col-md-6 d-flex justify-content-start'f><'col-sm-12 col-md-6 d-flex justify-content-end'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

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
                        },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn selectTable btn-primary',
                        }
                    ],
                },

                ajax: {
                    url: '{!! route('purchase.index') !!}',
                    data: function (d) {
                        d.loadDate=$('#loadDate').val();
                        d.btsLoadId = $('select[name=btsLoadId]').val();
                    }
                },
                columns: [
                    {data:"ID"},
                    {data:"BTSSKU"},
                    {data:"Brand"},
                    {data:"ScreenSize"},
                    {data:"MFGSKU"},
                    {data:"ItemDescription"},
                    {data:"CategoryName"},
                    {data:"Qty"},
                    {data:"EstimatedRetail"},
                    {data:"Price"},
                    {data:"BTSLoadID"},
                    {data:"SohnenLoadID"},
                    {data:"LoadDate"},
                    {data:"AddedDate"},
                ],
                columnDefs: [
                    {
                        targets: [8,9],
                        className: "text-right",
                        render: $.fn.dataTable.render.number( ',', '.', 2, '$ ' )
                    },
                    {
                        targets: [0,2,3,4,5,6,7,10,11,12,13],
                        className: "text-center"
                    },
                ]
            });

            $('#dateForm').on('submit',function(e){
                e.preventDefault();
                $purchasesTable.draw();
            });


        });

    </script>
@endpush
