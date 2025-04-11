$("a[un-like]").each(function () {
    $(this).on("click", async function () {
        product_detail_id = $(this).attr("un-like");
        member_id = $("input#member_id").val();
        contentType = "application/json; charset=utf-8";
        urlApi = "/api/favourites/remove-favourite";
        body = {
            favourite_id: member_id + product_detail_id,
        };
        responseData = await callAjaxReturnJson(
            urlApi,
            "POST",
            body,
            contentType
        );

        if (responseData.data == true) {
            showPopup(
                "Thành công",
                "Loại bỏ sản phẩm khỏi danh sách yêu thích thành công",
                "success"
            );
            $(this).closest("div.favourite-body").remove();
            if ($("a[un-like]").length < 1) {
                $(".title-favourite").siblings().remove();
                $(".title-favourite").after(
                    "<p>Danh sách trống, vui lòng thêm sản phẩm vào danh sách yêu thích</p>"
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
});
