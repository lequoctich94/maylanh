$("button.btn-change-profile").on("click", async function () {
    let body = {
        username: $("input[name=username]").val(),
        is_checked: 5,
        full_name: $("input[name=full_name]").val(),
        email: $("input[name=email]").val(),
        birth_day: $("input[name=birth_day]").val(),
        address: $("input[name=address]").val(),
    };

    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    let contentType = "application/json; charset=utf-8";
    urlApi = "/change-profile";
    let responseData = await callAjaxReturnJson(
        urlApi,
        "POST",
        body,
        contentType,
        headers
    );

    if (responseData == 1) {
        showPopup("Thành công", "Cập nhật thành công", "success");
        $(".full-name-user").text($("input[name=full_name]").val());
        $(".email-user").text($("input[name=email]").val());
    } else if (responseData == 0) {
        showPopup(
            "Thất bại",
            "Cập nhật thất bại, vui lòng thử lại sau",
            "error"
        );
    } else {
        showPopup(
            "Xin lỗi",
            "Hệ thống đang bị gián đoạn vui lòng thử lại sau",
            "error"
        );
    }
});

$("button.btn-change-password").on("click", async function () {
    new_password = $("input[name=password_new]").val();
    re_new_password = $("input[name=re_password_new]").val();
    confirmPassword = $("input[name=password_old]").val();
    if (new_password != re_new_password) {
        showPopup(
            "Thất bại",
            "Mật khẩu không trùng khớp, vui lòng nhập lại",
            "error"
        );
        return;
    }

    let body = {
        username: $("input[name=username]").val(),
        confirmPassword: confirmPassword,
        newPassword: new_password,
    };

    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    let contentType = "application/json; charset=utf-8";
    urlApi = "/change-password";
    let responseData = await callAjaxReturnJson(
        urlApi,
        "POST",
        body,
        contentType,
        headers
    );

    if (responseData == 1) {
        showPopup("Thành công", "Cập nhật thành công", "success");
        $("input[name=password_new]").val("");
        $("input[name=re_password_new]").val("");
        $("input[name=password_old]").val("");
    } else if (responseData == 0) {
        showPopup(
            "Thất bại",
            "Mật khẩu cũ không hợp, vui lòng nhập lại",
            "error"
        );
    } else {
        showPopup(
            "Xin lỗi",
            "Hệ thống đang bị gián đoạn, vui lòng thử lại sau",
            "error"
        );
    }
});

$("#fileUpload").on("change", function () {
    file = this.files[0];
    var urlImg = URL.createObjectURL(file);
    $("#upload-img").attr("src", urlImg);
    $(this).attr("is-upload", true);
    $("div.submit-file").removeClass("d-none");
});

$("button#submitUpload").on("click", async function () {
    let file = $("#fileUpload").prop("files")[0];
    let body = new FormData();
    body.append("image", file);
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    urlApi = "/change-avatar";

    let responseData;
    await $.ajax({
        url: urlApi,
        data: body,
        contentType: false,
        processData: false,
        method: "POST",
        headers: headers,
        success: function (data) {
            responseData = data * 1;
        },
    });

    if (responseData == 1) {
        showPopup("Thành công", "Cập nhật hình ảnh thành công", "success");
        var urlImg = URL.createObjectURL(file);
        $("img[name=avatar]").attr("src", urlImg);
        $("#upload-img").attr("src", urlImg);
        $("div.submit-file").addClass("d-none");
    } else if (responseData.data == 0) {
        showPopup("Thất bại", "Cập nhật hình ảnh thất bại", "error");
    } else {
        showPopup("Thất bại", "File không đúng dịnh dạng (PNG, JPG)", "error");
    }
});
