<div class="row">
	<div class="col-md-12">
		<?php 
		foreach ($images as $image) {?>
			<a href="" data-toggle="modal" data-target=".<?php echo $image->getUnique(); ?>"><img src="<?php echo $image->getLowResolutionUrl(); ?>" alt="Instagram image"></a>
			<div class="modal fade <?php echo $image->getUnique(); ?>" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="instagrampopup">
			    <div class="">
			    	<img src="<?php echo $image->getStandardResolutionUrl(); ?>" alt="Instagram image">
			    </div>
			  </div>
			</div>
		<?php } ?>
	</div>
</div>
