// ####### Handle to Up - to Down quantity add product to cart ######
jQuery(
    '<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>'
).insertAfter(".quantity input");
jQuery(".quantity").each(function () {
    var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find(".quantity-up"),
        btnDown = spinner.find(".quantity-down"),
        min = input.attr("min"),
        max = input.attr("max");

    btnUp.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    btnDown.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    input.on("blur", function () {
        if ($(this).val() * 1 == 0) {
            $(this).val(1);
        }
    });
});

var firstSelect = "";
var itemSelected = "";
var isClickedColor;
var isClickedSize;
// ####### Handle select color show size product #######
$("button.color-selectItem").each(function () {
    $(this).on("click", async function (e) {
        if (isClickedColor == this) {
            return;
        }
        isClickedColor = this;

        if ("color" == firstSelect) {
            $("button.size-selectItem").removeClass("size-selectItem-active");
        }
        $("button.color-selectItem").removeClass("color-selectItem-active");
        $(this).addClass("color-selectItem-active");

        color_id = $(this).attr("color_id");
        product_id = getUrlParameter("searchID");
        size_id = $("button.size-selectItem-active").attr("size_id");

        //Select color first
        if (size_id == undefined) {
            firstSelect = "color";
            $("button.size-selectItem").removeClass("size-selectItem-active");
            urlApi =
                "/api/sizes/get-all-size-by-id-product-and-id-color-and-status/" +
                product_id +
                "&" +
                color_id +
                "&1";

            let responseData = await callAjaxReturnJson(urlApi, "get");
            let tag = $("button.size-selectItem");
            let type = "size";

            handleBlockElementNotExist(tag, type, responseData.data);
            if (itemSelected != "") {
                tag = $("button[size_id=" + itemSelected + "]");
                reActiveElement(itemSelected, tag, type);
            }
        } else {
            itemSelected = color_id;
            //common cho nay
            product_detail_id = product_id + "_" + size_id + "_" + color_id;
            console.log(product_detail_id);
            urlApi =
                "/api/stock-details/get-product-detail-in-stock-by-product-detail-id-and-status/" +
                product_detail_id +
                "&1";
            responseData = await callAjaxReturnJson(urlApi, "get");

            updateUIProductDetail(
                responseData.data.quantity,
                responseData.data.price_pay,
                responseData.data.quantity_pay,
                responseData.data.quantity_rate,
                responseData.data.avg_star
            );
        }
    });
});

// ####### Handle select size show quantity product in stock #######
$("button.size-selectItem").each(function () {
    $(this).on("click", async function () {
        if (isClickedSize == this) {
            return;
        }
        isClickedSize = this;

        if ("size" == firstSelect) {
            $("button.color-selectItem").removeClass("color-selectItem-active");
        }
        $("button.size-selectItem").removeClass("size-selectItem-active");
        $(this).addClass("size-selectItem-active");

        color_id = $("button.color-selectItem-active").attr("color_id");
        product_id = getUrlParameter("searchID");
        size_id = $(this).attr("size_id");

        //Select size first
        if (color_id == undefined) {
            firstSelect = "size";
            $("button.color-selectItem").removeClass("color-selectItem-active");
            urlApi =
                "/api/colors/get-all-color-by-product-id-and-size-id-and-status-in-stock/" +
                product_id +
                "&" +
                size_id +
                "&1";

            let responseData = await callAjaxReturnJson(urlApi, "get");
            let tag = $("button.color-selectItem");
            let type = "color";

            handleBlockElementNotExist(tag, type, responseData.data);
            if (itemSelected != "") {
                tag = $("button[color_id=" + itemSelected + "]");
                reActiveElement(itemSelected, tag, type);
            }
        } else {
            itemSelected = size_id;
            product_detail_id = product_id + size_id + color_id;
            urlApi =
                "/api/stock-details/get-product-detail-in-stock-by-product-detail-id-and-status/" +
                product_detail_id +
                "&1";
            responseData = await callAjaxReturnJson(urlApi, "get");

            updateUIProductDetail(
                responseData.data.quantity,
                responseData.data.price_pay,
                responseData.data.quantity_pay,
                responseData.data.quantity_rate,
                responseData.data.avg_star
            );
        }
    });
});

function handleBlockElementNotExist(tag, type, responseData) {
    tag.prop("disabled", true);
    tag.addClass("block-item");
    responseData.forEach((element) => {
        if ("color" == type) {
            item = $("button[color_id=" + element.color_id + "]");
        } else {
            item = $("button[size_id=" + element.size_id + "]");
        }

        if (item.length > 0) {
            item.prop("disabled", false);
            item.removeClass("block-item");
        }
    });
}

function reActiveElement(itemSelected, tag, type) {
    //Check if element second is not disabled (can use) re-active
    if (itemSelected != "" && !tag.is(":disabled")) {
        if (type == "size") {
            isClickedSize = $(tag);
            isClickedSize.click();
        } else {
            isClickedColor = $(tag);
            isClickedColor.click();
        }
    } else {
        //Update text quantity product in stock
        $("span#quantity-into-stock").text(
            "Vui lòng chọn chi tiết để xem thông tin"
        );
    }
}

function updateUIProductDetail(
    quantity_stock,
    price_pay,
    quantity_pay,
    quantity_rate,
    avg_star
) {
    $("span.avg_star").text(number_format(avg_star, 1, ".", ","));
    $("span.quantity_rate").text(quantity_rate);
    $("span.quantity_pay").text(quantity_pay);
    $("span#quantity-into-stock").text(quantity_stock + " hiện có");
    $("input[name=price_pay]").val(price_pay);
    $("div.item-price")
        .find("p")
        .text(number_format(price_pay, 0, ",", ".") + " VNĐ");
}

//####### Check quantity product in stock #######
async function checkQuantityProductInStock(product_detail_id, quantity) {
    //common cho nay
    urlApi =
        "/api/stock-details/check-quantity-product-detail-in-stock/" +
        product_detail_id +
        "&" +
        quantity;
    responseData = await callAjaxReturnJson(urlApi, "GET");

    return responseData.data;
}

//####### Handle save and update quantity product in stock #######
async function handleSaveAndUpdateProductInToCart(statusLogin) {
    //If not login -> redirect url login
    if (statusLogin == "false") {
        showPopup(
            "Thất bại",
            "Bạn chưa đăng nhập, vui lòng hãy thực hiện đăng nhập",
            "error"
        );
        window.location.href = "/login";
        return "";
    } else {
        color_id = $("button.color-selectItem-active").attr("color_id");
        if (
            !validationSelectShowAlert(color_id, "Vui lòng chọn màu sản phẩm")
        ) {
            return "";
        }

        size_id = $("button.size-selectItem-active").attr("size_id");
        if (
            !validationSelectShowAlert(
                size_id,
                "Vui lòng chọn kích thước sản phẩm"
            )
        ) {
            return "";
        }

        product_id = getUrlParameter("searchID");
        //common cho nay
        product_detail_id = product_id + "_" + size_id + "_" + color_id;
        member_id = $("input#member_id").val();
        quantity = $("input[name=quantity-buy]").val() * 1;
        price_pay = $("input[name=price_pay]").val() * 1;

        //Check quantity in stock
        responseData = await checkQuantityProductInStock(
            product_detail_id,
            quantity
        );

        if (!responseData) {
            showPopup(
                "Thất bại",
                "Sản phẩm vượt quá số lượng trong kho, vui lòng thử lại",
                "error"
            );
            return "";
        }

        contentType = "application/json; charset=utf-8";
        urlApi = "/api/carts/save-and-update-cart";
        body = {
            product_detail_id: product_detail_id,
            member_id: member_id,
            quantity: quantity,
            price_pay: price_pay,
        };
        responseData = await callAjaxReturnJson(
            urlApi,
            "POST",
            body,
            contentType
        );

        return responseData;
    }
}

//####### Handle action click button add product to cart #######
$("button#add-product-to-cart").on("click", async function () {
    responseData = await handleSaveAndUpdateProductInToCart(
        $(this).attr("status-login")
    );

    //Validation
    if (responseData == "") {
        return;
    }

    if (responseData.status == "U") {
        showPopup(
            "Thành công",
            "Cập nhật số lượng sản phẩm thành công",
            "success"
        );
    } else if (responseData.status == "C") {
        quantityIntoCart = $("span#quantity-into-cart-1").text().trim() * 1 + 1;

        $("span#quantity-into-cart-1").text(quantityIntoCart);
        $("span#quantity-into-cart-2").text(quantityIntoCart);
        showPopup(
            "Thành công",
            "Thêm sản phẩm vào giỏ hàng thành công",
            "success"
        );
    } else {
        showPopup("Thất bại", "Thêm sản phẩm vào giỏ hàng thất bại", "error");
    }
    $("input[name=quantity-buy]").val(1);
});

//####### Handle action click button buy product to cart #######
$("button#buy-product").on("click", async function () {
    responseData = await handleSaveAndUpdateProductInToCart(
        $(this).attr("status-login")
    );

    //Validation
    if (responseData == "") {
        return;
    }

    if (responseData.status != "E") {
        window.location.href = "/cart";
    } else {
        showPopup("Thất bại", "Thêm sản phẩm vào giỏ hàng thất bại", "error");
    }
});
loadEventFavourite();

function loadEventFavourite() {
    $("a[un-like]").on("click", async function () {
        if ($("li[status-login]").attr("status-login") == "false") {
            alert("Bạn chưa đăng nhập, vui lòng hãy thực hiện đăng nhập");
            window.location.href = "/login";
            return "";
        }
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

        if (responseData.data == 1) {
            showPopup(
                "Thành Công",
                "Sản phẩm đã được loại bỏ khỏi danh sách yêu thích",
                "success"
            );
            $("#status-favourite >").remove();
            $("#status-favourite").append(
                '<a href="javascript:void(0)" like="' +
                    product_detail_id +
                    '" title="Chưa yêu thích sản phẩm">\
                <i class="fa fa-heart" style="color:rgb(223, 223, 223);">\
                </i>\
                </a>'
            );
            loadEventFavourite();
        } else {
            showPopup(
                "Thành Công",
                "Sản phẩm đã được loại bỏ khỏi danh sách yêu thích",
                "success"
            );
        }
    });

    $("a[like]").on("click", async function () {
        if ($("li[status-login]").attr("status-login") == "false") {
            alert("Bạn chưa đăng nhập, vui lòng hãy thực hiện đăng nhập");
            window.location.href = "/login";
            return "";
        }
        product_detail_id = $(this).attr("like");
        member_id = $("input#member_id").val();
        contentType = "application/json; charset=utf-8";
        urlApi = "/api/favourites/save-favourite";
        body = {
            product_detail_id: product_detail_id,
            member_id: member_id,
        };
        responseData = await callAjaxReturnJson(
            urlApi,
            "POST",
            body,
            contentType
        );

        if (responseData.data != null) {
            showPopup(
                "Thành Công",
                "Sản phẩm đã được thêm vào danh sách yêu thích",
                "success"
            );
            // alert("Sản phẩm đã được thêm vào danh sách yêu thích");
            $("#status-favourite >").remove();
            $("#status-favourite").append(
                '<a href="javascript:void(0)"\
            un-like="' +
                    product_detail_id +
                    '"\
            title="Đã yêu thích sản phẩm">\
            <i class="fa fa-heart" style="color:red;"></i>\
        </a>'
            );
            loadEventFavourite();
        } else {
            showPopup(
                "Xin lỗi",
                "Hệ thống đang bị gián đoạn, vui lòng thử lại sau",
                "error"
            );
        }
    });
}
