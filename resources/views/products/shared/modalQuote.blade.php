<div class="modal fade" id="ajaxQuoteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelQuoteHeading"></h4>
            </div>
            <form id="productQuoteForm" name="productQuoteForm">
                <div class="modal-body">

                        <div class="form-group">
                            <label for="SKU">SKU</label>
                            <input type="text"
                                   class="form-control"
                                   id="SKU"
                                   name="SKU"
                                   placeholder="SKU">
                            <span class="invalid-feedback" role="alert"><strong></strong></span>
                        </div>
                        <div class="form-group">
                            <label for="Qty">Qty</label>
                            <input type="number"
                                   class="form-control"
                                   id="Qty"
                                   name="Qty"
                                   placeholder="Qty"
                                   min="0">
                            <span class="invalid-feedback" role="alert"><strong></strong></span>
                        </div>
                        <div class="form-group">
                            <label for="Condition">Condition</label>
                            <select name="Condition" id="Condition" class="form-control">
                                <option value="">Select Condition</option>
                                <option value="New">New</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="X">X</option>
                            </select>
                            <span class="invalid-feedback" role="alert"><strong></strong></span>
                        </div>
                        <div class="form-group">
                            <label for="PercentOfRetail">Percent Of Retail</label>
                            <input type="number"
                                   class="form-control"
                                   id="PercentOfRetail"
                                   name="PercentOfRetail"
                                   placeholder="PercentOfRetail"
                                   min="0">
                            <span class="invalid-feedback" role="alert"><strong></strong></span>
                        </div>
                        <div class="form-group">
                            <label for="SalePrice">SalePrice</label>
                            <input type="number"
                                   class="form-control"
                                   id="SalePrice"
                                   name="SalePrice"
                                   placeholder="SalePrice"
                                   min="0">
                            <span class="invalid-feedback" role="alert"><strong></strong></span>
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
