<section>
	<div class="container">
		<div class="row text-center ">
		<h1 class="arrow"> Twitter feed </h1>
		<?php
		$i = 0; 
		foreach ($tweets as $key => $tweet) {?>
			<div class="col-md-4 wp2 <?php if($i === 1) { echo "delay-05s"; } if($i === 2) { echo "delay-1s"; } $i+=1; ?> animated fadeInUp">
				<img src="<?php echo ROOT_PATH; ?>img/tweet.png" alt="tiwtter image">
				<h2><?php echo $tweet->getName(); ?></h2>
				<p><?php echo $tweet->getText(); ?></p>
				<h5><?php echo $tweet->getScreenName(); ?></h5> 
			</div> 
		<?php } ?>
		</div>
	</div>
</section>
<section class="swag text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>Blog feed <span> <?php echo \date('Y/m/d'); ?></span></h1>
        <a href="#portfolio" class="down-arrow-btn"><i class="fa fa-chevron-down"></i></a>
      </div>
    </div>
  </div>
</section>
<section>
	<div class="container">
		<?php	
		foreach ($posts as $post) {?>
		<div class="row bloggpost animated fadeInUp"> 
			<div class="col-md-7">
				<h1 class="bloggTitle"> <a href="<?php echo \core\Routes::getRoute('blogg', 'view') . $post->getId(); ?>"> <?php echo $post->getTitel(); ?></a></h1>
				<p class="bloggtext min">
				<?php 
				echo substr($post->getText(), 0, 120);
				?>
				</p>
				<h5 >Skrivet: <?php echo gmdate("Y-m-d H:i:s", $post->getTime()) . " av: " . $post->getAuthor(); ?></h5>
			</div>
			<div class="col-md-5">
				<img src="<?php echo ROOT_PATH; ?>img/blogg.png" alt="blogg image">
			</div>
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		<?php } ?>
	</div>
</section>
<section>
	<div class="container">
		<div class="row text-center ">
		<h1 class="arrow"> Instagram </h1>
		<?php	
		foreach ($images as $image) {?>
			<div class="col-md-4">
				<a href="" data-toggle="modal" data-target=".<?php echo $image->getUnique(); ?>">
				<img src="<?php echo $image->getLowResolutionUrl(); ?>" alt="Instagram image">
				</a>
				<div class="modal fade <?php echo $image->getUnique(); ?>" tabindex="-1" role="dialog" aria-hidden="true">
				  <div class="instagrampopup">
				    <div class="">
				    	<img src="<?php echo $image->getStandardResolutionUrl(); ?>" alt="Instagram image">
				    </div>
				  </div>
				</div>
			</div>	
		<?php }?>
		<div class="col-md-12">
			<hr>
		</div>
	</div>
	</div>
</section>

