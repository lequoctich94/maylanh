//Remove validation Color
$(".remove_color").on("click", function () {
    $color_id = $(this).attr("id");
    $(".btn-remove-color").attr("id", $color_id);
});

//Remove color
$(".btn-remove-color").on("click", function () {
    $color_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/colors/remove-color" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            color_id: $color_id,
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

//Update Color
$(".btn_update_color").on("click", function () {
    $("#updateColor .error-color").remove();
    $color_id = $(this).attr("id");
    $.ajax({
        type: "GET",
        url:
            "/api/colors/get-color-by-id/" +
            $color_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $color = data.data;
            $("#updateColor #inputColorName").val($color.color_name);
            $("#updateColor #color_id").val($color.color_id);
        },
        error: function () {},
    });
});

//Recover validation Color
$(".recover_color").on("click", function () {
    $color_id = $(this).attr("id");
    $(".btn-recover-color").attr("id", $color_id);
});

//Revocer color
$(".btn-recover-color").on("click", function () {
    $color_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/colors/remove-color" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            color_id: $color_id,
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

//Remove validation Size
$(".remove_size").on("click", function () {
    $size_id = $(this).attr("id");
    $(".btn-remove-size").attr("id", $size_id);
});

//Update Size
$(".btn_update_size").on("click", function () {
    $("#updateSize .error-size").remove();
    $size_id = $(this).attr("id");
    $.ajax({
        type: "GET",
        url:
            "/api/sizes/get-size-by-id/" +
            $size_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $size = data.data;
            $("#updateSize #inputSizeName").val($size.size_name);
            $("#updateSize #inputCategoryName").val(
                $size.category.category_name
            );
            $("#updateSize #size_id").val($size.size_id);
        },
        error: function () {},
    });
});

//Remove size
$(".btn-remove-size").on("click", function () {
    $size_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/sizes/remove-size" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            size_id: $size_id,
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

//Recover validation size
$(".recover_size").on("click", function () {
    $size_id = $(this).attr("id");
    $(".btn-recover-size").attr("id", $size_id);
});

//Recover size
$(".btn-recover-size").on("click", function () {
    $size_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/sizes/remove-size" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            size_id: $size_id,
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

$(".btn_add_color").on("click", function () {
    $("#addColor .error-color").remove();
});
//check validate form add color - button add color
$("#addColor button.btn-add-color").on("click", function () {
    $("#addColor .error-color").remove();
    $color_name = $("#inputColorName").val();
    if (!$color_name) {
        $(".color_name").append(
            '<p class="text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if (!validateName($color_name)) {
        $(".color_name").append(
            '<p class="error-color text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
        );
        return false;
    }
});
//check validate form update color - button update color
$("#updateColor button.btn-update-color").on("click", function () {
    $("#updateColor .error-color").remove();
    $color_name = $("#updateColor #inputColorName").val();
    if (!$color_name) {
        $("#updateColor .color_name").append(
            '<p class="error-color text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!validateName($color_name)) {
        $("#updateColor .color_name").append(
            '<p class="error-color text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
        );
        return false;
    }
});

$(".btn_add_size").on("click", function () {
    $("#addSize .error-size").remove();
});

//check validate form add size - button add size
$("#addSize button.btn-add-size").on("click", function () {
    $("#addSize .error-size").remove();
    $size_name = $("#addSize #inputSizeName").val();
    $category_id = $("#addSize #category-selected").val();
    if (!$size_name) {
        $(".size_name").append(
            '<p class="error-size text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if ($category_id == "none") {
        $("#addSize .category").append(
            '<p class="error-size text-red">Vui lòng chọn loại sản phẩm</p>'
        );
        return false;
    }

    if (!validateSize($size_name)) {
        $("#addSize .size_name").append(
            '<p class="error-size text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
        );
        return false;
    }
});

//check validate form add size - button add size
$("#updateSize button.btn-update-size").on("click", function () {
    $("#updateSize .error-size").remove();
    $size_name = $("#updateSize #inputSizeName").val();

    if (!$size_name) {
        $("#updateSize .size_name").append(
            '<p class="error-size text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    if (!validateSize($size_name)) {
        $("#updateSize .size_name").append(
            '<p class="error-size text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
        );
        return false;
    }
});
