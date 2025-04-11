load_bill_detail = () =>
    $("button[name=rate_product]").on("click", async function () {
        urlApi = "/api/rates/save-rate";
        let body = {
            member_id: $("input#member_id").val(),
            product_id: $(this).attr("product_id"),
            bill_id: $(this).attr("bill_id"),
            star: $("input#input-star").val(),
            comment: $("#comment").val(),
        };
        let contentType = "application/json; charset=utf-8";

        let responseData = await callAjaxReturnJson(
            urlApi,
            "POST",
            body,
            contentType
        );

        if (responseData.data != null) {
            showPopup("Thành công", "Đánh giá sản phẩm thành công", "success");
            $("button.close").click();
        } else {
            showPopup(
                "Xin lỗi",
                "Hệ thống đang bị gián đoạn, vui lòng thử lại sau",
                "error"
            );
        }
    });

load_event = () =>
    $("button.btn-billDetail").each(function () {
        $(this).on("click", async function () {
            bill_id = $(this).attr("bill_id");
            urlApi =
                "/purchase-history-detail-render" +
                getParameterURL("?bill_id=", bill_id, null, null);

            await callAjaxReturnHtml(urlApi, $("div#bill_detail"));
            load_bill_detail();
        });
    });

load_event_cancel = () =>
    $("button[name=remove_bill]").on("click", async function () {
        urlApi = "/api/bills/update-status-bill";
        let body = {
            bill_id: $(this).attr("bill_id"),
            status: -2,
            message: $("textarea#message").val(),
        };

        let contentType = "application/json; charset=utf-8";
        let responseData = await callAjaxReturnJson(
            urlApi,
            "POST",
            body,
            contentType
        );

        if (responseData.data != null) {
            showPopup(
                "Thành công",
                "Bạn đã huỷ đơn hàng thành công",
                "success"
            );
            $(this).closest(".purchaseHistory-body-content").remove();

            if (
                $("#waiting_confirm > .purchaseHistory-body-content").length < 1
            ) {
                $("#waiting_confirm").append(
                    '  <div class="tab-content-none">Danh sách trống </div>'
                );
            }
        } else {
            showPopup(
                "Xin lỗi",
                "Hệ thống đang bị gián đoạn, vui lòng thử lại sau",
                "error"
            );
        }
    });

load_event();
load_event_cancel();

$("input[type=radio]").on("change", async function () {
    $value = $(this).val();
    $type = $value.split(" ")[0];
    $status = $value.split(" ")[1];
    tagAppend = "div#" + $type;

    urlReplace =
        window.location.pathname +
        getParameterURL("?status=", $status, null, null);

    urlApi =
        "/purchase-history-render" +
        getParameterURL("?status=", $status, null, null);

    await callAjaxReturnHtml(urlApi, $(tagAppend), urlReplace);

    load_event();
    load_event_cancel();
});
