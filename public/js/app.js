// Scrolling Button function

var scroll = document.getElementById("top");

window.addEventListener("scroll", function() {
    scroll.style.transform = "rotate(" + window.pageYOffset + "deg)";
});

// Email Secure Format

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateCreatingAccount() {
    var $result = $("#result");
    var email = $("#email").val();
    $result.text("");

    if (validateEmail(email)) {
        $result.text(email + " valide");
        $result.css("color", "green");

        return true;
    } else {
        $result.text(email + "  n'est pas valide.");
        $result.css("color", "red");

        return false;
    }
}

$("#validate").on("click", validateCreatingAccount);

function validateLoginAccount() {
    var $result = $("#result2");
    var email = $("#email2").val();
    $result.text("");

    if (validateEmail(email)) {
        $result.text(email + " est valide");
        $result.css("color", "green");

        return true;
    } else {
        $result.text(email + " n'est pas valide.");
        $result.css("color", "red");

        return false;
    }
}
$("#validate2").on("click", validateLoginAccount);
