 $(document).ready(function() {
    
    //rotate login_div REGISTER
    $("#register_option").click(function() {
        $(".flipper").css("transform","rotateY(180deg)");
    });
     
    //rotate login_div REGISTER -> Back
     $("#switch_to_login").click(function() {
        $(".flipper").css("transform","rotateY(360deg)");
     });
     
     //Hamburger Open&Close
    $(".top_icon_open_sidebar").click(function () {
        $(this).toggleClass("Hide_Hamburger");
        $(".top_icon_close_sidebar").toggleClass("Show_Cross");
        $(".sidebar").toggleClass("Show_Sidebar");
    });
     
     
     //Open add feed
    $(".add_feed").click(function () {
        $(".url_box").toggleClass("url_box_show");
        $(".theme_selection").toggleClass("url_box_show");
    });
     
     Theme_Selection
     
    //pop-up
    $("div.news_card > table > tbody > tr > td").click(function () {
        $(".article_popup").toggleClass("article_popup_show");
        $(".background_article_popup").toggleClass("background_article_popup_show");
    }); 
});