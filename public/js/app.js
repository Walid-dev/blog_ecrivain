$(document).ready(function() {
    if ($(".text_login_msg").hasClass("alert")) {
        console.log("Delete login msg");
    }
});

var scroll = document.getElementById("top");

window.addEventListener("scroll", function() {
    scroll.style.transform = "rotate(" + window.pageYOffset + "deg)";
});
