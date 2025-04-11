$("#isAll").click(function () {
    if ($(this).prop("checked") == true) {
        $(".custom_check").each(function () {
            $(this).prop("checked", true);
        });
    } else {
        $(".custom_check").each(function () {
            $(this).prop("checked", false);
        });
    }
});

$(".remove_voucher").on("click", function () {
    $code = $(this).attr("id");
    $(".btn-remove-voucher").attr("id", $code);
});

$(".btn-remove-voucher").on("click", function () {
    $code = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/vouchers/remove-voucher" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            code: $code,
            status: -2,
        },
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            location.reload(false);
        },
        error: function () {},
    });
});

$(".recover_voucher").on("click", function () {
    $code = $(this).attr("id");
    $(".btn-recover-voucher").attr("id", $code);
});

$(".btn-recover-voucher").on("click", function () {
    $code = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/vouchers/remove-voucher" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            code: $code,
            status: 1,
        },
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            location.reload(false);
        },
        error: function () {},
    });
});

$(".btn-update-voucher").on("click", function () {
    $code = $(this).attr("id");
    $.ajax({
        type: "GET",
        url:
            "/api/vouchers/get-voucher-by-code/" +
            $code +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $voucher = data;
            $("#updateVoucher #inputCodeHidden").val($code);
            $("#updateVoucher #inputCode").val($code);
            $("#updateVoucher #inputSaleOff").val($voucher.sale_off);
            $("#updateVoucher #inputMaxPrice").val($voucher.max_price);
            $("#updateVoucher #inputMaxUsed").val($voucher.max_used);
            $("#updateVoucher #inputDateStart").val($voucher.date_start);
            $("#updateVoucher #inputDateEnd").val($voucher.date_end);
        },
        error: function () {},
    });
});

//check validate form add voucher member
$("#addVoucher button.btn-add-voucher").on("click", function () {
    $("#addVoucher .error-voucher").remove();
    $code = $("#addVoucher #inputCode").val();
    $sale_off = $("#addVoucher #inputSaleOff").val();
    $max_price = $("#addVoucher #inputMaxPrice").val();
    $max_used = $("#addVoucher #inputMaxUsed").val();
    $date_start = $("#addVoucher #inputDateStart").val();
    $date_end = $("#addVoucher #inputDateEnd").val();
    $isCheckedElement = document.getElementById("isCheckedElement");

    if (!$code) {
        $("#addVoucher .code").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if (!validateCode($code)) {
        $("#addVoucher .code").append(
            '<p class="error-voucher text-red">Thông tin chỉ chứa kí tự chữ (a-z, A-Z, 0-9)</p>'
        );
        return false;
    }
    if (!$sale_off) {
        $("#addVoucher .sale_off").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if ($sale_off <= 0) {
        $("#addVoucher .sale_off").append(
            '<p class="error-voucher text-red">Vui lòng nhập phần trăm giá giảm (số dương)</p>'
        );
        return false;
    }
    if (!validatePercentPrice($sale_off)) {
        $("#addVoucher .sale_off").append(
            '<p class="error-voucher text-red">Thông tin chỉ chứa số (số dương)</p>'
        );
        return false;
    }
    if (!$max_price) {
        $("#addVoucher .max_price").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if ($max_price <= 0) {
        $("#addVoucher .max_price").append(
            '<p class="error-voucher text-red">Vui lòng nhập số tiền giảm giá(số dương)</p>'
        );
        return false;
    }
    if (!validatePriceData($max_price)) {
        $("#addVoucher .max_price").append(
            '<p class="error-voucher text-red">Thông tin chỉ chứa số</p>'
        );
        return false;
    }
    if (!$max_used) {
        $("#addVoucher .max_used").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if ($max_used <= 0) {
        $("#addVoucher .max_used").append(
            '<p class="error-voucher text-red">Vui lòng chọn đúng số lượng mã khuyến mãi</p>'
        );
        return false;
    }
    if (!$date_start) {
        $("#addVoucher .date_start").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if (!$date_end) {
        $("#addVoucher .date_end").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if ($date_start > $date_end) {
        $("#addVoucher .date_end").append(
            '<p class="error-voucher text-red">Vui lòng chọn lại thời gian mã khuyến mãi</p>'
        );
        return false;
    }
    if (!$isCheckedElement.checked) {
        $("#addVoucher .checked_member").append(
            '<p class="error-voucher text-red">Vui lòng chọn mã khuyến mãi cho người dùng</p>'
        );
        return false;
    }
});

//check validate form add voucher member
$("#updateVoucher button.btn-update-voucher").on("click", function () {
    $("#updateVoucher .error-voucher").remove();
    $sale_off = $("#updateVoucher #inputSaleOff").val();
    $max_price = $("#updateVoucher #inputMaxPrice").val();
    $max_used = $("#updateVoucher #inputMaxUsed").val();
    $date_start = $("#updateVoucher #inputDateStart").val();
    $date_end = $("#updateVoucher #inputDateEnd").val();

    if (!$sale_off) {
        $("#updateVoucher .sale_off").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if ($sale_off <= 0) {
        $("#updateVoucher .sale_off").append(
            '<p class="error-voucher text-red">Vui lòng nhập phần trăm giá giảm(số dương)</p>'
        );
        return false;
    }
    if (!validatePercentPrice($sale_off)) {
        $("#updateVoucher .sale_off").append(
            '<p class="error-voucher text-red">Thông tin chỉ chứa số</p>'
        );
        return false;
    }
    if (!$max_price) {
        $("#updateVoucher .max_price").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if ($max_price <= 0) {
        $("#updateVoucher .max_price").append(
            '<p class="error-voucher text-red">Vui lòng nhập số tiền giảm giá(số dương)</p>'
        );
        return false;
    }
    if (!validatePriceData($max_price)) {
        $("#updateVoucher .max_price").append(
            '<p class="error-voucher text-red">Thông tin chỉ chứa số</p>'
        );
        return false;
    }
    if (!$max_used) {
        $("#updateVoucher .max_used").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if ($max_used <= 0) {
        $("#updateVoucher .max_used").append(
            '<p class="error-voucher text-red">Vui lòng chọn đúng số lượng mã khuyến mãi</p>'
        );
        return false;
    }
    if (!$date_start) {
        $("#updateVoucher .date_start").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if (!$date_end) {
        $("#updateVoucher .date_end").append(
            '<p class="error-voucher text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if ($date_start > $date_end) {
        $("#updateVoucher .date_end").append(
            '<p class="error-voucher text-red">Vui lòng chọn lại thời gian mã khuyến mãi</p>'
        );
        return false;
    }
});
