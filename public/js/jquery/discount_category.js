$(".remove_discount").on("click", function () {
    $discount_id = $(this).attr("id");
    $(".btn_remove_discount").attr("id", $discount_id);
});
$(".btn_remove_discount").on("click", function () {
    $discount_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/discount-categories/remove-discount-category" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            discount_id: $discount_id,
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

$(".recover_discount").on("click", function () {
    $discount_id = $(this).attr("id");
    $(".btn_recover_discount").attr("id", $discount_id);
});
$(".btn_recover_discount").on("click", function () {
    $discount_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/discount-categories/remove-discount-category" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            discount_id: $discount_id,
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

$(".btn_update_discount_category").on("click", function () {
    $("#updateDiscountCategory .error-update-discount").remove();
    $discount_id = $(this).attr("id");
    $.ajax({
        type: "GET",
        url:
            "/api/discount-categories/get-discount-category-by-id/" +
            $discount_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $discount_category = data.data;
            $("#updateDiscountCategory #inputDiscountId").val(
                $discount_category.discount_id
            );
            $("#updateDiscountCategory #selectCategoryId").empty();
            $("#updateDiscountCategory #selectCategoryId").append(
                '<option value="none" id="selectedCateId" selected>' +
                    $discount_category.category.category_name +
                    '</option>\
                            @foreach($categories as $category)\
                                <option value="{{$category->category_id}}">\
                                {{$category->category_name}}</option>\
                            @endforeach'
            );
            $("#updateDiscountCategory #selectedCateId").val(
                $discount_category.category.category_id
            );
            $("#updateDiscountCategory #inputPercentPriceUpdate").val(
                $discount_category.percent_price
            );
            $("#updateDiscountCategory #inputRankId").val(
                $discount_category.rank_id
            );
            $("#updateDiscountCategory #inputRankName").val(
                $discount_category.rank.rank_name
            );
        },
        error: function () {},
    });
});

$(".btn_add_discount_category").on("click", function () {
    $("#addDiscountCategory .error-add-discount").remove();
});
//check validate form add discount category - button add discount category
$("#addDiscountCategory button.btn_submit_add_discount").on(
    "click",
    function () {
        $("#addDiscountCategory .error-add-discount").remove();
        $discount_id = $("#category-id-selected").val();
        $percent_price = $("#inputPercentPriceAdd").val();
        if ($discount_id == "none") {
            $("#addDiscountCategory .category-add").append(
                '<p class="error-add-discount text-red">Vui lòng chọn loại sản phẩm</p>'
            );
            return false;
        }
        if (!$percent_price) {
            $("#addDiscountCategory .percent-price-input").append(
                '<p class="error-add-discount text-red">Vui lòng không để trống thông tin</p>'
            );
            return false;
        }
        if (!validatePercentPrice($percent_price)) {
            $("#addDiscountCategory .percent-price-input").append(
                '<p class="error-add-discount text-red">Mức giảm là một số thực không âm</p>'
            );
            return false;
        }
    }
);

//check validate form add discount category - button add discount category
$("#updateDiscountCategory button.btn_submit_update_discount").on(
    "click",
    function () {
        $("#updateDiscountCategory .error-update-discount").remove();
        $percent_price = $("#inputPercentPriceUpdate").val();
        if (!$percent_price) {
            $("#updateDiscountCategory .percent-price-update").append(
                '<p class="error-update-discount text-red">Vui lòng không để trống thông tin</p>'
            );
            return false;
        }
        if (!validatePercentPrice($percent_price)) {
            $("#updateDiscountCategory .percent-price-update").append(
                '<p class="error-update-discount text-red">Mức giảm là một số thực không âm</p>'
            );
            return false;
        }
    }
);
