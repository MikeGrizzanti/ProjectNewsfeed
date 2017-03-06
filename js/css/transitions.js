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
        $(this).toggleClass("Hide_Hamburger");
        $(".top_icon_close_sidebar").toggleClass("Show_Cross");
        $(".sidebar").toggleClass("Show_Sidebar");
    });
    
    //Open Otions
    $(".top_icon_settings").click(function () {
        $(".top_icon_settings_dropdown").toggleClass("Show_Sidebar");
    });
     
     //Open add feed
    $(".add_feed").click(function (e) {
        $(".wrap").toggleClass("url_box_show");
        $(".wrap_url_box").toggleClass("url_box_show");
        $("label").toggleClass("url_box_show");
        $(".url_box").toggleClass("url_box_show");
    });
     
     
    //pop-up
    $("#table_news_cards td").click(function (e) {
        e.preventDefault();
        $(".article_popup").toggleClass("Show_Sidebar");
        $(".background_article_popup").toggleClass("show_background");
        
    });
     
    $(".close_popup").click(function (e) {
        e.preventDefault();
        $(".article_popup").toggleClass("hide_it");
        $(".background_article_popup").toggleClass("hide_it");
        
    });
});