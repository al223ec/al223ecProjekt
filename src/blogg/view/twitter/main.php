
<div class="row twitter">
<?php
foreach ($tweets as $tweet) {?>
	<div class="col-lg-4">
		<img src="/img/'tweet.png" alt="tiwtter image">

		<h2><?php echo $tweet->getName(); ?></h2>
		<p><?php echo $tweet->getText(); ?></p>
		<h5><?php echo $tweet->getScreenName(); ?></h5> 
	</div> 
<?php } ?>
</div>
<hr>