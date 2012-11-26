(function($) {

    $("#createAccount").on('click', function () {
        var accountData = {
            path: $("#username").get(0).value,
            username: $("#username").get(0).value,
            p: $("#password").get(0).value
        };
        $.ajax({
            url: "/createaccount",
            data: accountData
        });
    });
}(jQuery))
