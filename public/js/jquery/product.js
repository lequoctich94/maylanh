$(".remove_product_in_stock").on("click", function () {
    body = {
        product_id: $(this).attr("id"),
        status: 0,
    };
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        url:
            "/api/stock-details/remove-product-in-stock" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: body,
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            location.reload(false);
        },
    });
});

$(".recover_product_in_stock").on("click", function () {
    body = {
        product_id: $(this).attr("id"),
        status: 1,
    };
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        url:
            "/api/stock-details/remove-product-in-stock" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: body,
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            location.reload(false);
        },
    });
});
