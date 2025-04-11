var member_id = $("input#member_id").val();
var contentType = "application/json; charset=utf-8";
//##### Handle select address
function loadEvent() {
    $("button.btn-chooseAddressDetail").each(function () {
        $(this).on("click", function () {
            let address = $(this)
                .parent()
                .parent()
                .find("textarea[name=address]")
                .text();
            $("span[address]").text(address);
            $("span[address]").attr("address", address);
        });
    });
}

//#### Handle select city get district
$("select[name=city-select]").on("change", async function () {
    var citiId = $("select[name=city-select] option:selected").val();

    districtSelect = $("select[name=district-select]");
    commnueSelect = $("select[name=commune-select]");
    tagOption =
        '<option value="none" selected disable>--- Vui lòng chọn Huyện ---</option>';
    if (citiId != "none") {
        url = "/api/addresses/get-all-district-vn-by-city-id/" + citiId;
        responseData = await callAjaxReturnJson(url, "get");

        responseData.data.forEach((element) => {
            tag =
                '<option value="' +
                element.idDistrict +
                '">' +
                element.name +
                "</option>";
            tagOption += tag;
        });
    }
    commnueSelect.find(">").remove();
    commnueSelect.append(
        '<option value="none" selected disable>--- Vui lòng chọn Quận ---</option>'
    );
    districtSelect.find(">").remove();
    districtSelect.append(tagOption);
});

//##### Handle select district get commune
$("select[name=district-select]").on("change", async function () {
    var districtId = $("select[name=district-select] option:selected").val();
    commnueSelect = $("select[name=commune-select]");

    tagOption =
        '<option value="none" selected disable>--- Vui lòng chọn Quận ---</option>';
    if (districtId != "none") {
        url = "/api/addresses/get-all-commune-vn-by-district-id/" + districtId;
        responseData = await callAjaxReturnJson(url, "get");

        responseData.data.forEach((element) => {
            tag =
                '<option value="' +
                element.idCommune +
                '">' +
                element.name +
                "</option>";
            tagOption += tag;
        });
    }
    commnueSelect.find(">").remove();
    commnueSelect.append(tagOption);
});

//#### Handle create addres
$("button.btn-add-address").on("click", async function () {
    if ($("input[name=info-detail]").val() == "") {
        showPopup("Thất bại", "Vui lòng nhập số nhà/đường", "error");
        return;
    }
    let urlApi = "/api/addresses/save-address";
    let body = {
        info_detail: $("input[name=info-detail]").val(),
        city: $("select[name=district-select] option:selected").text(),
        district: $("select[name=district-select] option:selected").text(),
        commune: $("select[name=commune-select] option:selected").text(),
        member_id: member_id,
    };

    try {
        let responseData = await callAjaxReturnJson(
            urlApi,
            "POST",
            body,
            contentType
        );

        if (responseData.data == true) {
            showPopup("Thành công", "Thêm địa chỉ thành công", "success");
        } else {
            showPopup(
                "Thất bại",
                "Thêm thất bại vui lòng thử lại sau",
                "error"
            );
        }
    } catch (error) {
        showPopup(
            "Xin lỗi",
            "Hệ thống đang bị gián đoạn vui lòng thử lại sau",
            "error"
        );
    }
});

//#### Handle call address of member
$("button.btn-chooseAddress").on("click", async function () {
    $("#chooseAddress").modal("hide");
    let urlApi =
        "/api/addresses/get-all-address-by-member-id-and-status/" +
        member_id +
        "&1";
    responseData = await callAjaxReturnJson(urlApi, "get");
    let tagAppend = "";
    responseData.data.forEach((element) => {
        let fullAddress =
            element.info_detail +
            ", " +
            element.commune +
            ", " +
            element.district +
            ", " +
            element.city;
        address =
            '<div class="modal-body-address">\
                <i class="fa fa-location-arrow" aria-hidden="true"></i>\
                <div class="modal-body-addressItem">\
                    <textarea type="text" class="modal-body-addressItemText" name="address"\
                        id="address" col="25" rows="5" value=""\
                        readonly>' +
            fullAddress +
            '</textarea>\
                    <div class="modal-body-addressItemButton">\
                    <button type="button" class="btn btn-removeAddressDetail"\
                            data-dismiss="modal">Xoá địa chỉ</button>\
                        <button type="button" class="btn btn-chooseAddressDetail"\
                            data-dismiss="modal">Chọn địa chỉ giao hàng</button>\
                    </div>\
                </div>\
            </div>';
        tagAppend += address;
    });

    $("div.list-address >").remove();
    $("div.list-address").append(tagAppend);
    $("#chooseAddress").modal("show");
    loadEvent();
});

$("button.btn-order").on("click", async function () {
    let infoPayer = {
        shipping_address: $("span[address]").attr("address"),
        shipping_phone: $("input[name=phoneRecipient]").val(),
        reveicer: $("input[name=nameRecipient]").val(),
    };

    console.log(infoPayer);
    console.log($("div[total-payment]").attr("total-payment"));
    let body = {
        cartData: {
            currentStep: "user/payment-successfully",
            infoPayer: infoPayer,
            totalPrice: $("div[total-payment]").attr("total-payment"),
            payment: "0", //pay by cash
        },
    };

    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    urlApi = "/save-checkout-step";
    let responseData = await callAjaxReturnJson(
        urlApi,
        "POST",
        body,
        contentType,
        headers
    );

    if (responseData == true) {
        window.location.href = "/payment-successfully";
    } else {
        showPopup(
            "Xin lỗi",
            "Hệ thống đang bị gián đoạn vui lòng thử lại sau",
            "error"
        );
    }
});

$("button.btn-backCart").on("click", async function () {
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    let body = {
        currentStep: "/cart",
    };
    urlApi = "/back-checkout-step";
    let responseData = await callAjaxReturnJson(
        urlApi,
        "POST",
        body,
        contentType,
        headers
    );
    window.location.href = responseData;
});
