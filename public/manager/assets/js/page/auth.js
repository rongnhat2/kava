const View = {
    Auth: {
        Login: {
            resource: "#login",
            getVal() {
                const resource = this.resource;
                const fd = new FormData();
                const data_email = $(`${resource}`).find("#email").val();
                const data_password = $(`${resource}`).find("#password").val();

                if (
                    !IndexView.Config.isEmail(data_email) ||
                    !data_email ||
                    !data_password
                ) {
                    return false;
                }

                fd.append("data_email", data_email);
                fd.append("data_password", data_password);

                return fd;
            },
            onPush(name, callback) {
                const resource = this.resource;
                $(document).on(
                    "click",
                    `${resource} .form-submit`,
                    function () {
                        if ($(this).attr("atr").trim() === name) {
                            const data = View.Auth.Login.getVal();
                            if (data) callback(data);
                        }
                    }
                );
            },
            init() {
                $(document).on("keypress", `.data-phone`, (event) =>
                    IndexView.Config.onNumberKey(event)
                );
            },
        },
        response: {
            success(message) {
                $(".js-validate .js-response").remove();
                $(".js-validate").prepend(
                    `<div class="js-response js-success"><li>${message}</li></div>`
                );
            },
            error(message) {
                $(".js-validate .js-response").remove();
                $(".js-validate").prepend(
                    `<div class="js-response js-errors"><li>${message}</li></div>`
                );
            },
        },
        init() {
            View.Auth.Register.init();
        },
    },
    init() {
        $(document).on("keypress", `.number-type`, (event) =>
            IndexView.Config.onNumberKey(event)
        );
    },
};
(() => {
    View.init();
    View.Auth.Login.onPush("Login", (fd) => {
        Api.Auth.Login(fd)
            .done((res) => {
                if (res.status === 500) {
                    View.Auth.response.error(res.message);
                } else {
                    View.Auth.response.success(res.message);
                    redirect_logined("/admin");
                }
            })
            .fail((err) => {
                View.Auth.response.error("An error occurred during login");
            });
    });

    const delay = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
    async function redirect_logined(url) {
        await delay(500);
        window.location.replace(url);
    }
})();
