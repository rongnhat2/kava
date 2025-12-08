const IndexView = {
    helper: {
        layout(status_value, message) {
            var class_name = [
                "notification-error",
                "notification-processing",
                "notification-success",
            ];
            var alert_name = ["alert-danger", "alert-primary", "alert-success"];
            var alert_icon = [
                '<i class="anticon anticon-check-o"></i>',
                '<i class="anticon anticon-loading"></i>',
                '<i class="anticon anticon-check-o"></i>',
            ];
            return `<div class="notification ${class_name[status_value]} ${alert_name[status_value]} ">
                        <div class="d-flex align-items-center justify-content-start">
                            <span class="alert-icon">${alert_icon[status_value]}</span>
                            <span>${message}</span>
                        </div>
                    </div>`;
        },
        showToastSuccess(title, message) {
            $("#notification-sending").html("");
            $("#notification-success").append(
                IndexView.helper.layout(2, message)
            );
            setTimeout(function () {
                $("#notification-success .notification:first-child").remove();
            }, 2000);
        },
        showToastError(title, message) {
            $("#notification-sending").html("");
            $("#notification-error").append(
                IndexView.helper.layout(0, message)
            );
            setTimeout(function () {
                $("#notification-error .notification:first-child").remove();
            }, 2000);
        },
        showToastProcessing(title, message) {
            $("#notification-success").html("");
            $("#notification-error").html("");
            $("#notification-sending").append(
                IndexView.helper.layout(1, message)
            );
        },
    },
    Config: {
        onNumberKey(evt) {
            var charCode = evt.which ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
            return true;
        },
        isEmail(email) {
            return email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
        },
        formatPrices(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        },
        toNoTag(string) {
            return string.replace(/(<([^>]+)>)/gi, "");
        },
        toRemoveStringTag(string) {
            return string.replace(/(<([^>]+)>(.*?)<\/([^>]+)>)/gi, "");
        },
        onPricesKey(evt) {
            var charCode = evt.which ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
            return true;
        },
    },
    Category: {
        categoryFooter: `.footer-category-list`,
        categorySearch: `.search-with-category`,
        categoryBrower: `.category-brower`,
        renderInBrower(data) {
            $(IndexView.Category.categoryBrower).empty();

            // Chia đều số lượng phân loại vào hai cột (nếu lẻ thì cột 1 nhiều hơn)
            let mid = Math.ceil(data.length / 2);
            let col1 = data.slice(0, mid);
            let col2 = data.slice(mid);

            let ul1 = "<ul>";
            col1.forEach((c) => {
                ul1 += `
                <li>
                    <a href="shop-grid-right.html">
                        <img src="/${c.image}" alt="" />${c.name}
                    </a>
                </li>
                `;
            });
            ul1 += "</ul>";

            let ul2 = '<ul class="end">';
            col2.forEach((c) => {
                ul2 += `
                <li>
                    <a href="shop-grid-right.html">
                        <img src="/${c.image}" alt="" />${c.name}
                    </a>
                </li>
                `;
            });
            ul2 += "</ul>";

            $(IndexView.Category.categoryBrower).append(ul1 + ul2);
        },
        renderInList(data) {
            data.map((v) => {
                $("#myTab").append(`
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-${v.slug}" data-bs-toggle="tab" data-bs-target="#tab-${v.slug}" type="button" role="tab" aria-controls="tab-${v.id}" aria-selected="false">${v.name}</button>
                    </li>
                `);
                $("#myTabContent")
                    .append(`<div class="tab-pane fade" id="tab-${v.slug}" role="tabpanel" aria-labelledby="tab-${v.slug}">
                                <div class="row product-grid-4" id="product-list-${v.slug}"> 
                                </div> 
                            </div>`);
            });
        },
        renderInSearch(data) {
            data.map((v) => {
                $(IndexView.Category.categorySearch).append(
                    `<option value="${v.slug}">${v.name}</option>`
                );
            });
            IndexView.Select.categorySearch();
        },
        renderInFooter(data) {
            data.map((v) => {
                $(IndexView.Category.categoryFooter)
                    .append(`<div class="card-1">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="javascript:void(0);" data-slug="${v.slug}"><img src="${v.image}" alt="" /></a>
                        </figure>
                        <h6>
                            <a href="javascript:void(0);" data-slug="${v.slug}">${v.name}</a>
                        </h6>
                    </div>`);
            });
            IndexView.Carousel.CategoryFooter();
        },
    },
    Select: {
        categorySearch() {
            $(IndexView.Category.categorySearch).select2({
                placeholder: "Tất cả",
                allowClear: true,
            });
        },
    },

    Carousel: {
        CategoryFooter() {
            /*Carausel 8 columns*/
            $(".carausel-8-columns").each(function (key, item) {
                var id = $(this).attr("id");
                var sliderID = "#" + id;
                var appendArrowsClassName = "#" + id + "-arrows";

                $(sliderID).slick({
                    dots: false,
                    infinite: true,
                    speed: 1000,
                    arrows: true,
                    autoplay: true,
                    slidesToShow: 8,
                    slidesToScroll: 1,
                    loop: true,
                    adaptiveHeight: true,
                    responsive: [
                        {
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 1,
                            },
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                            },
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                            },
                        },
                    ],
                    prevArrow:
                        '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
                    nextArrow:
                        '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
                    appendArrows: appendArrowsClassName,
                });
            });
        },
    },
    init() {
        $(document).on("keypress", `.type-number`, function (event) {
            return IndexView.Config.onNumberKey(event);
        });
    },
};
(() => {
    IndexView.init();

    async function init() {
        await GetAllCategory();
    }

    async function GetAllCategory() {
        await Api.Category.GetAll()
            .done((res) => {
                IndexView.Category.renderInList(res.data);
                IndexView.Category.renderInFooter(res.data);
                IndexView.Category.renderInSearch(res.data);
                IndexView.Category.renderInBrower(res.data);
            })
            .fail((err) => {})
            .always(() => {});
    }
    init();
})();
