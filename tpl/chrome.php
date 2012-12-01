<html>
   <head>
        <?php include 'tpl/meta.php' ?>    
        <style>
            <?php include 'css/global.css' ?>
        </style>
   </head>
 <body>
    <?php if (Session::isLoggedIn()) { ?>
        <a href="javascript:void(0);" id="logoutbutton">Logout</a>|
        <a href="javascript:void(0);" id="adminbutton">Admin</a>
    <? } else { ?>
        <a href="/signup">Signup</a>
    <? } ?>
    <a href="/about">About</a>
	<div id="inner" data-path="<?= $path ?>"> 
    	<?php include 'modules/populateInner.php' ?>
	</div>	
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        <?php include 'js/global.js'?>
    </script>
    <?php // include 'tpl/googleAnalytics.php' ?>
 </body>
</html>

