$("#category-menu a").on("click", function () {
    recordOnPage = $("select#record-on-page option:selected").val();
    currentPage = 1;
    //Get value from menu category
    keyword = $(this).attr("keyword");
    searchID = $(this).attr("searchID");
    //Change value for title Category
    handleCallURLForPagination(currentPage, recordOnPage, $(this));
    //If not exist => add tag for it
    var spanShow = $("span#showName");
    if (spanShow.length <= 0) {
        var tagShowName =
            '<li>Tìm kiếm: <span id="showName" searchID="" keyword="" itemprop="title"></span></li>';
        $("li.product-title").after(tagShowName);
        //Re-update data
        spanShow = $("span#showName");
    }
    $(spanShow).attr("searchID", searchID);
    $(spanShow).attr("keyword", keyword);
    $(spanShow).text($(this).text());
});
