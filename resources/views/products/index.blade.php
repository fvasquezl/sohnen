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

            @include('products.shared.searchForm',$brands)

            <table class="table table-striped table-bordered table-hover nowrap DataTable" role="grid" id="productsTable">
                <thead>
                <tr>
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
                    <th width="100px">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
        @include('products.shared.modal',$categories)
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
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>

    <script src="{{ asset('js/common.js') }}"></script>

    <script>

        let $productsTable;


        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $productsTable = $('#productsTable').DataTable({
                pageLength: 25,
                processing: true,
                serverSide:true,
                scrollY: "53vh",
                scrollX: true,
                select:true,
                fixedColumns:   {
                    leftColumns: 4
                },
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
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17]
                        },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn selectTable btn-primary',
                            init: function(api, node, config) {
                                $(node).removeClass('btn-secondary buttons-html5')
                            }
                        }
                    ],
                },

                ajax: {
                    url: '{!! route('products.index') !!}',
                    data: function (d) {
                        d.brand = $('select[name=brand]').val();
                    },
                },
                columns: [
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
                    {data: 'Action', name: 'Action', orderable: false, searchable: false},
                ],
                columnDefs: [
                    {targets: 3,width: 300},
                    {targets: 2, width: 100},
                    {
                        targets: [4, 5, 7, 9, 11, 13],
                        className: "text-right",
                        render: $.fn.dataTable.render.number( ',', '.', 2, '$ ' )
                    },
                    {
                        targets: [6, 8, 10, 12, 14, 15, 16, 17],
                        className: "text-center"
                    }

                ]
            });

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
                saveInfo(url,method,this);
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
            })
        });

    </script>
@endpush