@extends('layouts.master')

@section('content')
    <div class="card mt-4">
        <div class="card-header">Product Catalog</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @include('products.shared.searchForm',[$brands,$categories])

            <table class="table table-striped table-bordered table-hover nowrap"  id="productsTable">
                <thead>
                <tr>
                    <th></th>
                    <th>Action</th>
                    <th>To Cust</th>
                    <th>SKU</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Description</th>
                    <th>EstimatedRetail</th>
                    <th>AvgCost</th>
                    <th>QtyNew</th>
                    <th>SalePriceNew</th>
                    <th>QtyB</th>
                    <th>SalePriceB</th>
                    <th>QtyC</th>
                    <th>SalePriceC</th>
                    <th>QtyX</th>
                    <th>SalePriceX</th>
                    <th>AddedDate</th>
                    <th>TotalStock</th>
                    <th>TQtyPurchased</th>
                    <th>FirstPurchaseDate</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
        @include('products.shared.modal',$categories)
        @include('products.shared.modalQuote')
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap4.min.css"/>
    <style>
        td.details-control {
            background: url('img/details_open.png') no-repeat center center;
            cursor:pointer;
        }

        tr.shown td.details-control {
            background: url('img/details_close.png') no-repeat center center;
        }
    </style>
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

    <script src="{{ asset('js/common.js') }}"></script>

    <script>

        let $productsTable;

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
            $productsTable = $('#productsTable').DataTable({
                pageLength: 25,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                processing: true,
                stateSave: true,
                serverSide:true,
                scrollY: "53vh",
                scrollX: true,
                select:true,
                // fixedColumns:   {
                //     leftColumns: 4
                // },
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
                            columns: [2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                        },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn selectTable btn-primary',
                        }
                    ],
                },

                ajax: {
                    url: '{!! route('products.index') !!}',
                    data: function (d) {
                        d.brand = $('select[name=brand]').val();
                        d.category = $('select[name=category]').val();
                        d.hasInventory = $('#hasInventory').val();
                    },
                },
                columns: [
                    {},
                    {data: 'Action'},
                    {data:"toCustomer"},
                    {data: "SKU"},
                    {data: "Brand"},
                    {data: "Model"},
                    {data: "Description"},
                    {data: "EstimatedRetail"},
                    {data: "AvgCost"},
                    {data: "QtyNew"},
                    {data: "SalePriceNew"},
                    {data: "QtyGradeB"},
                    {data: "SalePriceGradeB"},
                    {data: "QtyGradeC"},
                    {data: "SalePriceGradeC"},
                    {data: "QtyGradeX"},
                    {data: "SalePriceGradeX"},
                    {data: "AddedDate"},
                    {data: "TotalStock"},
                    {data: "TotalQtyPurchased"},
                    {data: "FirstPurchaseDate"},

                ],
                columnDefs: [
                    {
                        searchable:false,
                        targets: 0,
                        className:'details-control',
                        orderable:false,
                        data:null,
                        defaultContent: ''
                    },
                    {
                        name: 'Action',
                        searchable:false,
                        targets: 1,
                        orderable:false,
                    },
                    {
                        name: 'toCustomer',
                        searchable:false,
                        targets: 2,
                        orderable:false,
                    },

                    {targets: 6,width: 300},
                    {
                        targets: [7, 8, 10, 12, 14, 16],
                        className: "text-right",
                        render: $.fn.dataTable.render.number( ',', '.', 2, '$ ' )
                    },
                    {
                        targets: [9, 11, 13, 15, 17, 18, 19, 20],
                        className: "text-center"
                    }
                ]
            });

            $('#productsTable tbody').on('click', 'td.details-control', function () {
                let tr = $(this).closest('tr');
                let row = $productsTable.row( tr );
                let attributes = getRowData(row.data().SKU,'','/getAttribute');
                let data = getRowData(attributes[0].ID,'','/attributes');


                if ( row.child.isShown() ) {
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    row.child( format(data) ).show();
                    tr.addClass('shown');
                }
            } );


            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .fixedColumns().relayout();
            });

            $productsTable.buttons().container()
                .appendTo( '#example_wrapper .col-md-6:eq(0)' );


            $('#productCatalog-form').on('submit',function(e){
                $productsTable.draw();
                e.preventDefault();
            });

            $('#create-btn').click(function () {
                $('#productForm')
                    .trigger("reset")
                    .attr("action","/products/")
                    .attr('method','POST');
                $('#modelHeading').html("Create New Product");
                $('#ajaxModal').modal('show');
            });

            $(document).on('click','.update-btn',function(e){
                e.stopPropagation();
                let $tr = $(this).closest('tr');

                let rowId = $tr.attr('id');
                $('#ajaxModal').on('shown.bs.modal', function(){

                    let form = $('#productForm');
                        form.attr("action","/products/"+rowId)
                        .attr('method','PUT');

                    $(form).trigger("reset");

                    let product = getRowData(rowId);
                    let category = getRowData(product.CategoryID,'','/category');

                    $(this).find(".modal-title").html("Update Product "+product.SKU);

                    displayLabels(form,product,category);

                }).modal('show');
            });

            $(document).on('click','.delete-btn',function(e){
                e.stopPropagation();
                e.stopImmediatePropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('id');
                let url= `/products/`+ rowId;
                deleteInfo(url);
            });

            $('#productForm').on('submit',function(e){
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                saveInfo(url,method,this,'#ajaxModal');
                $productsTable.draw();
            });

            $('#CategoryID').on('change',function () {

                let form=$(this).closest("form");

                let category = getRowData($(this).val(),'','/category');

                form.find('label').text(function(index, value){
                    if(category[this.id] === null){
                        $('#'+$(this).attr('for')).val('').hide();
                    }else{
                        $('#'+$(this).attr('for')).show();
                    }
                    return category[this.id];
                });
            });

            $(document).on('click','.quote-btn',function(e){
                e.stopPropagation();

                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('id');

                if(!percentOfRetail){
                    Swal.fire('Failed!', "There are not customer session", "warning");
                }else{
                    $('#ajaxQuoteModal').on('shown.bs.modal', function(){
                        let product = getRowData(rowId);
                        let form = $('#productQuoteForm');

                        form.attr("action","/quotations")
                            .attr('method','POST');
                        $(form).trigger("reset");

                        form.find("input[name='SKU']").val(product.SKU);
                        form.find("input[name='Qty']").val('1');
                        form.find('#Condition').on('change',function(){
                            if($(this).val() === 'New'){
                                form.find("input[name='SalePrice']").val( product.SalePriceNew);
                            }else if($(this).val() === 'B'){
                                form.find("input[name='SalePrice']").val(product.SalePriceGradeB);
                            }else if($(this).val() === 'C'){
                                form.find("input[name='SalePrice']").val(product.SalePriceGradeC);
                            }else if($(this).val() === 'X'){
                                form.find("input[name='SalePrice']").val(product.SalePriceGradeX);
                            }
                        });

                        form.find("input[name='PercentOfRetail']").val(percentOfRetail);

                        $(this).find(".modal-title").html("Quote Product "+product.SKU);

                    }).modal('show');
                }
            });

            $('#productQuoteForm').on('submit',function(e){
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                saveInfo(url,method,this,'#ajaxQuoteModal');
            });

        });


    </script>
@endpush
