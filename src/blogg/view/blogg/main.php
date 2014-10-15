<?php
	foreach ($posts as $post) {
		include("view.php"); 
	} 

if($userIsLoggedIn === true){
		include_once("create.php"); 
}
?>
