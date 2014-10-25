<section>
<div class="container">
<div class="row bloggpost">
	<div class="col-md-12">
		<?php if(isset($deleteFailed)){ ?>
		<h1>Ett oväntat fel har inträffat!</h1>
		<p> <?php echo $deleteFailed; ?></p> 
		<?php } else {?>

		<h1>Bekfräftad borttagning!</h1>
		<p>
			Posten  <?php echo $post->getTitel(); ?> har tagits bort!
		</p>
		<?php }
		 if($userIsLoggedIn === true) {?>
		<p>
		    <a href="<?php echo \core\Routes::getRoute('blogg', 'main') ?>"> Tillbaka</a>
        </p>
        <?php }?>
	</div>
</div>
</div>
</section>