<div class="modal fade" id="ajaxModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <form id="productForm" name="productForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
