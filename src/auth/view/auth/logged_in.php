<h3><?php if(isset($loggedInUserName)) echo $loggedInUserName; ?> är inloggad </h3>
<?php echo $message; ?>
<a class="btn btn-default" href="<?php echo \core\routes::getRoute('auth','logout'); ?>">Logga ut</a>