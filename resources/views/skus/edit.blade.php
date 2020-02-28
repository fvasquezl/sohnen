@extends('layouts.master')

@section('content')

@if(Session::has('success'))
<div class="alert alert-success alert-block mt-2">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<form method="POST" action="{{ route('sku.update', $sku) }}" class="mt-4">
    @csrf
    @method('PUT')
    <div class="row ">
        <div class="col-md-6">
            <div class="card shadow-sm card-outline card-success">

                <div class="card-body">

                    <div class="form-group">
                        <label for="SKU">SKU:</label>
                        <input name="SKU" value="{{old('SKU',$sku->SKU) }}"
                            class="form-control @error('SKU') is-invalid @enderror" disabled>
                        @error('SKU')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="LanguageID">LanguageID:</label>
                        <input name="LanguageID" value="{{old('LanguageID',$sku->language->Language) }}"
                            class="form-control @error('LanguageID') is-invalid @enderror" disabled>
                        @error('LanguageID')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    {{-- <div class="form-group">
                        <label>Language:</label>
                        <select name="LanguageID"
                            class="select2 form-control @error('LanguageID') is-invalid @enderror"
                            data-placeholder="Select Language" style="width: 100%;">
                            @foreach ($languages as $language)
                            <option value="{{ $language->LanguageID }}"
                                {{ old('LanguageID',$sku->LanguageID)===$language->LanguageID ? 'selected':''}}>
                                {{ $language->Language }}</option>
                            @endforeach
                        </select>
                        @error('LanguageID')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> --}}

            

                    <div class="form-group">
                        <label for="Title80">Title80:</label>
                        <input name="Title80" value="{{ old('Title80', $sku->Title80) }}"
                            class="form-control  @error('Title80') is-invalid @enderror">
                        @error('Title80')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Title200">Title200:</label>
                        <textarea name="Title200" rows="5" 
                            class="editor form-control @error('Title200') is-invalid @enderror"
                            placeholder="Type Title 200">{{ old('Title200',$sku->Title200) }}</textarea>
                        @error('Title200')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ShortDescription">ShortDescription:</label>
                        <input name="ShortDescription" value="{{ old('ShortDescription', $sku->ShortDescription) }}"
                            class="form-control  @error('ShortDescription') is-invalid @enderror">
                        @error('ShortDescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="Description" rows="5"
                            class="editor form-control @error('Description') is-invalid @enderror"
                            placeholder="Type description">{{ old('Description',$sku->Description) }}</textarea>
                        @error('Description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card mb-4 shadow-sm card-outline card-success">

                <div class="card-body">
                    <div class="form-group">
                        <label for="Bullet1">Bullet1</label>
                        <input name="Bullet1" value="{{ old('Bullet1', $sku->Bullet1) }}"
                            class="form-control  @error('Bullet1') is-invalid @enderror">
                        @error('Bullet1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Bullet2">Bullet2</label>
                        <input name="Bullet2" value="{{ old('Bullet2', $sku->Bullet2) }}"
                            class="form-control  @error('Bullet2') is-invalid @enderror">
                        @error('Bullet2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Bullet3">Bullet3</label>
                        <input name="Bullet3" value="{{ old('Bullet3', $sku->Bullet3) }}"
                            class="form-control  @error('Bullet3') is-invalid @enderror">
                        @error('Bullet3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Bullet4">Bullet4</label>
                        <input name="Bullet4" value="{{ old('Bullet4', $sku->Bullet4) }}"
                            class="form-control  @error('Bullet4') is-invalid @enderror">
                        @error('Bullet4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Bullet5">Bullet5</label>
                        <input name="Bullet5" value="{{ old('Bullet5', $sku->Bullet5) }}"
                            class="form-control  @error('Bullet5') is-invalid @enderror">
                        @error('Bullet5')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>SearchTerms:</label>
                        <textarea name="SearchTerms" rows="7"
                            class="editor form-control @error('SearchTerms') is-invalid @enderror"
                            placeholder="Type SearchTerms">{{ old('SearchTerms',$sku->SearchTerms) }}</textarea>
                        @error('SearchTerms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Store SKU</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

{{-- <script>
    $(function () {

            $('.select2').select2({
                tags:true,
                theme: "classic",
                width: 'resolve'
            });

        });

</script> --}}

@endpush