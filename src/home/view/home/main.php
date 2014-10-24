<secion>
	<div class="container">
		<div class="row text-center ">
		<h1 class="arrow"> Twitter feed </h1>
		<?php
		foreach ($tweets as $key => $tweet) {?>
			<div class="col-md-4 wp2 delay-2s animated fadeInUp">
				<img src="<?php echo ROOT_PATH; ?>img/tweet.png" alt="tiwtter image">
				<h2><?php echo $tweet->getName(); ?></h2>
				<p><?php echo $tweet->getText(); ?></p>
				<h5><?php echo $tweet->getScreenName(); ?></h5> 
			</div> 
		<?php } ?>
		</div>
	</div>
</secion>
<section class="swag text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>Blog feed <span>blogg and <em> Instagram </em></span></h1>
        <a href="#portfolio" class="down-arrow-btn"><i class="fa fa-chevron-down"></i></a>
      </div>
    </div>
  </div>
</section>
<section>
<div class="container">
<?php
$i = 0; 
foreach ($flow as $flowPost) {
	if($i == 0){?>
		<div class="row">	
	<?php }?>
	
	<div class="col-md-4">
		<?php if(get_class($flowPost) == "blogg\model\instagram\InstagramPost"){?>
			<a href="" data-toggle="modal" data-target=".<?php echo $flowPost->getUnique(); ?>">
			<img src="<?php echo $flowPost->getLowResolutionUrl(); ?>" alt="Instagram image">
			</a>
				<div class="modal fade <?php echo $flowPost->getUnique(); ?>" tabindex="-1" role="dialog" aria-hidden="true">
				  <div class="instagrampopup">
				    <div class="">
				    	<img src="<?php echo $flowPost->getStandardResolutionUrl(); ?>" alt="Instagram image">
				    </div>
				  </div>
		  		</div>
		<?php } else { ?>
			<h1 class="bloggTitle" ><a href="<?php echo \core\Routes::getRoute('blogg', 'view') . $flowPost->getId(); ?>"> <?php echo $flowPost->getTitel(); ?></a></h1>
			<p class="bloggtext min">
				<?php echo substr($flowPost->getText(), 0, 120); ?>
			</p>	

			<h5>Skrivet: <?php echo gmdate("Y-m-d H:i:s", $flowPost->getTime()); ?></h5>
		<?php }?>
	</div>


	<?php
	$i = 1 + $i;
	if($i == 3){
		$i = 0;
		?> </div> <?php
	}
}?>
</div>
</section>
