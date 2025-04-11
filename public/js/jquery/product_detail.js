number_format = function (number, decimals, dec_point, thousands_sep) {
    number = number.toFixed(decimals);
    var nstr = number.toString();
    nstr += "";
    x = nstr.split(".");
    x1 = x[0];
    x2 = x.length > 1 ? dec_point + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) x1 = x1.replace(rgx, "$1" + thousands_sep + "$2");
    return x1 + x2;
};
//Remove Product
$(".remove_product_detail_in_stock").on("click", function () {
    $prod_detail_id = $(this).attr("id");
    $(".btn-remove-product").attr("id", $prod_detail_id);
});

$(".btn-remove-product").on("click", function () {
    $prod_detail_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/stock-details/remove-product-detail-in-stock" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            product_detail_id: $prod_detail_id,
            status: 0,
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
//Recover Product
$(".recover_product_detail_in_stock").on("click", function () {
    $prod_detail_id = $(this).attr("id");
    $(".btn-recover-product").attr("id", $prod_detail_id);
});
$(".btn-recover-product").on("click", function () {
    $prod_detail_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/stock-details/remove-product-detail-in-stock" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            product_detail_id: $prod_detail_id,
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
//Update Product

$(".update_product_detail_in_stock").on("click", function () {
    $prod_detail_id = $(this).attr("id");
    $.ajax({
        type: "GET",
        url:
            "/api/stock-details/get-product-detail-in-stock-by-product-detail-id-and-status/" +
            $prod_detail_id +
            "&1" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $stock_detail = data.data;
            //GET ALL IMAGE: PRODUCT ID AND COLOR ID
            $.ajax({
                type: "GET",
                url:
                    "/api/images/get-all-image-by-id-product-and-id-color-and-status/" +
                    $stock_detail.product_detail.product.product_id +
                    "&" +
                    $stock_detail.product_detail.color.color_id +
                    "&1" +
                    "?token=" +
                    $('meta[name="jwt-token"]').attr("content"),
                success: function (data) {
                    if (data.status == 401) {
                        logout();
                        return;
                    }
                    var $images = data.data;
                    //IMAGE
                    var opt_img = [];
                    for (var $i = 0; $i < $images.length; $i++) {
                        if ($i == 0) {
                            opt_img += '<div class="carousel-item active">';
                        } else {
                            opt_img += '<div class="carousel-item">';
                        }
                        opt_img +=
                            '<img class="card-img img-container"\
                                        style="background-posistion:cover; object-cover:cover;"\
                                        src="/upload/products/' +
                            $images[$i].product.product_id +
                            "/" +
                            $images[$i].img_name +
                            '"\
                                        alt="Second slide">\
                                    </div>';
                    }
                    $("#updateProduct #carousel-img").empty();
                    $("#updateProduct #carousel-img").append(opt_img);
                },
            });

            //GET INFO PRODUCT IN STOCK DETAIL
            $("#updateProduct [name=product_detail_id]").val(
                $stock_detail.product_detail.product_detail_id
            );
            $("#updateProduct [name=product_name]").val(
                $stock_detail.product_detail.product.product_name
            );
            $("#updateProduct [name=category_name]").val(
                $stock_detail.product_detail.product.category.category_name
            );
            $("#updateProduct [name=producer_name]").val(
                $stock_detail.product_detail.product.producer.producer_name
            );
            $("#updateProduct [name=price]").val(
                number_format(
                    $stock_detail.product_detail.price_produced,
                    0,
                    ",",
                    "."
                )
            );
            $("#updateProduct [name=price_pay]").val($stock_detail.price_pay);
            $("#updateProduct [name=quantity]").val($stock_detail.quantity);
            $("#updateProduct [name=sale_off]").val($stock_detail.sale_off);
            $("#updateProduct [name=color_id]").val(
                $stock_detail.product_detail.color.color_name
            );
            $("#updateProduct [name=size_id]").val(
                $stock_detail.product_detail.size.size_name
            );
        },
        error: function () {},
    });
});

$(".order_product_detail_in_stock").on("click", function () {
    $prod_detail_id = $(this).attr("id");
    $.ajax({
        type: "GET",
        url:
            "/api/stock-details/get-product-detail-in-stock-by-product-detail-id-and-status/" +
            $prod_detail_id +
            "&1" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $stock_detail = data.data;
            //GET ALL IMAGE: PRODUCT ID AND COLOR ID
            $.ajax({
                type: "GET",
                url:
                    "/api/images/get-all-image-by-id-product-and-id-color-and-status/" +
                    $stock_detail.product_detail.product.product_id +
                    "&" +
                    $stock_detail.product_detail.color.color_id +
                    "&1" +
                    "?token=" +
                    $('meta[name="jwt-token"]').attr("content"),
                success: function (data) {
                    if (data.status == 401) {
                        logout();
                        return;
                    }
                    var $images = data.data;
                    //IMAGE
                    var opt_img = [];
                    for (var $i = 0; $i < $images.length; $i++) {
                        if ($i == 0) {
                            opt_img += '<div class="carousel-item active">';
                        } else {
                            opt_img += '<div class="carousel-item">';
                        }
                        opt_img +=
                            '<img class="card-img img-container"\
                                        style="background-posistion:cover; object-cover:cover;"\
                                        src="/upload/products/' +
                            $images[$i].product.product_id +
                            "/" +
                            $images[$i].img_name +
                            '"\
                                        alt="Second slide">\
                                    </div>';
                    }
                    $("#orderProduct #carousel-img").empty();
                    $("#orderProduct #carousel-img").append(opt_img);
                    //Remove tag select size
                    if ($("#orderProduct #size").length > 0) {
                        $("#orderProduct #size").remove();
                    }
                },
            });

            //GET INFO PRODUCT IN STOCK DETAIL
            $("#orderProduct [name=product_detail_id]").val(
                $stock_detail.product_detail.product_detail_id
            );
            $("#orderProduct [name=product_name]").val(
                $stock_detail.product_detail.product.product_name
            );
            $("#orderProduct [name=category_name]").val(
                $stock_detail.product_detail.product.category.category_name
            );
            $("#orderProduct [name=producer_name]").val(
                $stock_detail.product_detail.product.producer.producer_name
            );
            $("#orderProduct [name=price]").val(
                number_format(
                    $stock_detail.product_detail.price_produced,
                    0,
                    ",",
                    "."
                )
            );
            $("#orderProduct [name=price_pay]").val($stock_detail.price_pay);
            $("#orderProduct [name=quantity]").val($stock_detail.quantity);
            $("#orderProduct [name=color_id]").val(
                $stock_detail.product_detail.color.color_name
            );
            $("#orderProduct [name=size_id]").val(
                $stock_detail.product_detail.size.size_name
            );
        },
        error: function () {},
    });
});

$("#orderProduct #color_id").on("change", function () {
    $color_id = $(this).val();
    $product_id = $("#orderProduct .modal-body #product_id").val();
    $.ajax({
        type: "GET",
        url:
            "/api/product-details/get-all-product-detail-by-id-product-and-id-color/" +
            $product_id +
            "&" +
            $color_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            product_details = data.data;
            var opt = [];
            product_details.forEach(
                (product_detail) =>
                    (opt +=
                        '<option value="' +
                        product_detail.size.size_id +
                        '">' +
                        product_detail.size.size_name +
                        "</option>")
            );

            if ($("#size").length < 1) {
                $("#orderProduct .modal-body .color_name").after(
                    '<div class="form-group" id="size">\
                            <label for="inputSize">Kích Thước</label>\
                            <select class="form-control custom-select" id="size_id"\
                            name="size_id">\
                            </select>\
                        </div>'
                );
            }
            $("#orderProduct #size_id").empty();
            $("#orderProduct #size_id").append(opt);
        },
        error: function () {},
    });
});

//Check validate Form Update Product
$("#updateProduct button.btn-update-product").on("click", function () {
    $("#updateProduct .error-update-product").remove();
    $price_pay = $("#updateProduct [name=price_pay").val();

    if (!$price_pay) {
        $("#updateProduct .price_pay").append(
            '<p class="error-update-product text-red">Vui lòng không để trống giá bán</p>'
        );
        return false;
    }

    if (!validatePriceData($price_pay)) {
        $("#updateProduct .price_pay").append(
            '<p class="error-update-product text-red">Thông tin chỉ chứa số</p>'
        );
        return false;
    }
});
//Check validate Form Add Product In Stock

$("#orderProduct button.btn-order-product").on("click", function () {
    $("#orderProduct .error-order-product").remove();
    $quantity_order = $("#orderProduct [name=quantity]").val();
    if (!$quantity_order) {
        $("#orderProduct .quantity_order").append(
            '<p class="error-order-product text-red">Vui lòng không để trống số lượng.</p>'
        );
        return false;
    }
});

// $('#updateProduct #inputQuantity').keypress(function() {
//     var $th = $(this);
//     $th.val( $th.val().replace(/[^[1-9]$/, function(str) {
//         alert('You typed " ' + str + ' ".\n\nPlease use only letters and numbers.'); return 'Hello'; } ) );
// });

// $("button.btn-order-product").click(function () {
//     $('#orderProduct .error-order-product').remove();
//     var regEx = /^([1-9]|[1-9][0-9]|[1-9][0-9][0-9])$/;
//     $quantity1 = regex.test($("#inputQuantity").val();
//     $quantity2 = $('#updateProduct #inputQuantity').val();
//     if (!$quantity2) {
//         $('#orderProduct .order_quantity').append(
//             '<p class="error-order-product text-red">Vui lòng không để trống số lượng.</p>');
//     }
//     if (!$quantity1) {
//         $('#orderProduct .order_quantity').append(
//             '<p class="error-order-product text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
//         );
//         return false;
//     }
// });
