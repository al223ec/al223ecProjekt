<h1>Instagram main</h1>
<?php 
foreach ($images as $image) {?>
<img src="<?php echo $image->getLowResolutionUrl(); ?>" alt="Instagram image">	
<?php } ?>
