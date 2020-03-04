@extends('layouts.master')

@section('content-header')

@include('layouts.partials.contentHeader',$info =[
'title' =>'Sku Mapping Amazon',
'subtitle' => 'Administration',
'breadCrumbs' =>['asm','index']
])
@stop

@section('content')
<div class="col-lg-12">

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title mt-1">
                SKU Mapping Amazon
            </h3>

            <div class="card-tools">
            </div>
        </div>

        <div class="card-body">

            <table class="table table-striped table-bordered table-hover nowrap" id="skusTable">
                <thead>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>ASIN</th>
                    <th>CountryCode</th>
                    <th>DateAdded</th>
                    <th>IsRenewed?</th>
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
                        columns: [1,2, 3, 4]
                    },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn selectTable btn-primary',
                        }
                    ],
                },

                ajax: {
                    url: '/asm'
                },
                columns: [
                    {data:"ID"},
                    {data:"SKU"},
                    {data:"ASIN"},
                    {data:"CountryCode"}, 
                    {data:"DateAdded"},
                    {data:"IsRenewed"},
                ],
                columnDefs: [
                    {
                    targets: 5,
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return `<input type="checkbox" class="is-renewed custom-checkbox" value="${data?'true':'false'}">`
                        }
                        return data
                    },
                    className: "text-center"
                    },{
                        targets: [0,1,2,3,4],
                        className: "text-center"
                    }
                ],
            rowCallback: function (row, data) {
                // Set the checked state of the checkbox in the table
                $('.is-renewed', row).prop('checked', data.IsRenewed == 1);
                //$('.dont-del', row).prop('checked', data.DontDel == 1);
            }
            });


            $(document).on('click', '.update-btn', function (e) {
                e.stopPropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('ID');
                $(location).attr('href', 'sku/'+rowId+'/edit');
            });


            // IsRenewed checkbox
            $(document).on('change','.is-renewed',function(){
                let $tr = $(this).closest('tr');
                let $td = $(this).parent();
                let value = this.value;
                let rowId = $tr.attr('id');
                let url = `asm/renewed/${rowId}`;

                $form = $(`<form><form>`);
                $form.append(`<input type="hidden" name="IsRenewed" value="${value}">`);
                let $return = myAjaxPost(url,'PUT',$form.serialize());

                if($return){
                    $td.find('checkbox',function(i, o) {
                        $(o).val(value);
                    });
                }else{
                    $skusTable.cell($td).invalidate().draw();
                }
                return true;
            });

  
        });
</script>
@endpush