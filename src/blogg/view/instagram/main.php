<section>
	<div class="container">
	<div class="row text-center ">
		<h1 class="arrow"> Instagram </h1>
		<hr>
	<?php 
	$index = 0; 

	foreach ($images as $image) {
		if($index == 0){?>
			<div class="row padding_bottom">
		<?php }?>
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
		<?php 

		$index += 1; 
		if($index > 2){
			$index = 0; 
			?> </div> <?php
		}
	} ?>
	</div>
	</div>
</section>