<section>
	<div class="container">
		<div class="row text-center">

		<h1 class="arrow"> Twitter </h1>
		<hr>
		<?php
		foreach ($tweets as $tweet) {?>
			<div class="col-md-4 wp2 delay-2s animated fadeInUp">
				<img src="<?php echo ROOT_PATH; ?>img/tweet.png" alt="tiwtter image">
				<h2><?php echo $tweet->getName(); ?></h2>
				<p><?php echo $tweet->getText(); ?></p>
				<h5><?php echo $tweet->getScreenName(); ?></h5> 
			</div> 
		<?php } ?>
		</div>
	</div>
</section>