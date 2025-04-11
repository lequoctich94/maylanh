function logout() {
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    $.ajax({
        type: "POST",
        url: "/admin/logout",
        headers: headers,
        success: function (data) {
            window.location.href = "/admin/login";
        },
    });
}

function callAjaxWithMethod(urlApi, method) {
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    $.ajax({
        type: method,
        url: urlApi,
        headers: headers,
        success: function (data) {
            return data;
        },
    });
}
