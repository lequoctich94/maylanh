//Select Producer
$('select[name="producerName"]').on("change", function () {
    if ($("table#infor-product tbody").find("td").length > 0) {
        callAjaxWithMethod("/admin/remove-product-to-cart", "POST");
        showPopup(
            "Cảnh Báo",
            "Sau khi chọn nhà cung cấp khác, giỏ hàng của bạn sẽ bị xoá",
            "error"
        );
        $("table#infor-product tbody td").remove();
        $("span.total-price").text("0 VNĐ");
        $("span.total-quantity").text(0);
        $(".payment").remove();
    }

    var producer_id = $(this).val();
    var opt = "";
    $('select[name="categoryName"]').empty();
    $('select[name="categoryName"]').append(
        '<option value="none" selected>Chọn Loại Sản Phẩm</option>'
    );
    $('div[name="listProduct"]').empty();
    $('div[name="listProduct"]').append(
        '<p class="align-center">Danh Sách Trống</p>'
    );
    $.ajax({
        type: "get",
        url:
            "/api/categories/get-all-category-by-producer-id/" +
            producer_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }

            for (var i = 0; i < data.data.length; i++) {
                opt +=
                    '<option value="' +
                    data.data[i].category_id +
                    '">' +
                    data.data[i].category_name +
                    "</option>";
            }
            $('select[name="categoryName"]').append(opt);
        },
        error: function () {},
    });
});

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

//Select Category
$('select[name="categoryName"]').on("change", function () {
    var category_id = $(this).val();
    var producer_id = $('select[name="producerName"]').val();
    var opt = [];
    if (category_id == "none") {
        $('div[name="listProduct"]').empty();
        $('div[name="listProduct"]').append(
            '<p class="align-center">Danh Sách Trống</p>'
        );
    } else {
        $.ajax({
            type: "get",
            url:
                "/api/products/get-all-product-by-category-id-and-producer-id-status/" +
                category_id +
                "&" +
                producer_id +
                "&1" +
                "?token=" +
                $('meta[name="jwt-token"]').attr("content"),
            success: function (data) {
                if (data.status == 401) {
                    logout();
                    return;
                }
                products = data.data;
                for (var i = 0; i < products.length; i++) {
                    opt += '<div class="boxListProductItem">';
                    opt +=
                        '<div class="card">\
                                            <div class="card-body">\
                                                <div class="card-img-actions"> <img\
                                                        src="/upload/products/' +
                        products[i].product_id +
                        "/" +
                        products[i].product_img +
                        '"\
                                                        class="card-img"  alt="' +
                        products[i].product_img +
                        '">\
                                                </div>\
                                            </div>\
                                            <div class="card-body bg-light text-center">\
                                                <div class="mb-2">\
                                                    <h6 class="font-weight-semibold mb-2 mt-2 boxListProductItemName"> <a href="javascript:void(0)"\
                                                            class="text-default mb-2" disable>' +
                        products[i].product_name +
                        '</a> </h6> <a href="javascript:void(0)"\
                                                        class="text-muted boxListProductItemCategory" disable>Loại: ' +
                        products[i].category.category_name +
                        '</a>\
                            </div> <button type="button" id="btn-add-product" name="' +
                        products[i].product_id +
                        '" class="btn btn-primary" data-toggle="modal"\
                                                    data-target="#addProduct">Thêm Sản\
                                                    Phẩm</button>\
                                            </div>\
                                        </div>\
                                    </div>';
                }
                $('div[name="listProduct"]').empty();
                $('div[name="listProduct"]').append(opt);
            },
            error: function () {},
        });
    }
});
//Click Button Add Product
$(document).on("click", "#btn-add-product", function () {
    product_id = $(this).attr("name");
    $.ajax({
        type: "GET",
        url:
            "/api/images/get-all-image-by-id-product-and-status/" +
            product_id +
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
                                style="background-position:cover,background-size:100%; object-cover:cover;"\
                                src="/upload/products/' +
                    $images[$i].product.product_id +
                    "/" +
                    $images[$i].img_name +
                    '"\
                                alt="Second slide">\
                            </div>';
            }
            $("#carousel-img").empty();
            $("#carousel-img").append(opt_img);
            //IMAGE
            $("#size").addClass("d-none");
            $product = $images[0].product;
            $(".modal-body .product_name").val($product.product_name);
            $(".modal-body .category_name").val(
                $product.category.category_name
            );
            $(".modal-body .producer_name").val(
                $product.producer.producer_name
            );

            $(".modal-body .product_id").val($product.product_id);
            $.ajax({
                type: "GET",
                url:
                    "/api/colors/get-color-by-product-id-and-status/" +
                    $product.product_id +
                    "&1" +
                    "?token=" +
                    $('meta[name="jwt-token"]').attr("content"),
                success: function (data) {
                    if (data.status == 401) {
                        logout();
                        return;
                    }
                    $colors = data.data;
                    //COLOR
                    var opt_color = [];
                    $(".modal-body #color_id").empty();
                    $(".modal-body #color_id").append(
                        '<option value="none" selected>Chọn Màu Sản Phẩm</option>'
                    );
                    for (var i = 0; i < $colors.length; i++) {
                        opt_color +=
                            '<option value="' +
                            $colors[i].color_id +
                            '">' +
                            $colors[i].color_name +
                            "</option>";
                    }
                    $(".modal-body #color_id").append(opt_color);
                    // //COLOR
                },
                error: function () {},
            });
        },
        error: function () {},
    });
});

$(document).on("change", "select#color_id", function () {
    $color_id = $(this).val();
    $product_id = $(".modal-body .product_id").val();
    $("#size").addClass("d-none");
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
            if (product_details == null) {
                alert(
                    "Loại sản phẩm này hiện chưa có kích thước, vui lòng thử lại sau"
                );
                return;
            }
            var opt = [];

            product_details.forEach(
                (product_detail) =>
                    (opt +=
                        '<option value="' +
                        product_detail.size.size_id +
                        '">' +
                        product_detail.size.size_name +
                        "<p class='ml-8'> - Giá nhập: " +
                        number_format(
                            product_detail.price_produced,
                            0,
                            ".",
                            ","
                        ) +
                        "đ</p>" +
                        "</option>")
            );
            $("#size").removeClass("d-none");
            $("#size_id").empty();
            $("#size_id").append(opt);
            $("#size_id").selectpicker("refresh");
        },
        error: function () {},
    });
});

$("#addProduct #add-product-to-cart").click(function () {
    $("#addProduct .error-add-product-color").remove();
    $("#addProduct .error-add-product-price-pay").remove();
    $("#addProduct .error-add-product-quantity").remove();
    $color_id = $("select#color_id").val();
    $quantity = $("#addProduct #inputQuantity").val();
    $price_pay = $("#addProduct #inputPricePay").val();

    if (!$quantity) {
        $("#addProduct .quantity").append(
            '<p class="error-add-product-quantity text-red">Vui lòng không để trống số lượng</p>'
        );
        return false;
    }

    if (!$price_pay) {
        $("#addProduct .price_pay").append(
            '<p class="error-add-product-price-pay text-red">Vui lòng không để trống giá bán</p>'
        );
        return false;
    }

    if (!validatePriceData($price_pay)) {
        $("#addProduct .price_pay").append(
            '<p class="error-add-product-price-pay text-red">Thông tin chỉ chứa số (Không bao gồm chữ, kí tự đặc biệt và khoảng trắng)</p>'
        );
        return false;
    }

    if (!validateSelected($color_id)) {
        $("#addProduct .color_name").append(
            '<p class="error-add-product-color text-red">Vui lòng chọn màu để nhập sản phẩm</p>'
        );
        return false;
    }
    $product_id = $(".modal-body .product_id").val();
    $size_id = $("select#size_id").val();

    $data = {
        data: [],
    };
    $size_id.forEach((element) => {
        $data.data.push({
            product_id: $product_id,
            size_id: element,
            color_id: $color_id,
            price_pay: $price_pay,
            quantity: $quantity,
        });
    });

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        url: "/admin/add-product-to-cart",
        data: $data,
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $("table#infor-product").empty();
            $("table#infor-product").append(loadCart(data.data));
            showPopup("Thành công", "Đã thêm vào giỏ hàng", "success");
            cart = $(".shopping-cart-quantity");
            quantityCart = data.quantity;
            $(".shopping-cart-quantity").text(quantityCart);
            $("#addProduct").modal("hide");
            // $('#listCart').load(location.href + '#listCart');
        },
        error: function () {},
    });
});

function loadCart(data) {
    $data = data;
    $body =
        '<tbody id="infor-product">\
            <tr>\
                <th>Hình Ảnh</th>\
                <th>Tên Sản Phẩm</th>\
                <th>Kích Thước</th>\
                <th>Màu</th>\
                <th>Giá Nhập</th>\
                <th>Giá Bán</th>\
                <th>Số Lượng</th>\
                <th>Tổng Nhập</th>\
                <th></th>\
            </tr>';
    $totalPriceOrder = 0;
    $totalQuantityOrder = 0;
    $.each(data, function (key, element) {
        $totalPriceProduct =
            element["product_detail"].price_produced * element["quantity"];
        $totalPriceOrder += $totalPriceProduct;
        $totalQuantityOrder += parseInt(element["quantity"]);
        $body +=
            '<tr>\
                <td><img class="w-80p" src="/upload/products/' +
            element["product_detail"].product.product_id +
            "/" +
            element["product_detail"].product.product_img +
            '"></td>\
                <td>' +
            element["product_detail"].product.product_name +
            "</td>\
                <td>" +
            element["product_detail"].size.size_name +
            "</td>\
                <td>" +
            element["product_detail"].color.color_name +
            "</td>\
                <td>" +
            number_format(
                parseInt(element["product_detail"].price_produced),
                0,
                ",",
                "."
            ) +
            " VNĐ</td>\
                <td>" +
            number_format(parseInt(element["price_pay"]), 0, ",", ".") +
            " VNĐ</td>\
                <td>" +
            element["quantity"] +
            "</td>\
                <td>" +
            number_format(parseInt($totalPriceProduct), 0, ",", ".") +
            ' VNĐ</td>\
                <td>\
                    <button type="button" class="close" aria-label="Close">\
                        <span aria-hidden="true">&times;</span>\
                    </button>\
                </td>\
            </tr>';
    });
    $body +=
        ' </tbody>\
                        <tfoot class=addToCart-bottom boxShadowSmall>\
                            <tr>\
                                <td class="text-left" colspan="4"><small\
                                    class="pr-2 font-weight-500">Tổng Tiền:</small><span\
                                    class="text-light font-weight-500 total-price">' +
        number_format($totalPriceOrder, 0, ",", ".") +
        ' VNĐ</span>\
                                </td>\
                                <td class="text-left" colspan="2"><small\
                                    class="pr-2 font-weight-500">Tổng Số Lượng:</small><span\
                                    class="text-light font-weight-500 total-quantity">' +
        $totalQuantityOrder +
        '</span>\
                                </td>\
                                <td colspan="3" class="payment" style="direction: rtl;">\
                                    <div class="input-group-append" style="margin-top:6px">\
                                        <button class="btn btn-primary" type="submit">Thanh Toán</button>\
                                    </div>\
                                </td>\
                            </tr>\
                        </tfoot>';
    return $body;
}
