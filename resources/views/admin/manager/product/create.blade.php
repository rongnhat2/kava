<div class="layout-tab-create">
    <input type="hidden" class="form-control data-id">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="error-log"> </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label control-label">Danh mục</label>
                        <div class="col-md-6">
                            <select name="" id="" class="form-control data-category">
                                <option value="">Chọn danh mục</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label control-label">Tên sản phẩm</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control data-name" placeholder="Nhập tên danh mục">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label control-label">Mô tả</label>
                        <div class="col-md-12">
                            <textarea name="" id="" class="form-control data-description" placeholder="Nhập mô tả" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label control-label">Chi tiết</label>
                        <div class="col-md-12">
                            <textarea name="" id="" class="form-control data-detail" placeholder="Nhập chi tiết" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label control-label">Hình ảnh</label>
                        <div class="col-md-12">
                            <input type="file" class="form-control image-list" id="image-create" name="image" accept="image/*" multiple="">
                            <div class="form-preview multi-upload"> </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <h5 class="col-sm-12 card-title d-flex justify-content-between align-items-center">
                            Metadata
                            <button type="button" class="btn btn-success btn-sm add-metadata"><i class="fa fa-plus"></i> Thêm metadata</button>
                        </h5>
                        <div class="metadata-list col-sm-12">

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