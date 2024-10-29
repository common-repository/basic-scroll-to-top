window.onscroll = function() {scrollFunction()};
var scroll_offset = basic_scrolltop_params.scroll_offset;
function scrollFunction() {
    if (document.body.scrollTop > scroll_offset || document.documentElement.scrollTop > scroll_offset) {
        document.getElementById("basic-scrolltop-button").style.display = "block";
    } else {
        document.getElementById("basic-scrolltop-button").style.display = "none";
    }
}
  
  jQuery('#basic-scrolltop-button').on('click', function (e) {
    var duration = parseInt(basic_scrolltop_params.duration);
        e.preventDefault();
        jQuery('html,body').animate({
            scrollTop: 0
        }, duration);
    });