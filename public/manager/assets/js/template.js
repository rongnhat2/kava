const Template = { 
    Timeline: {
        Item(){
            return `<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 timeline-item-data">
                        <div class="item-remove">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label control-label">Tiêu đề</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control data-item-name" placeholder="( NGÀY 01: HÀ NỘI – NGHĨA LỘ - TRẠM TẤU(ĂN - / TRƯA / TỐI) )">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label control-label m-b-10">Nội dung ( <p style="display: inline;">Xuống dòng để tách các nội dung</p> )</label>
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control data-item-description" placeholder="" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
        }, 
    }, 
    Hotel: {
        Item(){
            return `<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 timeline-item-data">
                        <div class="item-remove">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label control-label">Tiêu đề</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control data-item-name" placeholder="Thời gian nhận – trả phòng">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label control-label m-b-10">Nội dung ( <p style="display: inline;">Xuống dòng để tách các nội dung</p> )</label>
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control data-item-description" placeholder="" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
        }, 
    }, 
}