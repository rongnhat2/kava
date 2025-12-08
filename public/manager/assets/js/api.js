const Api = {
    Auth: {},
    Account: {},
    Transaction: {},

    Image: {},
};
(() => {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        crossDomain: true,
    });
})();

//Auth
(() => {
    Api.Auth.Login = (data) =>
        $.ajax({
            url: `/api/admin/auth/login`,
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
        });
})();

//Manager
(() => {
    Api.Account.GetAll = () =>
        $.ajax({
            url: `/api/admin/account/get`,
            method: "GET",
        });
})();

//Transaction
(() => {
    Api.Transaction.GetAll = () =>
        $.ajax({
            url: `/api/admin/transaction/get`,
            method: "GET",
        });
})();
