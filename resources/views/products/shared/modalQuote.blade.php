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
                                   readonly="readonly"
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
                                   min="0"
                                   value="1">
                            <span class="invalid-feedback" role="alert"><strong></strong></span>
                        </div>
                    <input id="Brand" type="hidden" name="Brand">
                    <input id="Model" type="hidden" name="Model">
                    <input id="Description" type="hidden" name="Description">
                    <input id="Condition" type="hidden" name="Condition" value="B">
                    <input id="SalePrice" type="hidden" name="SalePrice">
                    <input id="PercentOfRetail" name="PercentOfRetail" type="hidden" value="{{Session::get('PercentOfRetail')}}">
                    <input id="CustomerName" type="hidden" name="CustomerName"  value="{{Session::get('CustomerName')}}">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Quote</button>
                </div>
            </form>
        </div>
    </div>
</div>
