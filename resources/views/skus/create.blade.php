<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enter SKU</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('sku.store','#create') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="SKU" id="post-TitleShort"
                                    class="form-control @error('SKU') is-invalid @enderror" value="{{old('SKU')}}"
                                    placeholder="Enter SKU" autofocus required>
                                @error('SKU')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="LanguageID" class="form-control @error('LanguageID') is-invalid @enderror"
                                    placeholder="Select Language">
                                    @foreach ($languages as $language)
                                    <option value="{{ $language->LanguageID }}" {{ old('LanguageID')}}>
                                        {{ $language->Language }}</option>
                                    @endforeach
                                </select>
                                @error('LanguageID')
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
                    <button class="btn btn-primary">Create SKU</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


@push('scripts')
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
</script>
@endpush