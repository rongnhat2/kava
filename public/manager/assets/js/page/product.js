// Định nghĩa đối tượng View chứa các logic quản lý giao diện sản phẩm
const View = {
    Category: {
        list: [],
        // Render ra danh sách các category cho select option
        render() {
            $(".data-category option").remove();
            View.Category.list.map((v) => {
                $(".data-category").append(
                    `<option value="${v.id}">${v.name}</option>`
                );
            });
        },
    },
    Metadata: {
        class: `metadata-list`, // class cho danh sách metadata
        count: 0,
        // Hiển thị nội dung metadata dưới dạng danh sách HTML
        show(metadata) {
            let html = "";
            try {
                const metadataArr = JSON.parse(metadata);
                if (Array.isArray(metadataArr) && metadataArr.length) {
                    html =
                        `<ul style="list-style:none;padding:0;margin:0;">` +
                        metadataArr
                            .map(
                                (item) =>
                                    `<li>
                                    <b>${item.title || ""}</b>
                                    ${item.size ? `- ${item.size}` : ""}
                                    ${
                                        item.price
                                            ? `: <span class="text-primary">${IndexView.Config.formatPrices(
                                                  item.price.toLocaleString()
                                              )} đ</span>`
                                            : ""
                                    }
                                </li>`
                            )
                            .join("") +
                        `</ul>`;
                }
            } catch (e) {
                html = "";
            }
            return html;
        },
        // Template của một dòng nhập metadata
        template(count, data) {
            return `<div class="metadata-item form-row align-items-end mb-3">
                            <div class="col-md-4">
                                <label class="col-form-label control-label">Sản phẩm</label>
                                <input type="text" class="form-control" metadata-title="${count}" placeholder="Nhập Sản phẩm" 
                                value="${data?.title || ""}">
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label control-label">Dung lượng</label>
                                <input type="text" class="form-control" metadata-size="${count}" placeholder="Gram / Kilogram" 
                                value="${data?.size || ""}">
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label control-label">Giá tiền</label>
                                <input type="text" class="form-control" metadata-price="${count}" placeholder="Nhập giá tiền" 
                                value="${data?.price || ""}">
                            </div>
                            <div class="col-md-2 text-right">
                                <button type="button" class="btn btn-danger btn-sm remove-metadata" style="margin-top:26px;"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>`;
        },
        // Lấy giá trị metadata từ form, trả về chuỗi json các đối tượng {title, size, price}
        getVal(resource) {
            // Hàm lấy dữ liệu metadata, trả về chuỗi json các cặp metadata [{title, size, price}]
            let metadataList = [];
            $(`${resource} .${this.class} .metadata-item`).each(function () {
                let title = $(this).find("input[metadata-title]").val() || "";
                let size = $(this).find("input[metadata-size]").val() || "";
                let price = $(this).find("input[metadata-price]").val() || "";
                if (title || size || price) {
                    metadataList.push({
                        title: title,
                        size: size,
                        price: price,
                    });
                }
            });
            return JSON.stringify(metadataList);
        },
        // Gán dữ liệu vào form metadata
        setVal(resource, metadata) {
            $(`${resource} .${this.class} .metadata-item`).remove();
            const metadataArr = JSON.parse(metadata);
            metadataArr.map((v) => {
                $(`${resource} .${this.class}`).append(this.template(v.id, v));
            });
        },
        // Khởi tạo các sự kiện cho thêm/xóa metadata
        init() {
            let self = this;
            // Bắt sự kiện click nút thêm metadata
            $(document).on("click", ".add-metadata", function () {
                self.count++;
                $(this)
                    .parent()
                    .parent()
                    .find(`.${self.class}`)
                    .append(self.template(self.count));
            });
            // Bắt sự kiện click nút xóa metadata
            $(document).on("click", ".remove-metadata", function () {
                $(this).closest(".metadata-item").remove();
            });
        },
    },
    table: {
        // Tạo 1 dòng dữ liệu cho bảng sản phẩm
        __generateDTRow(data) {
            let metadata = View.Metadata.show(data.metadata);
            return [
                `<div class="id-order">${data.id}</div>`,
                `<div class="d-flex">
                    <div class="avatar avatar-image m-r-15">
                        <img src="/${data.images.split(",")[0]}" alt="">
                    </div>
                    <div>
                        <h5 class="m-b-0 text-dark"> ${data.name} 
                        </h5>
                        <p class="m-b-0 text-gray ">  ${data.category_name} 
                        </p> 
                    </div>
                </div>`,
                metadata,
                0,
                0,
                0,
                `<div class="view-data tab-action" atr="View" style="cursor: pointer" data-id="${data.id}"><i class="anticon anticon-edit"></i></div>
                <div class="view-data tab-action" atr="Delete" style="cursor: pointer" data-id="${data.id}"><i class="anticon anticon-delete"></i></div>`,
            ];
        },
        // Khởi tạo cấu hình bảng sản phẩm
        init() {
            var row_table = [
                {
                    title: "ID",
                    name: "name",
                    orderable: true,
                    width: "5%",
                },
                {
                    title: "Danh mục",
                    name: "name",
                    orderable: true,
                    width: "10%",
                },
                {
                    title: "Phân loại",
                    name: "inventory",
                    orderable: true,
                    width: "10%",
                },
                {
                    title: "Đã bán",
                    name: "sold_count",
                    orderable: true,
                    width: "10%",
                },
                {
                    title: "Doanh thu",
                    name: "revenue",
                    orderable: true,
                    width: "10%",
                },
                {
                    title: "Tồn kho",
                    name: "inventory",
                    orderable: true,
                    width: "10%",
                },
                {
                    title: "Hành động",
                    name: "Action",
                    orderable: false,
                    width: "5%",
                },
            ];
            IndexView.table.init("#data-table", row_table);
        },
    },
    Layout: {
        FormCreate: "",
        FormUpdate: "",
        FormDelete: "",
        // Lưu lại template của các form khi khởi tạo và loại bỏ khỏi dom gốc
        init() {
            View.Layout.FormCreate = $(".layout-tab-create").html();
            View.Layout.FormUpdate = $(".layout-tab-create").html();
            View.Layout.FormDelete = $(".layout-tab-delete").html();
            $(".layout-tab-create").remove();
            $(".layout-tab-delete").remove();
        },
    },
    FullTab: {
        Create: {
            // Set lại value khi mở form thêm mới
            setVal() {
                View.Category.render();
            },
            // Lấy dữ liệu từ form thêm mới và validate dữ liệu nhập vào
            getVal(resource) {
                var fd = new FormData();
                var required_data = [];
                var onPushData = true;

                var metadata = View.Metadata.getVal(resource);
                var data_category = $(`${resource}`)
                    .find(".data-category")
                    .val();
                var data_name = $(`${resource}`).find(".data-name").val();
                var data_description = $(`${resource}`)
                    .find(".data-description")
                    .val();
                var data_detail = $(`${resource}`).find(".data-detail").val();
                var data_images = $(`${resource}`).find(".image-list")[0].files;

                // --Kiểm tra các trường bắt buộc
                if (data_name == "") {
                    required_data.push("Nhập tên.");
                    onPushData = false;
                }
                if (data_category == "") {
                    required_data.push("Chọn danh mục.");
                    onPushData = false;
                }
                if (data_description == "") {
                    required_data.push("Nhập mô tả.");
                    onPushData = false;
                }
                if (data_detail == "") {
                    required_data.push("Nhập mô tả.");
                    onPushData = false;
                }
                if (data_images.length == 0) {
                    required_data.push("Chọn hình ảnh.");
                    onPushData = false;
                }

                if (metadata == "") {
                    required_data.push("Phải có ít nhất một metadata.");
                    onPushData = false;
                }

                // Nếu đã nhập đủ, tiến hành đóng gói FormData; ngược lại, hiển thị danh sách lỗi
                if (onPushData) {
                    fd.append("data_category", data_category);
                    fd.append("data_name", data_name);
                    fd.append("data_description", data_description);
                    fd.append("data_detail", data_detail);
                    fd.append("image_list_length", data_images.length);
                    for (var i = 0; i < data_images.length; i++) {
                        fd.append("image_list_item_" + i, data_images[i]);
                    }
                    fd.append("metadata", metadata);
                    console.log(fd);
                    return fd;
                } else {
                    $(`${resource}`).find(".error-log .js-errors").remove();
                    var required_noti = ``;
                    for (var i = 0; i < required_data.length; i++) {
                        required_noti += `<li class="error">${required_data[i]}</li>`;
                    }
                    $(`${resource}`)
                        .find(".error-log")
                        .prepend(
                            ` <ul class="js-errors">${required_noti}</ul> `
                        );
                    return false;
                }
            },
            // Render lại layout form thêm mới
            init(name) {
                $(`[data-tab-name=${name}]`).html(View.Layout.FormCreate);
            },
        },
        Update: {
            // Gán giá trị dữ liệu vào form cập nhật
            setVal(resource, data) {
                View.Category.render();
                $(`${resource}`).find(".data-id").val(data.id);
                $(`${resource}`).find(".data-name").val(data.name);
                $(`${resource}`).find(".data-category").val(data.category_id);
                $(`${resource}`)
                    .find(".data-description")
                    .val(data.description);
                $(`${resource}`).find(".data-detail").val(data.detail);
                data.images == ""
                    ? null
                    : IndexView.multiImage.setVal(data.images);
                View.Metadata.setVal(resource, data.metadata);
            },
            // Lấy value từ form cập nhật và kiểm tra nhập đủ các trường cần thiết chưa
            getVal(resource) {
                var fd = new FormData();
                var required_data = [];
                var onPushData = true;

                var data_id = $(`${resource}`).find(".data-id").val();

                var metadata = View.Metadata.getVal(resource);
                var data_category = $(`${resource}`)
                    .find(".data-category")
                    .val();
                var data_name = $(`${resource}`).find(".data-name").val();
                var data_description = $(`${resource}`)
                    .find(".data-description")
                    .val();
                var data_detail = $(`${resource}`).find(".data-detail").val();
                var data_images = $(`${resource}`).find(".image-list")[0].files;

                var data_images_preview = [];
                $(`${resource}`)
                    .find(".image-preview-item.image-load-data")
                    .each(function (index, el) {
                        data_images_preview.push($(this).attr("data-url"));
                    });

                // --Kiểm tra các trường cần thiết
                if (data_name == "") {
                    required_data.push("Nhập tên.");
                    onPushData = false;
                }
                if (data_description == "") {
                    required_data.push("Nhập mô tả.");
                    onPushData = false;
                }

                // Nếu dữ liệu đủ điều kiện, đóng gói FormData và trả về
                if (onPushData) {
                    fd.append("data_id", data_id);
                    fd.append("data_category", data_category);
                    fd.append("data_name", data_name);
                    fd.append("data_description", data_description);
                    fd.append("data_detail", data_detail);
                    fd.append("image_list_length", data_images.length);
                    fd.append(
                        "data_images_preview",
                        data_images_preview.toString()
                    );
                    fd.append("image_list_length", data_images.length);
                    for (var i = 0; i < data_images.length; i++) {
                        fd.append("image_list_item_" + i, data_images[i]);
                    }
                    fd.append("metadata", metadata);

                    return fd;
                } else {
                    $(`${resource}`).find(".error-log .js-errors").remove();
                    var required_noti = ``;
                    for (var i = 0; i < required_data.length; i++) {
                        required_noti += `<li class="error">${required_data[i]}</li>`;
                    }
                    $(`${resource}`)
                        .find(".error-log")
                        .prepend(
                            ` <ul class="js-errors">${required_noti}</ul> `
                        );
                    return false;
                }
            },
            // Khởi tạo lại layout form update
            init(name) {
                $(`[data-tab-name=${name}]`).html(View.Layout.FormCreate);
            },
        },
        Delete: {
            // Gán id cần xóa vào popup xóa
            setVal(resource, id) {
                $(resource).find(".data-id").val(id);
            },
            // Lấy id cần xóa
            getVal(resource) {
                $(resource).find(".data-id").val();
            },
            // Render layout form xóa
            init(name) {
                $(`[data-tab-name=${name}]`).html(View.Layout.FormDelete);
            },
        },
        // Hàm thực thi callback khi bấm button submit trong từng tab
        onPush(name, resource, callback) {
            $(document).on(
                "click",
                `${resource} .full-tab-action`,
                function () {
                    $(this).attr("atr").trim();
                    if ($(this).attr("atr").trim() == name) {
                        callback();
                    }
                }
            );
        },
        // Xóa nội dung của tab đang chọn
        default(name) {
            $(`[data-tab-name=${name}]`).html("");
        },
        // Hiển thị tab được chọn
        doShow(name) {
            $(".data-custom-tab").removeClass("on-show");
            $(`.data-custom-tab[data-tab-name=${name}]`).addClass("on-show");
        },
        // Lắng nghe sự kiện click vào tab (xem, xóa, sửa,...)
        onShow(name, callback) {
            $(document).on("click", `.tab-action`, function () {
                if ($(this).attr("atr").trim() == name) {
                    var id = $(this).attr("data-id");
                    callback(id);
                }
            });
        },
    },
    // Khởi tạo các phần của giao diện sản phẩm
    init() {
        View.Layout.init();
        View.table.init();
        View.Metadata.init();
    },
};

// Hàm khởi động toàn bộ chức năng View
(() => {
    View.init();
    function init() {
        getCategory();
        getData();
    }
    // Xử lý hiển thị tab Table (danh sách sản phẩm)
    View.FullTab.onShow("Table", () => {
        View.FullTab.doShow("Table");
        View.FullTab.default("Create");
        View.FullTab.default("Update");
        getData();
    });

    // Xử lý hiển thị tab Create (tạo mới sản phẩm)
    View.FullTab.onShow("Create", () => {
        View.FullTab.doShow("Create");
        View.FullTab.Create.init("Create");
        View.FullTab.Create.setVal();
    });
    // Sự kiện xác nhận tạo sản phẩm mới
    View.FullTab.onPush("Confirm", "#popup-create", () => {
        var fd = View.FullTab.Create.getVal("#popup-create");
        if (fd) {
            View.FullTab.doShow("Table");
            View.FullTab.default();
            IndexView.helper.showToastProcessing("Process", "Đang xử lí");
            Api.Product.Store(fd)
                .done((res) => {
                    IndexView.helper.showToastSuccess("Success", "Thành công");
                    getData();
                })
                .fail((err) => {
                    IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
                })
                .always(() => {});
        }
    });

    // Xử lý xem/chỉnh sửa sản phẩm
    View.FullTab.onShow("View", (id) => {
        View.FullTab.doShow("Update");
        View.FullTab.Update.init("Update");
        IndexView.helper.showToastProcessing("Process", "Đang xử lí");
        Api.Product.getOne(id)
            .done((res) => {
                View.FullTab.Update.setVal("#popup-update", res.data);
                IndexView.helper.showToastSuccess("Success", "Lấy ra dữ liệu");
            })
            .fail((err) => {
                IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            })
            .always(() => {});
    });
    // Sự kiện xác nhận cập nhật sản phẩm
    View.FullTab.onPush("Confirm", "#popup-update", () => {
        var fd = View.FullTab.Update.getVal("#popup-update");
        if (fd) {
            View.FullTab.doShow("Table");
            View.FullTab.default();
            IndexView.helper.showToastProcessing("Process", "Đang xử lí");
            Api.Product.Update(fd)
                .done((res) => {
                    IndexView.helper.showToastSuccess("Success", "Thành công");
                    getData();
                })
                .fail((err) => {
                    IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
                })
                .always(() => {});
        }
    });

    // Xử lý hiển thị popup xác nhận xóa sản phẩm
    View.FullTab.onShow("Delete", (id) => {
        View.FullTab.doShow("Delete");
        View.FullTab.Delete.init("Delete");
        View.FullTab.Delete.setVal("#popup-delete", id);
    });
    // Sự kiện xác nhận xóa sản phẩm
    View.FullTab.onPush("Delete", "#popup-delete", () => {
        View.FullTab.doShow("Table");
        View.FullTab.default();
        IndexView.helper.showToastProcessing("Process", "Đang xử lí");
        Api.Product.Delete($("#popup-delete").find(".data-id").val())
            .done((res) => {
                IndexView.helper.showToastSuccess("Success", "Thành công");
                getData();
            })
            .fail((err) => {
                IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            })
            .always(() => {});
    });

    // Lấy tất cả danh mục sản phẩm từ API
    function getCategory() {
        Api.Category.GetAll()
            .done((res) => {
                View.Category.list = res.data;
            })
            .fail((err) => {
                IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            })
            .always(() => {});
    }

    // Lấy toàn bộ dữ liệu sản phẩm từ API và render ra bảng
    function getData() {
        Api.Product.GetAll()
            .done((res) => {
                IndexView.table.clearRows();
                Object.values(res.data).map((v) => {
                    IndexView.table.insertRow(View.table.__generateDTRow(v));
                    IndexView.table.render();
                });
                IndexView.table.render();
            })
            .fail((err) => {
                IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            })
            .always(() => {});
    }

    // Hàm debounce dùng để chống spam thao tác
    function debounce(f, timeout) {
        let isLock = false;
        let timeoutID = null;
        return function (item) {
            if (!isLock) {
                f(item);
                isLock = true;
            }
            clearTimeout(timeoutID);
            timeoutID = setTimeout(function () {
                isLock = false;
            }, timeout);
        };
    }
    // Gọi khởi tạo
    init();
})();
