//Remove Product
$(".remove_category_instock").on("click", function () {
    $cate_id = $(this).attr("id");
    $(".btn-remove-category").attr("id", $cate_id);
});

$(".btn-remove-category").on("click", function () {
    $cate_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/categories/remove-category" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            category_id: $cate_id,
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

//Remove Product
$(".recover_category_instock").on("click", function () {
    $cate_id = $(this).attr("id");
    $(".btn-recover-category").attr("id", $cate_id);
});

$(".btn-recover-category").on("click", function () {
    $cate_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/categories/remove-category" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            category_id: $cate_id,
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

$(".btn_update_category").on("click", function () {
    $cate_id = $(this).attr("id");
    $.ajax({
        type: "GET",
        url:
            "/api/categories/get-category-by-id/" +
            $cate_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $category = data.data;
            $("#updateCategory .card-body").empty();
            $("#updateCategory .card-body").append(
                '<div class="card-img-actions">\
                                            <img width="100" height="100" src = "'+ window.location.protocol+'/upload/categories/' +
                    $category.suffix_img +
                    '">\
                                        </div>'
            );
            $("#updateCategory #inputCategoryName").val(
                $category.category_name
            );
            $("#updateCategory #category_id").val($category.category_id);
            $("#updateCategory #img").val($category.suffix_img);
        },
        error: function () {},
    });
});

//Check validate form add category
$("#addCategory button.btn-add-category").on("click", function () {
    $(".error-category").remove();
    $(".error-image").remove();
    $category_name = $("#inputCategoryName").val();
    $file = $("#image").val();

    if (!$category_name) {
        $(".category_name").append(
            '<p class="error-category text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!validateCategory($category_name)) {
        $(".category_name").append(
            '<p class="error-category text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z, 1 khoảng cách, kí tự có dấu)</p>'
        );
        return false;
    }

    if (!validateImage($file)) {
        $(".img_path").append(
            '<p class="error-image text-red">Vui lòng chọn hình ảnh</p>'
        );
        return false;
    }
});

//Check validate form update category
$("#updateCategory button.btn-update-category").on("click", function () {
    $(".error-category").remove();
    $(".error-image").remove();
    $category_name = $("#updateCategory #inputCategoryName").val();
    $file = $("#image").val();

    if (!$category_name) {
        $("#updateCategory .category_name").append(
            '<p class="error-category text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!validateCategory($category_name)) {
        $("#updateCategory .category_name").append(
            '<p class="error-category text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z, 1 khoảng cách, kí tự có dấu)</p>'
        );
        return false;
    }
});
