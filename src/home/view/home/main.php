<div class="row twitter">
<?php
foreach ($tweets as $tweet) {?>
	<div class="col-lg-4 tweet">
		<img src="<?php echo ROOT_PATH; ?>img/tweet.png" alt="tiwtter image">
		<h2><?php echo $tweet->getName(); ?></h2>
		<p><?php echo $tweet->getText(); ?></p>
		<h5><?php echo $tweet->getScreenName(); ?></h5> 
	</div> 
<?php } ?>
</div>
<hr>

<?php
$i = 0; 
foreach ($flow as $flowPost) {
	if($i == 0){?>
		<div class="row padding_bottom">	
	<?php }?>
	
	<div class="col-md-4">
		<?php if(get_class($flowPost) == "blogg\model\instagram\InstagramPost"){?>
			<a href="" data-toggle="modal" data-target=".<?php echo $flowPost->getUnique(); ?>"><img src="<?php echo $flowPost->getLowResolutionUrl(); ?>" alt="Instagram image"></a>
				<div class="modal fade <?php echo $flowPost->getUnique(); ?>" tabindex="-1" role="dialog" aria-hidden="true">
				  <div class="instagrampopup">
				    <div class="">
				    	<img src="<?php echo $flowPost->getStandardResolutionUrl(); ?>" alt="Instagram image">
				    </div>
				  </div>
		  		</div>
		<?php } else { ?>
			<h1><a href="<?php echo \core\Routes::getRoute('blogg', 'view') . $flowPost->getId(); ?>"> <?php echo $flowPost->getTitel(); ?></a></h1>
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

