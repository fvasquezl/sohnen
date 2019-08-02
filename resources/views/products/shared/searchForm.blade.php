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
    <div class="form-check ml-3">
        <div class="icheck-primary">
            <input type="checkbox" class="custom-checkbox" name="hasInventory" id="hasInventory" value="false">
            <label for="hasInventory">
                Has Inventory
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary ml-2">Submit</button>
</form>