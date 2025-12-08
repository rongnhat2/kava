<div class="layout-tab-create">
    <input type="hidden" class="form-control data-id">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="error-log"> </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label control-label">Email</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control data-email" placeholder="Nhập email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label control-label">Mật khẩu</label>
                        <div class="col-md-8 d-flex align-items-center">
                            <input type="text" class="form-control data-password" placeholder="Nhập mật khẩu" style="margin-right: 8px;">
                            <button type="button" class="btn btn-secondary btn-sm btn-random-password">Tạo ngẫu nhiên</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label control-label">Họ tên</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control data-name" placeholder="Nhập họ tên">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label control-label">Số điện thoại</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control data-phone" placeholder="Nhập số điện thoại">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label control-label">Địa chỉ</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control data-address" placeholder="Nhập địa chỉ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label control-label">Vai trò</label>
                        <div class="col-md-8">
                            <select name="role_id" class="form-control data-role_id">
                                <option value="">Chọn vai trò</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label control-label">Nhà cung cấp</label>
                        <div class="col-md-8">
                            <select name="branch_id" class="form-control data-branch_id">
                                <option value="">Chọn nhà cung cấp</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-defauld mr-2 tab-action" atr="Table">Hủy</button>
                        <button class="btn btn-primary full-tab-action" atr="Confirm">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>