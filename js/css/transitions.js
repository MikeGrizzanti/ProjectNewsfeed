 $(document).ready(function() {
    
    //rotate login_div REGISTER
    $("#register_option").click(function() {
            $(".flipper").css({
                "webkitTransform":"rotateY(180deg)",
                "MozTransform":"rotateY(180deg)",
                "msTransform":"rotateY(180deg)",
                "OTransform":"rotateY(180deg)",
                "transform":"rotateY(180deg)"
            });
        $(".flipper").style.webkitTransform = "rotateY(180deg)";
    });
     
    //rotate login_div REGISTER -> Back
     $("#switch_to_login").click(function() {
         $(".flipper").css({
                "webkitTransform":"rotateY(360deg)",
                "MozTransform":"rotateY(360deg)",
                "msTransform":"rotateY(360deg)",
                "OTransform":"rotateY(360deg)",
                "transform":"rotateY(360deg)"
            });
         
         $(".flipper").style.webkitTransform = "rotateY(360deg)";

     });
     
     //Hamburger Open&Close
    $(".top_icon_open_sidebar").click(function () {
        $(this).toggleClass("Hide_Hamburger");
        $(".top_icon_close_sidebar").toggleClass("Show_Cross");
        $(".sidebar").toggleClass("Show_Sidebar");
    });
    
    //Open Otions
    $(".top_icon_settings").click(function () {
       $(".top_icon_settings_dropdown").toggleClass("make_visible");
    });
     
     
     //Open add feed
    $(".add_feed").click(function () {
        $(".wrap").toggleClass("url_box_show");
        $(".wrap_url_box").toggleClass("url_box_show");
        $("label").toggleClass("url_box_show");
        $(".url_box").toggleClass("url_box_show");
    });
     
     
    //pop-up
    $("div.news_card > table > tbody > tr > td").click(function () {
        $(".article_popup").toggleClass("article_popup_show");
        $(".background_article_popup").toggleClass("background_article_popup_show");
    }); 
});