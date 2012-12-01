(function($) {

	var SELECTOR_INNER = "#inner",
        $inner = $("#inner"),
    
        replaceInner = function (html) {
		$inner.hide();
		$inner.html(html);
		$inner.show();
		
	},
		goToPath = function (path, forcePage, admin) {
            requestPath = path;
            if (admin) {
                requestPath += "/admin";    
            }
			
            var showStatus = function (response) {
				replaceInner(response);
                $inner.data('path', path);
			},
			url = "/" + requestPath + (forcePage ? '' : '?np=1');
            if (forcePage) {
                location.href = url;    
            } else {
        		$.ajax({
    				url: url,
    				success: showStatus	
    			});
            }
		},
		
		goToHome = function () {
			$.ajax({
				url: "/home",
				success: replaceInner
			});
		},
		
		showLoginError = function () {
            $("#loginmessage").html("Can't login");	
		};
	
    $("#createAccount").on('click', function () {
        var accountData = {
            path: $("#username").get(0).value,
            username: $("#username").get(0).value,
            p: $("#password").get(0).value
        },
        onError = function () {
            $("#message").html("Could not create account");        
        },
        onSuccess = function (data) {
            if (data && data.success) {
                goToPath(accountData.path, true);
            } else {
                onError();
            }
        };
        $.ajax({
            url: "/createaccount",
            data: accountData,
            dataType: "json",
            success: onSuccess 
        });
    });

    $("#loginbutton").on('click', function () {
        var accountData = {
            username: $("#username").get(0).value,
            p: $("#password").get(0).value
        },
        loginSuccess = function (data) {
            if (data && data.success) {
                if (data.path) {
                    location.href = "/" + data.path;	
                } else {
                    goToHome();
                }
            } else {
                showLoginError();
            }
        };
        $.ajax({
            url: "/login",
            data: accountData,
            success: loginSuccess,
            error: showLoginError,
            dataType: "json"
        });
    });
    
    $("#logoutbutton").on('click', function () {
        var onLogout = function () {
            location.reload(true);    
        };
        
        $.ajax({
            url: "/logout",
            success: onLogout,
            dataType: "json"
        });
    });
	
	$("#findbutton").on('click', function () {
		goToPath($("#path").get(0).value);
	});
    
    $("#bornbutton").on('click', function () {
        
        var path = $inner.data('path'), 
            data = {
                path: path,
                born: true
            },
            onError = function (data) {
                $("#updateMessage").html("Could not update");    
            },
            onSuccess = function (data) {
                if (data && data.success) {
                    goToPath(path);    
                } else {
                    onError();    
                }
            };
        
        
        $.ajax({
            url: "/update",
            data: data,
            dataType: "json",
            success: onSuccess,
            error: onError
        });
    });
    
    $("#adminbutton").on('click', function () {
        goToPath($inner.data('path'), false, true);
    });
	
}(jQuery));
