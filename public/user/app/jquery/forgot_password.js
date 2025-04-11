$("button.forgot-password").on("click", async function () {
    status_send = $(this).attr("is-sended");

    if (status_send != "true") {
        //Send code to mail
        send_mail($(this));
    } else {
        confirm_code($(this));
    }
});

send_mail = async function (tagEvent) {
    let body = {
        username: $("input[name=username]").val(),
    };
    let contentType = "application/json; charset=utf-8";
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    urlApi = "/api/users/get-user-by-username-and-status/1";
    let responseData = await callAjaxReturnJson(
        urlApi,
        "POST",
        body,
        contentType,
        headers
    );

    if (responseData.data == null) {
        $("div.error-inline").removeClass("d-none");
        $("span[name=message-error]").text("Số điện thoại không hợp lệ");
    } else {
        $("div.success-inline").removeClass("d-none");
        $("div.confirm-code").removeClass("d-none");
        tagEvent.attr("is-sended", true);
        tagEvent.text("Xác nhận mã");
    }
};

confirm_code = async function (tagEvent) {
    let body = {
        username: $("input[name=username]").val(),
        code: $("input[name=confirm_code]").val(),
    };
    let contentType = "application/json; charset=utf-8";
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    urlApi = "/api/users/confirm-code";
    let responseData = await callAjaxReturnJson(
        urlApi,
        "POST",
        body,
        contentType,
        headers
    );

    if (responseData.data == 1) {
        showPopup("Thành công", "Nhập mã xác nhận thành công", "success");
        tagEvent.attr("type", "submit");
        $("form#form-forgot-password").submit();
    } else if (responseData.data == 0) {
        showPopup("Thất bại", "Mã xác nhật đã hết hạn", "error");
    } else {
        showPopup("Thất bại", "Mã xác nhật không hợp lệ", "error");
    }
};
