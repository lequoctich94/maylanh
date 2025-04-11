//Remove Producer
$(".remove_producer").on("click", function() {
    $producer_id = $(this).attr("id");
    $(".btn-remove-producer").attr("id", $producer_id);
});

$(".btn-remove-producer").on("click", function() {
    $producer_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url: "/api/producers/remove-producer" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            producer_id: $producer_id,
            status: 0,
        },
        success: function(data) {
            if (data.status == 401) {
                logout();
                return;
            }
            location.reload(false);
        },
        error: function() {},
    });
});

//Recover Producer
$(".recover_producer").on("click", function() {
    $producer_id = $(this).attr("id");
    $(".btn-recover-producer").attr("id", $producer_id);
});

$(".btn-recover-producer").on("click", function() {
    $producer_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url: "/api/producers/remove-producer" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            producer_id: $producer_id,
            status: 1,
        },
        success: function(data) {
            if (data.status == 401) {
                logout();
                return;
            }
            location.reload(false);
        },
        error: function() {},
    });
});
$(".btn_add_producer").on("click", function() {
    $("#addProducer .error-producer").remove();
});
$(".btn_update_producer").on("click", function() {
    $producer_id = $(this).attr("id");
    $.ajax({
        type: "GET",
        url: "/api/producers/get-producer-by-id/" +
            $producer_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function(data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $producer = data;
            $("#updateProducer #inputProducerId").val($producer.producer_id);
            $("#updateProducer #inputProducerName").val(
                $producer.producer_name
            );
            $("#updateProducer #inputProducerPhone").val($producer.phone);
            $("#updateProducer #inputProducerAddress").val($producer.address);
        },
        error: function() {},
    });
});
//check validate form add producer - button add producer
$("#addProducer button.btn-add-producer").on("click", function() {
    $("#addProducer .error-producer").remove();
    $producer_name = $("#addProducer #inputProducerName").val();
    $phone = $("#addProducer #inputProducerPhone").val();
    $address = $("#addProducer #inputProducerAddress").val();

    if (!$producer_name) {
        $("#addProducer .producer_name").append(
            '<p class="error-producer text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!$phone) {
        $("#addProducer .phone").append(
            '<p class="error-producer text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!$address) {
        $("#addProducer .address").append(
            '<p class="error-producer text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!validatePhone($phone)) {
        $("#addProducer .phone").append(
            '<p class="error-producer text-red">Số điện thoại không hợp lệ</p>'
        );
        return false;
    }

    // if (!validateName($producer_name)) {
    //     $("#addProducer .producer_name").append(
    //         '<p class="error-producer text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
    //     );
    //     return false;
    // }
});