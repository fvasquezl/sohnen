@extends('layouts.master')

@section('content')
<div class="col-lg-12 my-3">
    <div class="card card-outline card-info">

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <hr>

            <table class="table table-striped table-bordered table-hover nowrap" id="skusTable">
                <thead>
                    <th>ID</th>
                    <th>LanguageID</th>
                    <th>SKU</th>
                    <th>Title80</th>
                    <th>Title200</th>
                    <th>Bullet1</th>
                    <th>Bullet2</th>
                    <th>Bullet3</th>
                    <th>Bullet4</th>
                    <th>Bullet5</th>
                    <th>ShortDescription</th>
                    <th>Description</th>
                    <th>SearchTerms</th>
                    <th width="100px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap4.min.css" />
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
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js">
</script>

<script src="{{ asset('js/common.js') }}"></script>

<script>
    let $skusTable;

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $skusTable = $('#skusTable').DataTable({
                pageLength: 25,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All']
                ],
                processing: true,
                stateSave: true,
                serverSide: true,
                scrollY: "53vh",
                scrollX: true,
                select: true,
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

                    buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        title: 'Products to Excel',
                        titleAttr: 'Excel',
                        className: 'btn btn-success',
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary buttons-html5 buttons-excel')
                        },
                        columns: [1,2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                    },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn selectTable btn-primary',
                        }
                    ],
                },

                ajax: {
                    url: '/sku'
                },
                columns: [
                    {data:"ID"},
                    {data:"LanguageID"},
                    {data:"SKU"},
                    {data:"Title80"},
                    {data:"Title200"},
                    {data:"Bullet1"},
                    {data:"Bullet2"},
                    {data:"Bullet3"},
                    {data:"Bullet4"},
                    {data:"Bullet5"},
                    {data:"ShortDescription"},
                    {data:"Description"},
                    {data:"SearchTerms"},
                    {data: 'Action', name: 'Action', orderable: false, searchable: false},
                ],
                columnDefs: [
                    {
                        targets: 3,
                        width: 300
                    },
                    {
                        targets: 4,
                        width: 300
                    },
                    {
                        targets: [7,8,9, 10,11,12, 13],
                        className: "text-center"
                    }
                ]
            });

  
        });
</script>
@endpush