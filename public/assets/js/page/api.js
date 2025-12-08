const Api = {
    Category: {},
    Product: {},
};
(() => {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        crossDomain: true,
    });
})();

//category
(() => {
    Api.Category.GetAll = () =>
        $.ajax({
            url: `/api/customer/category/get`,
            method: "GET",
        });
})();

//product
(() => {
    Api.Product.GetNewProduct = () =>
        $.ajax({
            url: `/api/customer/product/get-new-product`,
            method: "GET",
        });
})();
