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

            <table class="table table-hover" id="productsTable">
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
                    <th>TotalQtyPurchased</th>
                    <th>FirstPurchaseDate</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
        @include('products.shared.modal')
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css"/>
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
                scrollY: "50vh",
                scrollX: true,
                dom: '"<\'row\'<\'col-md-6\'B><\'col-md-6 d-flex justify-content-end\'f>>" +\n' +
                    '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
                    '"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"',
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
                            extend:'copyHtml5',
                            text:'<i class="fa fa-clipboard"></i>Copiar',
                            title:'Titulo de tabla copiada',
                            titleAttr: 'Copiar',
                            className: 'btn btn-app export',
                            exportOptions: {
                                columns: [ 0, 1 ]
                            }
                        },

                        {
                            extend:'pdfHtml5',
                            text:'<i class="fa fa-file-pdf-o"></i>PDF',
                            title:'Titulo de tabla en pdf',
                            titleAttr: 'PDF',
                            className: 'btn btn-app export pdf',
                            exportOptions: {
                                columns: [ 0, 1 ]
                            },
                            customize:function(doc) {
                                doc.styles.title = {
                                    color: '#4c8aa0',
                                    fontSize: '30',
                                    alignment: 'center'
                                },
                                doc.styles['td:nth-child(2)'] = {
                                    width: '100px',
                                    'max-width': '100px'
                                },
                                doc.styles.tableHeader = {
                                    fillColor:'#4c8aa0',
                                    color:'white',
                                    alignment:'center'
                                }, doc.content[1].margin = [ 100, 0, 100, 0 ]
                            }

                        },
                        {
                            extend:'excelHtml5',
                            text:'<i class="fa fa-file-excel-o"></i>Excel',
                            title:'Titulo de tabla en excel',
                            titleAttr: 'Excel',
                            className: 'btn btn-app export excel',
                            exportOptions: {
                                columns: [ 0, 1 ]
                            },
                        },
                        {
                            extend:'csvHtml5',
                            text:'<i class="fa fa-file-text-o"></i>CSV',
                            title:'Titulo de tabla en CSV',
                            titleAttr: 'CSV',
                            className: 'btn btn-app export csv',
                            exportOptions: {
                                columns: [ 0, 1 ]
                            }
                        },
                        {
                            extend:'print',
                            text:'<i class="fa fa-print"></i>Imprimir',
                            title:'Titulo de tabla en impresion',
                            titleAttr:'Imprimir',
                            className:'btn btn-app export imprimir',
                            exportOptions: {
                                columns: [ 0, 1 ]
                            }
                        },
                        {
                            extend:'pageLength',
                            titleAttr:'Registros a mostrar',
                            className:'selectTable'
                        }
                    ]
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
                    {data: "TotalQtyPurchased"},
                    {data: "FirstPurchaseDate"},
                    {data: 'Action', name: 'Action', orderable: false, searchable: false},
                ],
                columnDefs: [
                    {targets: 3,width: 300},
                    {targets: 2, width: 100},
                    {
                        targets: [4, 5, 7, 8, 9, 11, 13],
                        className: "text-right",
                        render: $.fn.dataTable.render.number( ',', '.', 2, '$ ' )
                    },
                    {
                        targets: [6, 8, 10, 12, 14, 15, 16],
                        className: "text-center"
                    }

                ]
            });


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
                $('#productForm')
                    .attr("action","/products/"+rowId)
                    .attr('method','PUT');
                $('#modelHeading').html("Update Product "+ rowId);
                $('#ajaxModal').modal('show');
            });

            $(document).on('click','.delete-btn',function(e){
                e.stopPropagation();
                e.stopImmediatePropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('id');

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
                            url: `/products/`+ rowId,
                            type: 'delete',
                            dataType: 'json',
                        });
                        request.done(function(data) {
                            Swal.fire(
                                'Deleted!',
                                data.message,
                                'success'
                            );
                        });
                        request.fail(function (jqXHR, textStatus, errorThrown) {
                            Swal.fire('Failed!', "There was something wrong", "warning");
                        });
                    }
                })
            });

            $('#productForm').on('submit',function(e){
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                let request = $.ajax({
                    url: url,
                    type: method,
                    dataType: 'json',
                    data: $(this).serialize(),
                });
                request.done(function(data) {
                    $('#ajaxModal').modal('toggle');
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
                request.fail(function (jqXHR, textStatus, errorThrown) {
                    Swal.fire('Failed!', "There was something wrong"+ textStatus, "warning");
                });
            });
        });




    </script>
@endpush
