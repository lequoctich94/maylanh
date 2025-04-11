$("button.btn-confirm-bill").on("click", function () {
    $bill_id = $("input#bill_id").val();
    $.ajax({
        type: "post",
        url:
            "/api/bills/update-status-bill" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            bill_id: $bill_id,
            status: $(this).attr("value") * 1,
        },
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            window.location.href =
                window.location.origin + "/admin/bill-pay-management";
        },
        error: function () {},
    });
});

//Từ chối
$("button.btn-refuse-bill").on("click", function () {
    $bill_id = $("input#bill_id").val();
    $.ajax({
        type: "post",
        url:
            "/api/bills/update-status-bill" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            bill_id: $bill_id,
            status: -4,
            message: $("textarea#message").val(),
        },
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            window.location.href =
                window.location.origin + "/admin/bill-pay-management";
        },
        error: function () {},
    });
});

//Đã giao
$("button.btn-delivered-bill").on("click", function () {
    $bill_id = $("input#bill_id").val();
    $.ajax({
        type: "post",
        url:
            "/api/bills/update-status-bill" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            bill_id: $bill_id,
            status: 1,
        },
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            window.location.href =
                window.location.origin + "/admin/bill-pay-management";
        },
        error: function () {},
    });
});
