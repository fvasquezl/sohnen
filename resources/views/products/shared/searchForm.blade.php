<form id="productCatalog-form" class="form-inline mb-3">
    <div class="form-group">
            <label class="sr-only" for="brand">Brand</label>
            <select class="form-control" name="brand" id="brand">
                <option value="">-- Brand --</option>
                @foreach($brands as $brand)
                <option value="{{$brand}}">{{$brand}}</option>
                @endforeach
            </select>
        </div>
    <button type="submit" class="btn btn-primary ml-2">Submit</button>
</form>