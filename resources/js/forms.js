import $ from "jquery";
$(document).ready(function () {
    $(".main").addClass("visible");
    $(".smain").addClass("visible");
    $(".formain").addClass("visible");
});

$("#signupform").on("input", function () {
    if ($("#nameerror").hasClass("field-validation-error")) {
        $("#name").removeClass("email");
    }
    let pass = $("#password").val();
    let email = $("#email").val();

    if (email === "") {
        $("#email").addClass("email");
    } else {
        $("#email").removeClass("email");
    }

    if ($("#passworderror").hasClass("field-validation-valid")) {
        if (pass === "") {
            $("#password").addClass("password");
        } else if ($("#password-error").val() == undefined) {
            $("#password").removeClass("password");
        }
    } else if (pass === "") {
        $("#password").addClass("password");
    } else {
        $("#password").addClass("password");
    }

    // if (email === "") {
    //     $("#email").addClass("email");
    // } else {
    //     $("#email").removeClass("email");
    // }
    let confpass = $("#confpass").val();
    if (pass === confpass && confpass !== "") {
        $("#confpass").removeClass("confpass");
    } else {
        $("#confpass").addClass("confpass");
    }
    let dropdown = $("#dropdown").val();
    if (dropdown !== null) {
        $("#dropdown").removeClass("dropdown");
    } else {
        $("#dropdown").addClass("dropdown");
    }
});
$("#resetpass").submit(function (e) {
    let confpass = $("#confpass").val();
    let pass = $("#password").val();
    if (pass !== confpass) {
        alert(" The Passwords did not Match");
        e.preventDefault();
    }
});
$("#resetpass").on("input", function (e) {
    let pass = $("#password").val();
    let confpass = $("#confpass").val();
    if (pass === confpass && confpass !== "") {
        $("#confpass").removeClass("confpass");
    } else {
        $("#confpass").addClass("confpass");
    }
});
$("#signupform").submit(function (e) {
    if ($("#passworderror").hasClass("field-validation-valid")) {
        $("#password").removeClass("password");
    }

    let date_of_birth = $("#date").val();

    try {
        date_of_birth = parseInt(date_of_birth);
    } catch (error) {
        alert("Invalid date of birth");
    }
    if (date_of_birth <= 1999 || date_of_birth >= 2008) {
        alert("you must be 24 years old at least");
        e.preventDefault();
    }
});
$("#loginform").submit(function (e) {
    const Email = $(".email").val();

    const Password = $(".password").val();

    if (toString(Email) == "" && toString(Password) == "") {
        alert("Login Failure");
        e.preventDefault();
    }
});
