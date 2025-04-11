var member_id = $("input#member_id").val();
var contentType = "application/json; charset=utf-8";

reloadCartData();
//######## Handle remove product in to cart ##########
$("a[remove-product-to-cart]").on("click", async function () {
    let cart_id = $(this).parent().parent().attr("cart_id");
    let urlApi = "/api/carts/remove-cart";
    let body = {
        cart_id: cart_id,
    };
    try {
        let responseData = await callAjaxReturnJson(
            urlApi,
            "POST",
            body,
            contentType
        );

        if (responseData.data == true) {
            //Remove row selected
            $(this).parent().parent().remove();

            //Update quantity into cart on header
            quantityIntoCart =
                $("span#quantity-into-cart-1").text().trim() * 1 - 1;
            $("span#quantity-into-cart-1").text(quantityIntoCart);
            $("span#quantity-into-cart-2").text(quantityIntoCart);

            reloadCartData();

            if ($("a[remove-product-to-cart]").length < 1) {
                $("tbody").append(
                    '  <tr class="is-emtpy tbody-tr"><td colspan="9"> <p class="text-center">Danh sách trống, vui lòng nhập thêm sản phẩm</p></td></tr>'
                );
            }
        }
    } catch (error) {
        showPopup(
            "Xin lỗi",
            "Hệ thống đang bị gián đoạn, vui lòng thử lại sau",
            "error"
        );
    }
});

//######## Handle remove all product in to cart ##########
$("a.btn-delete").on("click", async function () {
    if ($("tr#is-empty").length > 0) {
        showPopup(
            "Thất bại",
            "Danh sách trống vui lòng thêm giỏ hàng",
            "error"
        );
        return;
    }
    let urlApi = "/api/carts/remove-all-cart";
    let body = {
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
            showPopup("Thành công", "Xoá giỏ hàng thành công", "success");

            $("tbody >").remove();
            $("tbody").append(
                '  <tr class="is-emtpy tbody-tr"><td colspan="9"> <p class="text-center">Danh sách trống, vui lòng nhập thêm sản phẩm</p></td></tr>'
            );
            //Remove voucher
            $(".cart-topVoucher-number").text("0 VNĐ");
            $("button#btn-chooseVoucher").text("Chọn mã khuyến mãi");
            $("button[voucher-id]").val("");

            //Remove quantity into cart on header
            quantityIntoCart = 0;
            $("span#quantity-into-cart-1").text(quantityIntoCart);
            $("span#quantity-into-cart-2").text(quantityIntoCart);

            //Remove footer payment
            $(".cart-totalPrice").text("0 VNĐ");
            $(".cart-check span").text("Chọn tất cả (0)");
            $(".cart-check input").prop("checked", false);

            reloadCartData();
        }
    } catch (error) {
        showPopup(
            "Xin lỗi",
            "Hệ thống đang bị gián đoạn, vui lòng thử lại sau",
            "error"
        );
    }
});

//##### Handle for input UP & DOWN & enter value ######
$(".quantity").each(function () {
    var spinner = $(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find("#stepUp"),
        btnDown = spinner.find("#stepDown"),
        min = input.attr("min"),
        max = input.attr("max");

    var urlApi = "/api/carts/update-quantity-in-cart";

    input.on("blur", async function () {
        if (input.val() == "") {
            newVal = 1;
        } else {
            newVal = input.val() * 1;
        }

        if (newVal == 0) {
            input
                .closest("td")
                .siblings()
                .find("a[remove-product-to-cart]")
                .click();
            return;
        }

        let oldValue = input.attr("oldValue") * 1;
        let cart_id = $(this).parent().parent().parent().attr("cart_id");
        let body = {
            cart_id: cart_id,
            quantity: newVal,
        };
        try {
            var responseData = await callAjaxReturnJson(
                urlApi,
                "POST",
                body,
                contentType
            );

            if (responseData.data == -1) {
                showPopup(
                    "Thất bại",
                    "Số lượng sản phẩm trong không đủ",
                    "error"
                );
                input.val(oldValue);
            } else {
                input.val(newVal);
                input.trigger("change");

                reloadCartData();
            }
        } catch (error) {
            showPopup(
                "Xin lỗi",
                "Hệ thống đang bị gián đoạn, vui lòng thử lại sau",
                "error"
            );
        }
    });

    //Up value number
    btnUp.click(async function () {
        let currentValue = parseFloat(input.val());

        if (currentValue >= max) {
            var newVal = currentValue;
        } else {
            var newVal = currentValue + 1;
        }
        let cart_id = $(this).parent().parent().parent().attr("cart_id");
        let body = {
            cart_id: cart_id,
            quantity: newVal,
        };
        try {
            let responseData = await callAjaxReturnJson(
                urlApi,
                "POST",
                body,
                contentType
            );

            if (responseData.data == -1) {
                showPopup(
                    "Thất bại",
                    "Số lượng sản phẩm trong không đủ",
                    "error"
                );
            } else if (responseData.data == 0) {
                showPopup(
                    "Thất bại",
                    "Bạn thao tác quá nhanh, vui lòng thử lại sau",
                    "error"
                );
            } else {
                input.val(newVal);
                input.attr("oldValue", newVal);
                input.trigger("change");
                reloadCartData();
            }
        } catch (error) {
            showPopup(
                "Xin lỗi",
                "Hệ thống đang bị gián đoạn, vui lòng thử lại sau",
                "error"
            );
        }
    });

    //Down value number
    btnDown.click(async function () {
        let currentValue = parseFloat(input.val());

        if (currentValue <= min) {
            var newVal = currentValue;
        } else {
            var newVal = currentValue - 1;
        }

        if (currentValue == 1) {
            return;
        }
        let cart_id = $(this).parent().parent().parent().attr("cart_id");
        let body = {
            cart_id: cart_id,
            quantity: newVal,
        };
        try {
            let responseData = await callAjaxReturnJson(
                urlApi,
                "POST",
                body,
                contentType
            );
            if (responseData.data == 0) {
                showPopup(
                    "Thất bại",
                    "Bạn thao tác quá nhanh, vui lòng thử lại sau",
                    "error"
                );
                return;
            }
            input.val(newVal);
            input.attr("oldValue", newVal);
            input.trigger("change");
            reloadCartData();
        } catch (error) {
            showPopup(
                "Thất bại",
                "Bạn thao tác quá nhanh, vui lòng thử lại sau",
                "error"
            );
        }
    });
});

//Handle click checked select one product
$("input[isSelected]").on("change", function () {
    reloadCartData();
});

//Handle click checkbox select all product
$("input[isAllSelected]").on("change", function () {
    function handleCheckedInput(value) {
        $("tr.tbody-tr").each(function () {
            cartData = $(this);
            cartData.find("input[isSelected]").prop("checked", value);
        });
    }

    if ($("input[isAllSelected]").prop("checked")) {
        handleCheckedInput(true);
    } else {
        handleCheckedInput(false);
        uploadStateVoucher(0);
    }

    reloadCartData();
});

//Handle click open modal voucher
$("button.btn-chooseVoucher").on("click", function () {
    if ($("span[number-selected]").attr("number-selected") * 1 == 0) {
        showPopup(
            "Thất bại",
            "Vui lòng chọn sản phẩm trước khi chọn Voucher",
            "error"
        );
        $("#chooseVoucher").modal("hide");
    } else {
        uploadStateVoucher(0);
        updateValueAndText(
            $("p.price-discount"),
            "price-discount",
            0,
            "(-" + number_format(0, 0, ".", ",") + "đ)"
        );
        reloadCartData();
        $("#chooseVoucher").modal("show");
    }
});

//###### Handle select voucher ######
$("button.btn-chooseVoucherDetail").each(function () {
    var voucherSelected = $(this);
    $(voucherSelected).on("click", () => {
        voucher_id = $(voucherSelected).attr("voucher-id");
        max_price = $(voucherSelected).attr("max-price") * 1;
        sale_off = $(voucherSelected).attr("sale-off") * 1;
        totalAllPrice = $("p.total-all-price").attr("total-all-price") * 1;

        let valueDiscount =
            totalAllPrice * sale_off >= max_price
                ? max_price
                : totalAllPrice * sale_off;

        uploadStateVoucher(valueDiscount);
        reloadCartData();
    });
});

//Update state component voucher
function uploadStateVoucher(valueDiscount) {
    $("span[value-voucher-selected]").text(
        number_format(valueDiscount, 0, ".", ",") + "đ"
    );

    $("span[value-voucher-selected]").attr(
        "value-voucher-selected",
        valueDiscount
    );
    if (valueDiscount != 0) {
        updateValueAndText(
            $("button[voucher-selected]"),
            "voucher-selected",
            voucher_id,
            voucher_id
        );
    } else {
        updateValueAndText(
            $("button[voucher-selected]"),
            "voucher-selected",
            "",
            "Chọn mã khuyến mãi"
        );
    }
}

//Reload data for table cart
function reloadCartData() {
    let totalAllPrice = 0;
    let totalSelected = 0;
    let totalRecord = 0;

    //Loop element in table and handle reload data
    $("tr.tbody-tr").each(function () {
        if ($(this).find("td").find("input[type=checkbox]").length > 0) {
            totalRecord++;
        }
        cartData = $(this);
        isActive = cartData.find("input[isSelected]").prop("checked");
        price_pay = cartData.find("td.price").attr("price_pay") * 1;
        quantity = cartData.find("input[type=number]").val() * 1;
        total_price = price_pay * quantity;
        total_price_fomart = number_format(total_price, 0, ".", ",");
        cartData.find("td.totalPrice").text(total_price_fomart + "đ");
        if (isActive) {
            totalSelected++;
            totalAllPrice += total_price;
        }
    });

    //Handle total price when select voucher
    value_voucher =
        $("span[value-voucher-selected]").attr("value-voucher-selected") * 1;
    if (totalAllPrice != 0 && value_voucher > 0) {
        totalAllPrice -= value_voucher;
        updateValueAndText(
            $("p.price-discount"),
            "price-discount",
            value_voucher,
            "(-" + number_format(value_voucher, 0, ".", ",") + "đ)"
        );
    } else {
        //Case unchecked elemnt last => change to no select product then reload state voucher
        uploadStateVoucher(0);
        updateValueAndText(
            $("p.price-discount"),
            "price-discount",
            0,
            "(-" + number_format(0, 0, ".", ",") + "đ)"
        );
    }

    //Update total price
    updateValueAndText(
        $("p.total-all-price"),
        "total-all-price",
        totalAllPrice,
        number_format(totalAllPrice, 0, ".", ",") + "đ"
    );

    //Update number select into cart
    updateValueAndText(
        $("span[number-selected]"),
        "number-selected",
        totalSelected,
        "Chọn tất cả (" + totalSelected + ")"
    );

    //Upload check box "Select All"
    if (totalRecord == totalSelected && totalSelected != 0) {
        $("input[isAllSelected]").prop("checked", true);
    } else {
        $("input[isAllSelected]").prop("checked", false);
    }
}

function updateValueAndText(tag, nameAttr, value, text) {
    tag.text(text);
    tag.attr(nameAttr, value);
}

$("a.button-default").on("click", async function () {
    let carts_id_selected = [];

    $("tr.tbody-tr").each(function () {
        isActive = $(this).find("input[isSelected]").prop("checked");
        if (isActive) {
            cart_id_selected = $(this).attr("cart_id");
            carts_id_selected.push(cart_id_selected);
        }
    });

    if (carts_id_selected.length < 1) {
        showPopup("Thất bại", "Vui lòng chọn sản phẩm!", "error");
        return;
    }

    voucherId = $("button.btn-chooseVoucher").attr("voucher-selected");
    let voucherData = null;
    if (voucherId.length > 0) {
        voucherData = {
            voucher_id: voucherId,
            value_voucher:
                $("span[value-voucher-selected]").attr(
                    "value-voucher-selected"
                ) * 1,
        };
    }

    let body = {
        cartData: {
            currentStep: "user/payment-shipping",
            cartIdsSelected: carts_id_selected,
            voucher: voucherData,
            infoPayer: null,
            discountIds: [],
            payment: null,
            totalPrice: null,
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
        window.location.href = "/payment-shipping";
    } else {
        showPopup(
            "Xin lỗi",
            "Hệ thống đang bị gián đoạn, vui lòng thử lại sau",
            "error"
        );
    }
});
