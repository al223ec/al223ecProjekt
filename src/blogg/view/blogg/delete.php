<section>
	<div class="container">		
		<div class="row bloggpost">
			<div class="col-md-9">
				<h1 class="bloggTitle"><?php echo $post->getTitel(); ?></a></h1>
				<p>
					<?php 
						echo $post->getText();
					?>
				</p>
				<h5>Skrivet: <?php echo gmdate("Y-m-d H:i:s", $post->getTime()); ?> '</h5>
				<h3> Detta kommer att ta bort det här inlägget! </h3>
				<?php if($userIsLoggedIn === true) {?>
				<p>
				    <a href="<?php echo \core\Routes::getRoute('blogg', 'deleteConfirmed') . $post->getId(); ?>"> Bekräfta borttagning! </a>
				    <a href="<?php echo \core\Routes::getRoute('blogg', 'main') ?>"> Avbryt </a>
		        </p>
		        <?php }?>

			</div>
			<div class="col-md-3">
				<img src="<?php echo ROOT_PATH; ?>img/blogg.png" alt="blogg image">
			</div>
			<div class="col-md-12">
				<hr>
			</div>
		</div>
	</div>
</section>