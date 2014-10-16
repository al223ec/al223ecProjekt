<?php
	foreach ($posts as $post) {
		include("view.php"); 
	} 

	if($userIsLoggedIn === true){
		$post = null; 
		include_once("create.php"); 
	}
?>
