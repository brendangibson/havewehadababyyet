(function($) {

	var replaceInner = function (html) {
		var $inner = $("#inner");
		$inner.hide();
		$inner.html(html);
		$inner.show();
	};
	
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

    $("#loginbutton").on('click', function () {
        var accountData = {
            username: $("#username").get(0).value,
            p: $("#password").get(0).value
        },
        loginSuccess = function () {
            alert('FTW');
        };
        $.ajax({
            url: "/login",
            data: accountData,
            success: loginSuccess
        });
    });
	
	$("#findbutton").on('click', function () {
		var url = "/" + $("#path").get(0).value,
		
			showStatus = function (response) {
				replaceInner(response);	
			};
		
		$.ajax({
			url: url,
			success: showStatus	
		});
		
	});
	
}(jQuery))
