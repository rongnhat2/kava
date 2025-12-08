const View = {
    Product: {
        Template(data, in_cart = 0, in_favorite = 0) {
            let images = data.images.split(",");

            let image_hover = `<img class="default-img" src="/${images[0]}" alt="" /> <img class="hover-img" src="/${images[1]}" alt="" />`;
            let metadata = JSON.parse(data.metadata);
            let low_prices = () => {
                return metadata.reduce((max, item) => {
                    return item.price > max ? item.price : max;
                }, 0);
            };
            return `<div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="/product/${data.id}-${data.slug}">
                                        ${image_hover}
                                    </a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="#">${data.category_name}</a>
                                </div>
                                <h2>
                                    <a href="/product/${data.id}-${data.slug}">
                                        ${data.name}
                                    </a>
                                </h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 80%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (3.5)</span>
                                </div> 
                                <div class="product-price">
                                    <span> 
                                    ${IndexView.Config.formatPrices(
                                        low_prices()
                                    )} đ</span> 
                                </div>  
                            </div>
                        </div>`;
        },
    },
    NewProduct: {
        render(data) {
            Object.entries(data).map(([typeProduct, productList]) => {
                productList.map((item) => {
                    $(`#product-list-${typeProduct}`).append(`
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            ${View.Product.Template(item)}
                        </div>
                    `);
                });
            });
        },
    },
    init() {},
};
(() => {
    View.init();
    async function init() {
        await GetNewProduct();
    }

    async function GetNewProduct() {
        await Api.Product.GetNewProduct()
            .done((res) => {
                View.NewProduct.render(res.data);
            })
            .fail((err) => {})
            .always(() => {});
    }

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
    init();
})();
