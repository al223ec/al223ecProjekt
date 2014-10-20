admin view
<?php 
	if($adminIsLoggedIn){?>
	<ul>
		<?php
		foreach ($userArray as $user) {?>
			<li><?php echo $user; ?></li> 
		<?php } ?>
	</ul>
		<?php
		include_once('new_user_form.php'); 
	}
?>