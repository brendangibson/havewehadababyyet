
<img class="main_logo" src="/images/HWHABY_logo_300dpi.png">
<form action="">
    <div class="searchBox">
        Who: <input type="text" id="path"/>
        <input type="button" value="Find" id="findbutton"/>
    </div>
    <div class="accountButtons">
        <?
            $text = "Sign Up";
            $id = "signup";
            include "tpl/button.php";
        ?>
        
        <?
            $text = "Log In";
            $id = "login";
            include "tpl/button.php";
        ?>
    </div>
    <? include "tpl/signupPane.php"; ?>
</form>
