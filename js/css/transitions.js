 $(document).ready(function() {
    
    //rotate login_div REGISTER
    $("#register_option").click(function(e) {
        e.preventDefault();
        $(".flipper").css('-webkit-transform',"rotateY(180deg)");
    });
     
    //rotate login_div REGISTER -> Back
     $("#switch_to_login").click(function(e) {
         e.preventDefault();
         $(".flipper").css('-webkit-transform',"rotateY(360deg)");
     });
     
     //Hamburger Open&Close
    $(".top_icon_open_sidebar").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("Hide_Hamburger");
        $(".top_icon_close_sidebar").toggleClass("Show_Cross");
        $(".sidebar").toggleClass("Show_Sidebar");
    });
    
    //Open Otions
    $(".top_icon_settings").click(function (e) {
        e.preventDefault();
       $(".top_icon_settings_dropdown").toggleClass("make_visible");
    });
     
     
     //Open add feed
    $(".add_feed").click(function (e) {
        e.preventDefault();
        $(".wrap").toggleClass("url_box_show");
        $(".wrap_url_box").toggleClass("url_box_show");
        $("label").toggleClass("url_box_show");
        $(".url_box").toggleClass("url_box_show");
    });
     
     
    //pop-up
    $("div.news_card > table > tbody > tr > td").click(function (e) {
        e.preventDefault();
        $(".article_popup").toggleClass("article_popup_show");
        $(".background_article_popup").toggleClass("background_article_popup_show");
    }); 
});