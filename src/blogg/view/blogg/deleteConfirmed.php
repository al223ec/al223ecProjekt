<div class="row bloggpost">
	<div class="col-md-7">
		<h1>Bekfräftad borttagning!</h1>
		<p>
			Posten  <?php echo $post->getTitel(); ?> har tagits bort!
		</p>
		<?php if($userIsLoggedIn === true) {?>
		<p>
		    <a href="<?php echo \core\Routes::getRoute('blogg', 'main') ?>"> Tillbaka</a>
        </p>
        <?php }?>
	</div>
	<div class="col-md-5">
	
	</div>
	<div class="col-md-12">
		<hr>
	</div>
</div>