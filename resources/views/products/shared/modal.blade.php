<div class="modal fade" id="ajaxModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <form id="productForm" name="productForm">
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Cost</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                               aria-controls="contact" aria-selected="false">Others</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="form-group mt-2">
                                <label for="SKU">SKU</label>
                                <input type="text" class="form-control" id="SKU" placeholder="SKU">
                            </div>
                            <div class="form-group">
                                <label for="Brand">Brand</label>
                                <input type="text" class="form-control" id="Brand" placeholder="Brand">
                            </div>
                            <div class="form-group">
                                <label for="Model">Model</label>
                                <input type="text" class="form-control" id="Model" placeholder="Model">
                            </div>
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea type="text" class="form-control" id="Description"
                                          placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="EstimatedRetail">Estimated Retail</label>
                                        <input type="number" class="form-control" id="EstimatedRetail"
                                               placeholder="Estimated retail">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="AvgCost">Avg Cost</label>
                                        <input type="number" class="form-control" id="AvgCost" placeholder="Avg Cost">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="SalePriceNew">SalePriceNew</label>
                                        <input type="number" class="form-control" id="SalePriceNew"
                                               placeholder="SalePriceNew">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="QtyNew">QtyNew</label>
                                        <input type="number" class="form-control" id="QtyNew" placeholder="QtyNew">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="SalePriceB">SalePriceB</label>
                                        <input type="number" class="form-control" id="SalePriceB"
                                               placeholder="SalePriceB">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="QtyGradeB">QtyB</label>
                                        <input type="number" class="form-control" id="QtyGradeB" placeholder="QtyB">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="SalePriceC">SalePriceC</label>
                                        <input type="number" class="form-control" id="SalePriceC"
                                               placeholder="SalePriceC">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="QtyGradeC">QtyC</label>
                                        <input type="number" class="form-control" id="QtyGradeC" placeholder="QtyC">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="SalePriceX">SalePriceX</label>
                                        <input type="number" class="form-control" id="SalePriceX"
                                               placeholder="SalePriceX">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="QtyGradeX">QtyX</label>
                                        <input type="number" class="form-control" id="QtyGradeX" placeholder="QtyX">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="form-group mt-2">
                                <label for="TotalQtyPurchased">TotalQtyPurchased</label>
                                <input type="number" class="form-control" id="TotalQtyPurchased"
                                       placeholder="TotalQtyPurchased">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="AddedDate">AddedDate</label>
                                        <input type="text" class="form-control" id="AddedDate" placeholder="AddedDate">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="FirstPurchaseDate">FirstPurchaseDate</label>
                                        <input type="text" class="form-control" id="FirstPurchaseDate"
                                               placeholder="FirstPurchaseDate">
                                    </div>
                                </div>
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
