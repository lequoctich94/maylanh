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

$(document).on("change", "select#color_id", function () {
    $color_id = $(this).val();
    $product_id = $(".modal-body .product_id").val();
    $.ajax({
        type: "GET",
        url:
            "/api/colors/get-all-color-by-status/" +
            1 +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $colors = data.data;
            // var opt = [];

            colors.forEach(
                (color) =>
                    (opt +=
                        '<option value="' +
                        color.color_id +
                        '">' +
                        color.color_name +
                        "</option>")
            );
            // if ($('#size').length < 1) {
            //     $('.modal-body > .color_name').after('<div class="form-group" id="size">\
            //         <label for="inputSizeName">Kích Thước</label>\
            //             <select class="form-control custom-select" id="size_id"\
            //             name="size_id">\
            //             </select>\
            //         </div>');

            // }

            // $('#size_id').empty();
            // $('#size_id').append(opt);
        },
        error: function () {},
    });
});
//Xoá sản phẩm
$(document).ready(function () {
    $(".remove_ppd").on("click", function () {
        $product_detail_id = $(this).attr("product_detail_id");
        $(".btn_remove_ppd").attr("id", $product_detail_id);
    });
    $(".btn_remove_ppd").on("click", function () {
        $product_detail_id = $(this).attr("id");
        $.ajax({
            type: "POST",
            url:
                "/api/product-details/remove-product-detail" +
                "?token=" +
                $('meta[name="jwt-token"]').attr("content"),
            data: {
                product_detail_id: $product_detail_id,
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

    //Khôi phục sản phẩm
    $(".recover_ppd").on("click", function () {
        $product_detail_id = $(this).attr("product_detail_id");
        $(".btn_recover_ppd").attr("id", $product_detail_id);
    });
    $(".btn_recover_ppd").on("click", function () {
        $product_detail_id = $(this).attr("id");
        $.ajax({
            type: "POST",
            url:
                "/api/product-details/remove-product-detail" +
                "?token=" +
                $('meta[name="jwt-token"]').attr("content"),
            data: {
                product_detail_id: $product_detail_id,
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

    //Thêm chi tiết size
    $(".btn_more_size").on("click", function () {
        $("#addSizeOfProducerProductDetail .error-product-detail").remove();
        $product_detail_id = $(this).attr("product_detail_id");

        $.ajax({
            type: "GET",
            url:
                "/api/product-details/get-product-detail-by-id/" +
                $product_detail_id +
                "?token=" +
                $('meta[name="jwt-token"]').attr("content"),
            success: function (data) {
                if (data.status == 401) {
                    logout();
                    return;
                }
                $product_detail = data.data;

                $("#addSizeOfProducerProductDetail #inputColorName").val(
                    $product_detail.color.color_name
                );
                $("#addSizeOfProducerProductDetail #inputColorId").val(
                    $product_detail.color.color_id
                );
                $.ajax({
                    type: "GET",
                    url:
                        "/api/images/get-all-image-by-id-product-and-id-color-and-status/" +
                        $product_detail.product.product_id +
                        "&" +
                        $product_detail.color.color_id +
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
                        $(
                            "#addSizeOfProducerProductDetail #carousel-img"
                        ).empty();
                        $(
                            "#addSizeOfProducerProductDetail #carousel-img"
                        ).append(opt_img);
                    },
                });
            },
            error: function () {},
        });
    });

    //Cập nhật hình ảnh
    $(".btn_edit_image").on("click", function () {
        $("#editImageProducerProductDetail .error-product-detail").remove();
        $product_detail_id = $(this).attr("product_detail_id");
        $("#editImageProducerProductDetail form ac").val($product_detail_id);

        let form = $('.body-product');
        let currentAction = "/admin/edit-image-producer-product-detail/";
        form.attr('action', currentAction + $product_detail_id);

        $.ajax({
            type: "GET",
            url:
                "/api/product-details/get-product-detail-by-id/" +
                $product_detail_id +
                "?token=" +
                $('meta[name="jwt-token"]').attr("content"),
            success: function (data) {
                if (data.status == 401) {
                    logout();
                    return;
                }
                $product_detail = data.data;
                console.log($product_detail);
                // $("#editImageProducerProductDetail #inputColorName").val(
                //     $product_detail.color.color_name
                // );
                // $("#editImageProducerProductDetail #inputColorId").val(
                //     $product_detail.color.color_id
                // );

                // $("input[name=product_detail_id]").val(
                //     $product_detail.product_detail_id
                // );

                $.ajax({
                    type: "GET",
                    url:
                        "/api/images/get-all-image-by-id-product-and-id-color-and-status/" +
                        $product_detail.product.product_id +
                        "&" +
                        $product_detail.color.color_id +
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
                                style="background-position:cover; object-cover:cover;"\
                                src="/upload/products/' +
                                $images[$i].product.product_id +
                                "/" +
                                $images[$i].img_name +
                                '"\
                                alt="Second slide">\
                                </div>';
                        }
                        $(
                            "#editImageProducerProductDetail #carousel-img"
                        ).empty();
                        $(
                            "#editImageProducerProductDetail #carousel-img"
                        ).append(opt_img);
                    },
                    error: function () {},
                });
            },
            error: function () {},
        });
    });

    $(".btn-add-product-detail-one").on("click", function () {
        $("#addProducerProductDetail .error-product-detail").remove();
    });
    $("#addProducerProductDetail button.btn-add-product-detail").on(
        "click",
        function () {
            $("#addProducerProductDetail .error-product-detail").remove();

            $color_id = $("#addProducerProductDetail #color-selected").val();
            $size_id = $("#addProducerProductDetail #size-selected").val();
            $image = $("#addProducerProductDetail #image").val();

            if ($color_id == "none") {
                $("#addProducerProductDetail .color").append(
                    '<p class="error-product-detail text-red">Vui lòng chọn màu</p>'
                );
                return false;
            }
            if ($size_id == "none") {
                $("#addProducerProductDetail .size").append(
                    '<p class="error-product-detail text-red">Vui lòng chọn size</p>'
                );
                return false;
            }

            if (!validateImage($image)) {
                $("#addProducerProductDetail .image").append(
                    '<p class="error-product-detail text-red">Vui lòng chọn ảnh của sản phẩm để tạo</p>'
                );
                return false;
            }
        }
    );

    $("#addSizeOfProducerProductDetail button.btn-add-size").on(
        "click",
        function () {
            $("#addSizeOfProducerProductDetail .error-product-detail").remove();

            $size_id = $(
                "#addSizeOfProducerProductDetail #size-selected"
            ).val();
            if ($size_id == "none") {
                $("#addSizeOfProducerProductDetail .size").append(
                    '<p class="error-product-detail text-red">Vui lòng size</p>'
                );
                return false;
            }
        }
    );
    $("#editImageProducerProductDetail button.btn-edit-image").on(
        "click",
        function () {
            $("#editImageProducerProductDetail .error-product-detail").remove();
            $image = $("#editImageProducerProductDetail #image").val();
            // if (!validateImage($image)) {
            //     $("#editImageProducerProductDetail .image").append(
            //         '<p class="error-product-detail text-red">Vui lòng chọn ảnh</p>'
            //     );
            //     return false;
            // }
        }
    );
});

$("select#select-size-id").on("change", function () {
    size_selected = $(this);
    row = size_selected.closest("tr");
    size_id = size_selected.find(":selected").val();
    product_id = $("input[name=product_id]").val();
    color_id = row.find("td[name=color_id]").attr("color_id");

    product_detail_id = product_id + size_id + color_id;
    $.ajax({
        type: "GET",
        url:
            "/api/product-details/get-product-detail-by-id/" +
            product_detail_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }

            row.find("td[name=price_produced]").text(
                number_format(data.data.price_produced, 0, ".", ",") + "đ"
            );
            row.find("td[name=action_more]")
                .find("i")
                .attr("product_detail_id", product_detail_id);
            row.find("td[name=status]").empty();
            if (data.data.status == 1) {
                row.find("td[name=action_more]")
                    .find("div.action_detail")
                    .removeClass("d-none");
                row.find("td[name=action_more]")
                    .find("div.action_recover")
                    .addClass("d-none");
                statusProductDetail =
                    '<span class="badge badge-success">Hoạt Động</span>';
            } else {
                row.find("td[name=action_more]")
                    .find("div.action_detail")
                    .addClass("d-none");
                row.find("td[name=action_more]")
                    .find("div.action_recover")
                    .removeClass("d-none");
                statusProductDetail =
                    '<span class="badge badge-danger">Tạm Ngưng</span>';
            }

            row.find("td[name=status]").append(statusProductDetail);
        },
    });
});
//Cập nhật giá sản phẩm
$(".btn_edit_price_produced").on("click", function () {
    $product_detail_id = $(this).attr("product_detail_id");
    $("form.update_price_produced input[name=product_detail_id").val(
        $product_detail_id
    );
    $.ajax({
        type: "GET",
        url:
            "/api/product-details/get-product-detail-by-id/" +
            $product_detail_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            product_detail = data.data;

            $("form.update_price_produced input[name=color_name]").val(
                product_detail.color.color_name
            );
            $("form.update_price_produced input[name=size_name]").val(
                product_detail.size.size_name
            );

            $("form.update_price_produced input[name=price_produced]").val(
                product_detail.price_produced
            );

            $.ajax({
                type: "GET",
                url:
                    "/api/images/get-all-image-by-id-product-and-id-color-and-status/" +
                    product_detail.product.product_id +
                    "&" +
                    product_detail.color.color_id +
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
                                style="background-position:cover; object-cover:cover;"\
                                src="/upload/products/' +
                            $images[$i].product.product_id +
                            "/" +
                            $images[$i].img_name +
                            '"\
                                alt="Second slide">\
                                </div>';
                    }
                    $("#editPriceProduced #carousel-img").empty();
                    $("#editPriceProduced #carousel-img").append(opt_img);
                },
                error: function () {},
            });
        },
    });
});
