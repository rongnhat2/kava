<div class="layout-tab-stock-in-create ">
    <div class="card warehouse-layout">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h4 class="m-b-0">Phiếu nhập kho</h4>
                </div>
                <div class="col-sm-12 col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <label>Kho nhập</label>
                    <select class="form-control data-branch">
                    </select>
                </div>
                <div class="col-sm-3 col-md-3">
                    <label>Nhà cung cấp</label>
                    <select class="form-control data-supplier">
                    </select>
                </div>
                <div class="col-sm-3 col-md-3">
                    <label>Ngày nhập</label>
                    <input type="date" class="form-control data-date" />
                </div>
                <div class="col-sm-3 col-md-3">
                    <label>Giá trị</label>
                    <input type="text " class="form-control data-total" disabled value="0" />
                </div>
            </div>
            <div class="m-t-25">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm stock-in-table">
                        <thead>
                            <tr>
                                <th width="20%">
                                    <p class="d-flex align-items-center mb-0">Sản phẩm</p>
                                </th>
                                <th width="20%">
                                    <p class="d-flex align-items-center mb-0">Phân loại</p>
                                </th>
                                <th>
                                    <p class="d-flex align-items-center mb-0">Số lượng </p>
                                </th>
                                <th>
                                    <p class="d-flex align-items-center mb-0">Đơn giá</p>
                                </th>
                                <th>
                                    <p class="d-flex align-items-center mb-0">Thành tiền</p>
                                </th>
                                <th><button class="btn btn-success btn-sm create-item-insert-warehouse"><i
                                            class="anticon anticon-plus"></i></button></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <div class="form-group text-right">
                        <button class="btn btn-danger mr-2 tab-action" atr="StockInTable">Hủy</button>
                        <button class="btn btn-primary create-stock-in">Tạo đơn</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>