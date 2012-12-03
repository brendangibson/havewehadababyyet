<a href="/index_page.php">Home</a>

<?php if (Session::isLoggedIn()) { ?>
    <a href="javascript:void(0);" id="logoutbutton">Logout</a>
    <? if($statusPage) { ?>
        <a href="javascript:void(0);" id="adminbutton">Admin</a>
    <? } ?>
<? } else { ?>
    <a href="/signup">Signup</a>
<? } ?>
<a href="/about">About</a>