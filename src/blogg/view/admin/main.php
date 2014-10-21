<?php 

if($adminIsLoggedIn){?>
<div class="col-md-12">
	<h3>Användar inställningar</h3>
	<hr>
	<ul>
	<?php
		foreach ($userArray as $user) {?>
			<li>	
				<?php echo $user; if($user->getIsAdmin()) echo " Administratör"; ?>
				<a class="btn btn-danger" href="<?php echo \core\Routes::getRoute('admin', 'deleteUser') . $user->getUserID(); ?>"> Ta bort</a>
			</li> 
		<?php } ?>
	</ul>
	<hr>
	</div>
	<?php
	include_once('new_user_form.php'); 
	}
?>

