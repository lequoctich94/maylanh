function validationSelectShowAlert(value, message) {
    if (value == undefined || value == null) {
        showPopup("Thất Bại", message, "error");
        return false;
    }
    return true;
}

function showPopup(title, message, type) {
    popup = $("div#show-popup");
    popup.addClass("active");
    popup.removeClass("d-none");
    typeMessage = popup.find("#type-message");
    typeMessage.removeClass();
    if (type == "error") {
        typeMessage.addClass("fa fa-exclamation-triangle red");
    } else {
        typeMessage.addClass("fa fa-check green");
    }
    popup.find("#title-popup").text(title);
    popup.find("#message-popup").text(message);
}

$("button#dismiss-popup-btn").on("click", function () {
    $("div#show-popup").addClass("d-none");
    $("div#show-popup").removeClass("active");
});
