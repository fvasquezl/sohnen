<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Merge SKUS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('products.merge','#create') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="RetainedSKU">RetainedSKU</label>
                                <select name="RetainedSKU"
                                    class="select2 form-control @error('RetainedSKU') is-invalid @enderror"
                                    placeholder="Retained SKU" style="width:100%">
                                    <option value=""></option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->SKU }}" {{ old('RetainedSKU')}}>
                                        {{ $product->SKU }}</option>
                                    @endforeach
                                </select>

                                @error('RetainedSKU')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 bg-warning text-dark">
                            <div class="form-group ">
                                <label for="DeletedSKU" style="color:red">DeletedSKU</label>
                                <select name="DeletedSKU"
                                    class="select2 form-control @error('DeletedSKU') is-invalid @enderror"
                                    placeholder="Delete Sku" style="width:100%">
                                    <option value=""></option>
                                    
                                    @foreach ($products as $product)
                                    <option value="{{ $product->SKU }}" {{ old('DeletedSKU')}}>
                                        {{ $product->SKU }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('DeletedSKU')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" 
                    onclick="return confirm('¿Are you sure to merge these skus ?')">Merge Sku</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


{{-- @push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush --}}

@push('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}


<script>
    if(window.location.hash === '#create')
    {
        $('#myModal').modal('show');
    }

    $('#myModal').on('hide.bs.modal',function(){
        window.location.hash = '#'
    });

    $('#myModal').on('shown.bs.modal',function(){
        $('#post-title').focus()
        window.location.hash = '#create'
    });


    $('.select2').select2({
        tags:true,
       // theme: "classic",
       theme: "bootstrap4",
        width: 'resolve'
        
    });

</script>
@endpush