@extends('layouts.master')

@section('content-header')

@include('layouts.partials.contentHeader',$info =[
'title' =>'Product Catalog',
'subtitle' => 'Administration',
'breadCrumbs' =>['products','index']
])
@stop


@section('content')

@if (session('success'))
<div class="alert alert-success mt-2" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ session('success') }}</strong>
</div>
@endif

@if (session('danger'))
<div class="alert alert-danger mt-2" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ session('danger') }}</strong>
</div>
@endif

<div class="col-lg-12">
    <div class="card card-outline card-info ">

        <div class="card-body">
            <div class="d-flex bd-highlight">
                <div class=" bd-highlight">
                    @include('products.shared.searchForm',[$brands,$categories])
                </div>

                <div class="ml-auto  bd-highlight">
                    <button class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        <i class="fas fa-tools"></i>
                        Merge SKUS
                    </button>
                </div>
            </div>
            <hr>
            <table class="table table-bordered table-hover nowrap" id="productsTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>To Cust</th>
                        <th>SKU</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Description</th>
                        <th>EstimatedRetail</th>
                        <th>TotalStock</th>
                        <th>AvgCost</th>
                        <th>QtyNew</th>
                        <th>SalePriceNew</th>
                        <th>QtyB</th>
                        <th>SalePriceB</th>
                        <th>QtyC</th>
                        <th>SalePriceC</th>
                        <th>QtyX</th>
                        <th>SalePriceX</th>
                        <th>QtyPending</th>
                        <th>QtyIncomplete</th>
                        <th>AddedDate</th>
                        <th>TQtyPurchased</th>
                        <th>FirstPurchaseDate</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('products.shared.modal',$categories)
@include('products.shared.qtyModal')
@include('products.shared.modalQuote')
@include('products.shared.modalMerge')
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap4.min.css" />
<style>
    td.details-control {
        background: url('img/details_open.png') no-repeat center center;
        cursor: pointer;
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
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js">
</script>

<script src="{{ asset('js/common.js') }}"></script>

<script>
    let $productsTable;

        let customerName = "{{Session::get('CustomerName')}}";
        let percentOfRetail = "{{Session::get('PercentOfRetail')}}";

        function format(d) {

            let tableUrl = '/products/qty/'+d;
            let t = myAjax(tableUrl,'GET');

            let imagesUrl = 'products/image/'+d;
            let i = myAjax(imagesUrl,'GET');
            let images = "";

            if(!i){
                images= "No Images"
            }else {
                $.map(i, function (value, index) {
                    images += `<span>
                                    <a href="`+value+`" target="_blank" class="ml-3">
                                        <img src="`+value+`" class="img-thumbnail align-top mt-4" alt="Smiley face" height="150" width="150">
                                    </a>
                               <span>`;
                });
            }

            let table = `<thead>
                            <tr>
                                <th colspan="2" class="table-primary text-center">New</th>
                                <th colspan="2" class="table-success text-center">GRADE B</th>
                                <th colspan="2" class="table-active text-center">GRADE C</th>
                                <th colspan="2" class="table-warning text-center">GRADE X</th>
                                <th colspan="2" class="table-secondary text-center">PENDING</th>
                                <th colspan="2" class="table-info text-center">INCOMPLETE</th>
                            </tr>
                            <tr>
                                <th class="table-primary text-center">Bin</th>
                                <th class="table-primary text-center">Qty</th>
                                <th class="table-success text-center">Bin</th>
                                <th class="table-success text-center">Qty</th>
                                <th class="table-active text-center">Bin</th>
                                <th class="table-active text-center">Qty</th>
                                <th class="table-warning text-center">Bin</th>
                                <th class="table-warning text-center">Qty</th>
                                <th class="table-secondary text-center">Bin</th>
                                <th class="table-secondary text-center">Qty</th>
                                <th class="table-info text-center">Bin</th>
                                <th class="table-info text-center">Qty</th>
                            </tr>
                           </thead>
                           <tbody>
                            `;
            $.map(t, function (value, index) {
                table += `<tr>
                                <td class="text-center">`+value.CONDITION_NEW_BIN+`</td>
                                <td class="text-center">`+value.CONDITION_NEW_QTY+`</td>
                                <td class="text-center">`+value.CONDITION_GRB_BIN+`</td>
                                <td class="text-center">`+value.CONDITION_GRB_QTY+`</td>
                                <td class="text-center">`+value.CONDITION_GRC_BIN+`</td>
                                <td class="text-center">`+value.CONDITION_GRC_QTY+`</td>
                                <td class="text-center">`+value.CONDITION_GRX_BIN+`</td>
                                <td class="text-center">`+value.CONDITION_GRX_QTY+`</td>
                                <td class="text-center">`+value.CONDITION_PEN_BIN+`</td>
                                <td class="text-center">`+value.CONDITION_PEN_QTY+`</td>
                                <td class="text-center">`+value.CONDITION_INC_BIN+`</td>
                                <td class="text-center">`+value.CONDITION_INC_QTY+`</td>
                           </tr>`;
            });

        var val = `
            <ul class="nav nav-tabs " id="myTab`+d+`" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="bin-tab-`+d+`" data-toggle="tab" href="#bin-`+d+`" role="tab" aria-controls="bin" aria-selected="true">Bins</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="image-tab-`+d+`" data-toggle="tab" href="#image-`+d+`" role="tab" aria-controls="image" aria-selected="false">Images</a>
            </li>
            </ul>
            <div class="tab-content" id="myTab`+d+`Content">
            <div class="tab-pane fade show active" id="bin-`+d+`" role="tabpanel" aria-labelledby="bin-tab">
                <table class="table table-sm">`+table+`</tbody></table>
            </div>
            <div class="tab-pane fade" id="image-`+d+`" role="tabpanel" aria-labelledby="image-tab">
                `+images+`
            </div>
            </div>`;
      return val;

        }


        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $productsTable = $('#productsTable').DataTable({
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
                        columns: [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
                    },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn selectTable btn-primary',
                        }
                    ],
                },

                ajax: {
                    url: '/products',
                    data: function (d) {
                        d.brand = $('select[name=brand]').val();
                        d.category = $('select[name=category]').val();
                        d.hasInventory = $('#hasInventory').val();
                    },
                },
                columns: [{},
                    {
                        data: "toCustomer"
                    },
                    {
                        data: "SKU"
                    },
                    {
                        data: "Brand"
                    },
                    {
                        data: "Model"
                    },
                    {
                        data: "Description"
                    },
                    {
                        data: "EstimatedRetail"
                    },
                    {
                        data: "TotalStock"
                    },
                    {
                        data: "AvgCost"
                    },
                    {
                        data: "QtyNew"
                    },
                    {
                        data: "SalePriceNew"
                    },
                    {
                        data: "QtyGradeB"
                    },
                    {
                        data: "SalePriceGradeB"
                    },
                    {
                        data: "QtyGradeC"
                    },
                    {
                        data: "SalePriceGradeC"
                    },
                    {
                        data: "QtyGradeX"
                    },
                    {
                        data: "SalePriceGradeX"
                    },
                    {
                        data: "QtyPending"
                    },
                    {
                        data: "QtyIncomplete"
                    },
                    {
                        data: "AddedDate"
                    },
                    {
                        data: "TotalQtyPurchased"
                    },
                    {
                        data: "FirstPurchaseDate"
                    },

                ],
                columnDefs: [{
                        searchable: false,
                        targets: 0,
                        className: 'details-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },{
                        name: 'toCustomer',
                        searchable: false,
                        targets: 1,
                        orderable: false,
                    },

                    {
                        targets: 5,
                        width: 300
                    },
                    {
                        targets: [6, 8, 10, 12, 14, 16],
                        className: "text-right",
                        render: $.fn.dataTable.render.number(',', '.', 2, '$ ')
                    },
                    {
                        targets: [7, 9, 11, 13, 15, 17, 18, 19, 20, 21],
                        className: "text-center"
                    }
                ]
            });

            $('#productsTable tbody').on('click', 'td.details-control', function () {
                let tr = $(this).closest('tr');
                let row = $productsTable.row(tr);
                // let url = '/products/qty/'+row.data().SKU;
                // let data = myAjax(url,'GET');
                let data = row.data().SKU;
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    row.child(format(data)).show();
                    tr.addClass('shown');
                }
            });


            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .fixedColumns().relayout();
            });

            $productsTable.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');


            $('#productCatalog-form').on('submit', function (e) {
                $productsTable.draw();
                e.preventDefault();
            });

            $('#create-btn').click(function () {
                $('#productForm')
                    .trigger("reset")
                    .attr("action", "/products/")
                    .attr('method', 'POST');
                $('#modelHeading').html("Create New Product");
                $('#ajaxModal').modal('show');
            });

            $(document).on('click', '.update-btn', function (e) {
                e.stopPropagation();
                let $tr = $(this).closest('tr');

                let rowId = $tr.attr('id');
                $('#ajaxModal').on('shown.bs.modal', function () {

                    let form = $('#productForm');
                    form.attr("action", "/products/" + rowId)
                        .attr('method', 'PUT');

                    $(form).trigger("reset");

                    let product = getRowData(rowId);
                   // console.log(product);
                    let category = getRowData(product.CategoryID, '', '/category');

                    $(this).find(".modal-title").html("Update Product " + product.SKU);

                    displayLabels(form, product, category);

                }).modal('show');
            });

            $(document).on('click', '.delete-btn', function (e) {
                e.stopPropagation();
                e.stopImmediatePropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('id');
                let url = `/products/` + rowId;
                deleteInfo(url);
            });

            $('#productForm').on('submit', function (e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                saveInfo(url, method, this, '#ajaxModal');
                $productsTable.draw();
            });

            $('#CategoryID').on('change', function () {

                let form = $(this).closest("form");

                let category = getRowData($(this).val(), '', '/category');

                form.find('label').text(function (index, value) {
                    if (category[this.id] === null) {
                        $('#' + $(this).attr('for')).val('').hide();
                    } else {
                        $('#' + $(this).attr('for')).show();
                    }
                    return category[this.id];
                });
            });

            $(document).on('click', '.quote-btn', function (e) {
                e.stopPropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('id');
                let product = getRowData(rowId);
                if (!percentOfRetail) {
                    Swal.fire('Failed!', "There are not customer session", "warning");
                }
                else {
                    $('#ajaxQuoteModal').on('shown.bs.modal', function () {
                        let product = getRowData(rowId);
                        let form = $('#productQuoteForm');
                        RemoveErrorsFields(form);
                        form.attr("action", "/quotations")
                            .attr('method', 'POST');
                        $(form).trigger("reset");
                        form.find("input[name='SKU']").val(product.SKU);
                        form.find("input[name='Brand']").val(product.Brand);
                        form.find("input[name='Model']").val(product.Model);
                        form.find("input[name='Description']").val(product.Description);
                        form.find("input[name='SalePrice']").val(product.EstimatedRetail);
                        $(this).find(".modal-title").html("Quote Product " + product.SKU);
                    }).modal('show');
                }
            });

            $('#productQuoteForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                saveInfo(url, method, this, '#ajaxQuoteModal');
            });

        });
</script>
@endpush
