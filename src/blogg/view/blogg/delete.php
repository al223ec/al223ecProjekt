<div class="row bloggpost">
	<div class="col-md-7">
		<h1><?php echo $post->getTitel(); ?></a></h1>
		<p>
			<?php 
				echo $post->getText();
			?>
		</p>
		<h5>Skrivet: <?php echo gmdate("Y-m-d H:i:s", $post->getTime()); ?> '</h5>

		<?php if($userIsLoggedIn === true) {?>
		<p>
		    <a href="<?php echo \core\Routes::getRoute('blogg', 'deleteConfirmed') . $post->getId(); ?>"> Bekräfta borttagning! </a>;
		    <a href="<?php echo \core\Routes::getRoute('blogg', 'main') ?>"> Avbryt </a>;
        </p>
        <?php }?>

	</div>
	<div class="col-md-5">
		placeholder för bild, kanske kan välja en instagram bild? 
	</div>
	<div class="col-md-12">
		<hr>
	</div>
</div>