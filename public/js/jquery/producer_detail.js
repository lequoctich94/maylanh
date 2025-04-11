$("select.list-category").on("change", function () {
    $category_id = $(this).val();
    $.ajax({
        type: "get",
        url:
            "/api/sizes/get-all-size-by-id-category-and-status/" +
            $category_id +
            "&1" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            sizes = data.data;
            var opt = "";
            sizes.forEach(
                (sz) =>
                    (opt +=
                        '<option value="' +
                        sz.size_id +
                        '">' +
                        sz.size_name +
                        "</option>")
            );

            // if ($("#size").length < 1) {
            //     // $("form.body-product > .category").after(
            //     //     '<div class="form-group" id="size">\
            //     //                 <label for="inputColor">Kích Thước</label>\
            //     //                 <select id="size-selected" name="size_id" class="form-control custom-select list-size">\
            //     //                     </select></div>'
            //     // );
            // }
            $("select#size_id").empty();
            $("select#size_id").append(opt);
            $("select#size_id").selectpicker("refresh");
            $("select#size_id").closest("div.d-none").removeClass("d-none");
        },
        error: function () {},
    });
});

$(".btn-add-product-one").on("click", function () {
    $("#addProduct .error-product").remove();
    $("select#size_id").closest("div.d-none").addClass("d-none");
});

$("#addProduct button.btn-add-product").on("click", function () {
    $("#addProduct .error-product").remove();
    $category_id = $("#addProduct #category-selected").val();
    $color_id = $("#addProduct #color-selected").val();
    $size_id = $("#addProduct #size-selected").val();
    $product_name = $("#addProduct #inputProductName").val();
    $price_produced = $("#addProduct #inputProductPriceProduced").val();
    $description = $("#addProduct #inputDescription").val();
    $image = $("#addProduct #image").val();

    if ($category_id == "none") {
        $("#addProduct .category").append(
            '<p class="error-product text-red">Vui lòng chọn loại sản phẩm</p>'
        );
        return false;
    }

    if ($size_id == "none") {
        $("#addProduct #size").append(
            '<p class="error-product text-red">Vui lòng size</p>'
        );
        return false;
    }

    if ($color_id == "none") {
        $("#addProduct .color").append(
            '<p class="error-product text-red">Vui lòng màu</p>'
        );
        return false;
    }

    if (!$product_name) {
        $("#addProduct .product_name").append(
            '<p class="error-product text-red">Vui lòng không bỏ trống</p>'
        );
        return false;
    }

    if (!$price_produced) {
        $("#addProduct .price_produced").append(
            '<p class="error-product text-red">Vui lòng không bỏ trống</p>'
        );
        return false;
    }

    if (!validatePriceData($price_produced)) {
        $("#addProduct .price_produced").append(
            '<p class="error-product text-red">Giá sản phẩm là số nguyên dương(>1000)</p>'
        );
        return false;
    }

    if (!$description) {
        $("#addProduct .description").append(
            '<p class="error-product text-red">Vui lòng không bỏ trống</p>'
        );
        return false;
    }

    // if (!validateName($product_name)) {
    //     $("#addProduct .product_name").append(
    //         '<p class="error-product text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
    //     );
    //     return false;
    // }

    if (!validateImage($image)) {
        $("#addProduct .image").append(
            '<p class="error-product text-red">Vui lòng chọn ảnh của sản phẩm để tạo</p>'
        );
        return false;
    }
});

$("a > i.remove_product").on("click", function () {
    $product_id = $(this).attr("product_id");
    $.ajax({
        type: "POST",
        url:
            "/api/products/remove-product" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            product_id: $product_id,
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

$("a > i.recover_product").on("click", function () {
    $product_id = $(this).attr("product_id");
    $.ajax({
        type: "POST",
        url:
            "/api/products/remove-product" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            product_id: $product_id,
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
