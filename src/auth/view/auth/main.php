<?php
	if($userIsLoggedIn){
		include('logged_in.php');
	} else { 
		include('login_form.php');
	}
?>