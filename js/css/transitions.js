 $(document).ready(function() {
    
    //Hamburger Open&Close
    $(".top_icon_open_sidebar").click(function () {
        $(this).toggleClass("Hide_Hamburger");
        $(".top_icon_close_sidebar").toggleClass("Show_Cross");
        $(".sidebar").toggleClass("Show_Sidebar");
    });
});