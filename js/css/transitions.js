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
    
    //article hide
    $(".close_popup").click(function (e) {
        e.preventDefault();
        $(".article_popup").toggleClass("article_popup");
        $(".background_article_popup").toggleClass("hide_it");
    });
     
    //change email
     $("#change_email_link").click(function (e) {
        e.preventDefault();
        $(".change_email_popup").toggleClass("Show_Sidebar");
    });
     
     //change_pw_div
     
      $(".change_information_link").click(function () {
            alert("hi");
            $(".change_pw_div").toggleClass("Show_Sidebar");
      });
     
    //disble url_box
    $("#member1").click(function () {
        $(this).prop('disabled', false);
        $('#add_feed_url').attr('disabled', 'disabled');
    });
    
    //disble source
     $("#add_feed_url").click(function () {
        $(this).prop('disabled', false);
       	$('#member1').attr('disabled', 'disabled');
    });
});