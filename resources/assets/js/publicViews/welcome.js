$(document).ready(function() {
    $("#show_filters").click(function() {
        $(this).addClass("hidden");
        $(this).siblings("#hide_filters").removeClass("hidden");
        
        $(".filter_cnt").slideToggle("slow", function () {
            /* $(this).removeClass("d_none"); */
            /* $(".filter_cnt").css("display", "flex"); */
            /* $(".filter_cnt").css("display", "flex"); */
        });
    }); 

    $("#hide_filters").click(function () {
        $(this).addClass("hidden");
        $(this).siblings("#show_filters").removeClass("hidden");
        $(".filter_cnt").slideToggle("slow", function () {
        });
    });
});