<div class="modal fade" id="ajaxModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <form id="productForm" name="productForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="QtyNew">QtyNew</label>
                                <input type="number"
                                       class="form-control"
                                       id="QtyNew"
                                       name="QtyNew"
                                       placeholder="QtyNew"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="QtyPending">QtyPending</label>
                                <input type="number"
                                       class="form-control"
                                       id="QtyPending"
                                       name="QtyPending"
                                       placeholder="QtyPending"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mt-2">
                                <label for="QtyGradeB">QtyB</label>
                                <input type="number"
                                       class="form-control"
                                       id="QtyGradeB"
                                       name="QtyGradeB"
                                       placeholder="QtyGradeB"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-2">
                                <label for="QtyGradeC">QtyC</label>
                                <input type="number"
                                       class="form-control"
                                       id="QtyGradeC"
                                       name="QtyGradeC"
                                       placeholder="QtyGradeC"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-2">
                                <label for="QtyGradeX">QtyX</label>
                                <input type="number"
                                       class="form-control"
                                       id="QtyGradeX"
                                       name="QtyGradeX"
                                       placeholder="QtyGradeX"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="h4 text-center">Attributes</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="sr-only" for="brand">Categories</label>
                                <select class="form-control" name="CategoryID" id="CategoryID">
                                    <option value="">-- Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category['CategoryID']}}">{{$category['CategoryName']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute01" id="Attribute01Name">texyt</label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute01"
                                       name="Attribute01"
                                       placeholder="Attribute01"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute02" id="Attribute02Name"></label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute02"
                                       name="Attribute02"
                                       placeholder="Attribute02"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute03" id="Attribute03Name"></label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute03"
                                       name="Attribute03"
                                       placeholder="Attribute03"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute04" id="Attribute04Name"></label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute04"
                                       name="Attribute04"
                                       placeholder="Attribute04"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute05" id="Attribute05Name"></label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute05"
                                       name="Attribute05"
                                       placeholder="Attribute05"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute06" id="Attribute06Name"></label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute06"
                                       name="Attribute06"
                                       placeholder="Attribute06"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute07" id="Attribute07Name"></label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute07"
                                       name="Attribute07"
                                       placeholder="Attribute07"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute08" id="Attribute08Name"></label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute08"
                                       name="Attribute08"
                                       placeholder="Attribute08"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute09" id="Attribute09Name"></label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute09"
                                       name="Attribute09"
                                       placeholder="Attribute09"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <label for="Attribute10" id="Attribute10Name"></label>
                                <input type="text"
                                       class="form-control"
                                       id="Attribute10"
                                       name="Attribute10"
                                       placeholder="Attribute10"
                                       min="0">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
