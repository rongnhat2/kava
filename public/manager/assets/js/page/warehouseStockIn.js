const ViewStockIn = {
    Supplier: [],
    Branch: [],
    Product: [],
    table: {
        // Hàm tạo một hàng dữ liệu cho bảng danh sách nhập kho
        __generateDTRow(data) {
            return [
                `<div class="id-order">${data.id}</div>`,
                data.supplier_name,
                data.branch_name,
                IndexView.Config.formatPrices(data.total_amount) + " đ",
                data.import_date,
                `<div class="view-data tab-action" atr="View" style="cursor: pointer" data-id="${data.id}"><i class="anticon anticon-eye"></i></div>`,
            ];
        },
        // Hàm khởi tạo cấu trúc tiêu đề cột của bảng danh sách nhập kho
        init() {
            var row_table = [
                {
                    title: "ID",
                    name: "name",
                    orderable: true,
                    width: "5%",
                },
                {
                    title: "Nhà cung cấp",
                    name: "supplier_name",
                    orderable: true,
                    width: "10%",
                },
                {
                    title: "Chi nhánh",
                    name: "branch_name",
                    orderable: true,
                    width: "10%",
                },
                {
                    title: "Giá trị",
                    name: "total_amount",
                    orderable: true,
                    width: "10%",
                },
                {
                    title: "Ngày nhập",
                    name: "import_date",
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
            IndexView.table.init("#data-table-stock-in", row_table);
        },
    },
    StockIn: {
        // Hàm render dữ liệu supplier và branch ra selector trên giao diện nhập kho
        render() {
            ViewStockIn.Supplier.map((v) => {
                $(`.data-supplier`).append(
                    `<option value="${v.id}">${v.name}</option>`
                );
            });
            ViewStockIn.Branch.map((v) => {
                $(`.data-branch`).append(
                    `<option value="${v.id}">${v.name}</option>`
                );
            });
        },
        // Hàm tạo template cho từng dòng nhập sản phẩm trong bảng nhập kho
        itemTemplate(count, data) {
            return `<tr class="item-insert-warehouse">
                        <td>
                            <select class="form-control" data-product>
                                <option value="0">-- Chọn sản phẩm --</option>
                                ${ViewStockIn.Product.map(
                                    (item) =>
                                        `<option value="${item.id}">${item.name}</option>`
                                ).join("")}
                            </select>
                        </td>
                        <td>
                            <select class="form-control" data-metadata> </select>
                        </td>
                        <td><input type="number" class="form-control" data-quantity value="0"></td>
                        <td><input type="number" class="form-control" data-price value="0"></td>
                        <td><input type="text" class="form-control" data-total value="0" disabled></td> 
                        <td><button class="btn btn-danger btn-sm delete-item-insert-warehouse"><i class="anticon anticon-delete"></i></button></td>
                    </tr>`;
        },
        // Hàm lấy giá trị dữ liệu các dòng sản phẩm đang nhập
        getVal() {
            let dataList = [];
            $(`.item-insert-warehouse`).each(function () {
                let product = $(this).find("select[data-product]").val() || "";
                let quantity = $(this).find("input[data-quantity]").val() || "";
                let price = $(this).find("input[data-price]").val() || "";
                let total = $(this).find("input[data-total]").val() || "";
                let metadata =
                    $(this).find("select[data-metadata]").val() || "";
                if (product || quantity || price || total || metadata) {
                    dataList.push({
                        product: product,
                        quantity: quantity,
                        price: price,
                        total: total,
                        metadata: metadata,
                    });
                }
            });

            // Kiểm tra bắt buộc phải có ít nhất 1 sản phẩm
            if (dataList.length == 0) {
                IndexView.helper.showToastError(
                    "Error",
                    "Phải có ít nhất một sản phẩm."
                );
                return false;
            }
            // Kiểm tra bắt buộc ngày nhập phải được chọn
            if ($(`.data-date`).val() == "") {
                IndexView.helper.showToastError("Error", "Chọn ngày nhập.");
                return false;
            }

            var fd = new FormData();
            fd.append("branch_id", $(`.data-branch`).val());
            fd.append("supplier_id", $(`.data-supplier`).val());
            fd.append("date", $(`.data-date`).val());
            fd.append("total", $(`.data-total`).val());
            fd.append("metadata", JSON.stringify(dataList));
            return fd;
        },
        // Hàm xử lý khi có thay đổi số lượng hoặc giá sản phẩm theo dòng
        onChangeItem(index) {
            let quantity =
                $(`.stock-in-table tbody tr`)
                    .eq(index)
                    .find("input[data-quantity]")
                    .val() || "";
            let price =
                $(`.stock-in-table tbody tr`)
                    .eq(index)
                    .find("input[data-price]")
                    .val() || "";
            let total = quantity * price;
            $(`.stock-in-table tbody tr`)
                .eq(index)
                .find("input[data-total]")
                .val(total);
            ViewStockIn.StockIn.setPricesTotal();
        },
        // Hàm gán sự kiện onchange cho selector chọn sản phẩm để callback render metadata sản phẩm
        onChangeProduct(callback) {
            $(document).on("change", "select[data-product]", function () {
                let product_id = $(this).val();
                if (product_id != 0) {
                    callback(product_id, $(this).closest("tr").index());
                }
            });
        },
        // Hàm render metadata(kích thước/option) cho sản phẩm đã chọn vào selector dòng đang xử lý
        onRenderProductMetadata(index, metadata) {
            $(`.stock-in-table tbody tr`)
                .eq(index)
                .find("select[data-metadata] option")
                .remove();
            let metadataArr = JSON.parse(metadata);
            metadataArr.map((v) => {
                $(`.stock-in-table tbody tr`)
                    .eq(index)
                    .find("select[data-metadata]")
                    .append(
                        `<option value="${v.title} - ${v.size}">${v.title} - ${v.size}</option>`
                    );
            });
        },
        // Hàm tính tổng giá trị của tất cả các dòng sản phẩm đang nhập
        setPricesTotal() {
            let total = 0;
            $(`.stock-in-table tbody tr`).each(function () {
                total += parseInt($(this).find("input[data-total]").val() || 0);
            });
            $(`.data-total`).val(total);
        },
        // Hàm thêm 1 dòng sản phẩm nhập mới vào bảng
        insertItem() {
            var item = ViewStockIn.StockIn.itemTemplate(0, null);
            $(".stock-in-table  tbody").append(item);
        },
        // Hàm xóa 1 dòng sản phẩm nhập theo chỉ số index
        removeItem(index) {
            $(".stock-in-table tbody tr").eq(index).remove();
        },
        // Hàm lắng nghe sự kiện tạo phiếu nhập kho, gọi callback
        onCreateStockIn(callback) {
            $(document).on("click", `.create-stock-in`, function () {
                callback();
            });
        },
        // Hàm khởi tạo các sự kiện, render dữ liệu cho giao diện nhập kho
        init() {
            $(document).on(
                "click",
                ".create-item-insert-warehouse",
                function () {
                    ViewStockIn.StockIn.insertItem();
                }
            );
            $(document).on(
                "click",
                ".delete-item-insert-warehouse",
                function () {
                    ViewStockIn.StockIn.removeItem(
                        $(this).closest("tr").index()
                    );
                }
            );
            $(document).on("keyup", "input[data-quantity]", function () {
                ViewStockIn.StockIn.onChangeItem($(this).closest("tr").index());
            });
            $(document).on("keyup", "input[data-price]", function () {
                ViewStockIn.StockIn.onChangeItem($(this).closest("tr").index());
            });
            ViewStockIn.StockIn.render();
            ViewStockIn.StockIn.setPricesTotal();
        },
    },
    Layout: {
        FormCreate: "",
        FormTable: "",
        // Hàm khởi tạo dữ liệu layout cho tạo mới và bảng danh sách nhập kho
        init() {
            ViewStockIn.Layout.FormCreate = $(
                ".layout-tab-stock-in-create"
            ).html();
            ViewStockIn.Layout.FormTable = $(
                ".layout-tab-stock-in-table"
            ).html();
            $(".layout-tab-stock-in-create").remove();
            $(".layout-tab-stock-in-table").remove();
        },
    },
    FullTab: {
        Create: {
            // Hàm thiết lập giá trị cho form tạo mới (chưa sử dụng)
            setVal(resource, data) {},
            // Hàm lấy dữ liệu từ form tạo mới. Kiểm tra dữ liệu bắt buộc, trả về FormData hoặc hiển thị lỗi
            getVal(resource) {
                var fd = new FormData();
                var required_data = [];
                var onPushData = true;

                var data_name = $(`${resource}`).find(".data-name").val();
                var data_description = $(`${resource}`)
                    .find(".data-description")
                    .val();
                var data_image = $(`${resource}`).find(".image-input")[0].files;

                // Kiểm tra các trường bắt buộc
                if (data_name == "") {
                    required_data.push("Nhập tên.");
                    onPushData = false;
                }
                if (data_description == "") {
                    required_data.push("Nhập mô tả.");
                    onPushData = false;
                }
                if (data_image.length == 0) {
                    required_data.push("Chọn hình ảnh.");
                    onPushData = false;
                }

                if (onPushData) {
                    fd.append("data_name", data_name);
                    fd.append("data_description", data_description);
                    fd.append("data_image", data_image[0]);

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
            // Hàm khởi tạo giao diện tạo mới
            init(name) {
                $(`[data-tab-name=${name}]`).html(
                    ViewStockIn.Layout.FormCreate
                );
            },
        },
        Update: {
            // Hàm thiết lập dữ liệu cho form cập nhật
            setVal(resource, data) {
                $(`${resource}`).find(".data-id").val(data.id);
                $(`${resource}`).find(".data-name").val(data.name);
                $(`${resource}`)
                    .find(".data-description")
                    .val(data.description);
                $(`${resource}`)
                    .find(".image-preview")
                    .attr("src", `/${data.image}`);
            },
            // Hàm lấy dữ liệu từ form cập nhật, kiểm tra dữ liệu bắt buộc
            getVal(resource) {
                var fd = new FormData();
                var required_data = [];
                var onPushData = true;

                var data_id = $(`${resource}`).find(".data-id").val();
                var data_name = $(`${resource}`).find(".data-name").val();
                var data_description = $(`${resource}`)
                    .find(".data-description")
                    .val();
                var data_image = $(`${resource}`).find(".image-input")[0].files;

                // Kiểm tra các trường bắt buộc
                if (data_name == "") {
                    required_data.push("Nhập tên.");
                    onPushData = false;
                }
                if (data_description == "") {
                    required_data.push("Nhập mô tả.");
                    onPushData = false;
                }

                if (onPushData) {
                    fd.append("data_id", data_id);
                    fd.append("data_name", data_name);
                    fd.append("data_description", data_description);
                    fd.append("data_image", data_image[0]);

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
            // Hàm khởi tạo giao diện form cập nhật
            init(name) {
                $(`[data-tab-name=${name}]`).html(
                    ViewStockIn.Layout.FormCreate
                );
            },
        },
        Delete: {
            // Hàm thiết lập id cho form xác nhận xóa
            setVal(resource, id) {
                $(resource).find(".data-id").val(id);
            },
            // Hàm lấy id từ form xác nhận xóa
            getVal(resource) {
                $(resource).find(".data-id").val();
            },
            // Hàm khởi tạo giao diện form xác nhận xóa
            init(name) {
                $(`[data-tab-name=${name}]`).html(
                    ViewStockIn.Layout.FormDelete
                );
            },
        },
        Table: {
            // Hàm render layout bảng danh sách hàng nhập kho
            init(name) {
                $(`[data-tab-name=${name}]`).html(ViewStockIn.Layout.FormTable);
            },
        },
        // Hàm lắng nghe sự kiện nhấn nút ở tab và gọi callback theo tên tab
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
        // Hàm reset HTML nội dung của tab cụ thể
        default(name) {
            $(`[data-tab-name=${name}]`).html("");
        },
        // Hàm hiển thị tab tương ứng, ẩn các tab còn lại
        doShow(name) {
            $(".warehouse-layout").removeClass("showing");
            $(`[data-tab-name=${name}] .warehouse-layout`).addClass("showing");
        },
        // Hàm lắng nghe sự kiện chuyển tab và gọi callback kèm ID (nếu có)
        onShow(name, callback) {
            $(document).on("click", `.tab-action`, function () {
                if ($(this).attr("atr").trim() == name) {
                    var id = $(this).attr("data-id");
                    callback(id);
                }
            });
        },
    },
    // Hàm khởi tạo toàn bộ module nhập kho (Gọi khi load trang)
    init() {
        ViewStockIn.StockIn.init();
        ViewStockIn.Layout.init();
    },
};
(() => {
    // Hàm khởi tạo dữ liệu trang nhập kho, load dữ liệu cần thiết
    async function init() {
        await getSupplier();
        await getBranch();
        await getProduct();

        await ViewStockIn.init();

        await getStockInTable();
    }

    // Hàm lấy dữ liệu bảng danh sách phiếu nhập, render giao diện
    async function getStockInTable() {
        await ViewStockIn.FullTab.Table.init("StockInTable");
        await ViewStockIn.FullTab.doShow("StockInTable");
        await ViewStockIn.table.init();
        await getStockIn();
    }

    // Lắng nghe chuyển sang tab danh sách phiếu nhập kho
    ViewStockIn.FullTab.onShow("StockInTable", async () => {
        await getStockInTable();
    });

    // Lắng nghe chuyển sang tab tạo phiếu nhập kho
    ViewStockIn.FullTab.onShow("StockInCreate", () => {
        ViewStockIn.FullTab.Create.init("StockInCreate");
        ViewStockIn.FullTab.doShow("StockInCreate");
    });

    // Lắng nghe sự kiện nhấn nút tạo phiếu nhập kho mới
    ViewStockIn.StockIn.onCreateStockIn(async () => {
        var fd = ViewStockIn.StockIn.getVal();
        if (fd) {
            IndexView.helper.showToastProcessing("Process", "Đang xử lí");
            // Api.Warehouse.StockInCreate(fd)
            //     .done(async (res) => {
            //         IndexView.helper.showToastSuccess("Success", "Thành công");
            //         await getStockInTable();
            //     })
            //     .fail((err) => {
            //         IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            //     })
            //     .always(() => {});
        }
    });

    // Lắng nghe thay đổi sản phẩm, lấy metadata sản phẩm và render vào selector tương ứng
    ViewStockIn.StockIn.onChangeProduct((product_id, index) => {
        Api.Product.getOne(product_id)
            .done((res) => {
                ViewStockIn.StockIn.onRenderProductMetadata(
                    index,
                    res.data.metadata
                );
            })
            .fail((err) => {
                IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            });
    });

    // Hàm lấy toàn bộ sản phẩm (dùng cho selector)
    async function getProduct() {
        return Api.Product.GetAll()
            .done((res) => {
                ViewStockIn.Product = res.data;
            })
            .fail((err) => {
                IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            })
            .always(() => {});
    }

    // Hàm lấy toàn bộ nhà cung cấp
    async function getSupplier() {
        return Api.Supplier.GetAll()
            .done((res) => {
                ViewStockIn.Supplier = res.data;
            })
            .fail((err) => {
                IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            })
            .always(() => {});
    }

    // Hàm lấy toàn bộ chi nhánh
    async function getBranch() {
        return Api.Branch.GetAll()
            .done((res) => {
                ViewStockIn.Branch = res.data;
            })
            .fail((err) => {
                IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            })
            .always(() => {});
    }

    // Hàm lấy toàn bộ phiếu nhập kho và render vào bảng
    async function getStockIn() {
        return Api.Warehouse.StockInGetAll()
            .done((res) => {
                IndexView.table.clearRows();
                Object.values(res.data).map((v) => {
                    IndexView.table.insertRow(
                        ViewStockIn.table.__generateDTRow(v)
                    );
                    IndexView.table.render();
                });
                IndexView.table.render();
            })
            .fail((err) => {
                IndexView.helper.showToastError("Error", "Có lỗi sảy ra");
            })
            .always(() => {});
    }

    // Hàm debounce chuẩn để tránh gọi hàm thao tác liên tục, chỉ gọi sau 1 khoảng thời gian timeout
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
    // Gọi khởi tạo trang nhập kho khi load
    init();
})();
