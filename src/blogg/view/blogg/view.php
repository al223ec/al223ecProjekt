<?php 
	if(!isset($post)){
		throw new \Exception("Blogg::View.php $post is not defiend!");
	}
	if(!isset($viewFullBloggPost)){
		$viewFullBloggPost = true; 
	}
?>

<div class="row bloggpost">
	<div class="col-md-7">
		<h1> <a href="<?php echo \core\Routes::getRoute('blogg', 'view') . $post->getId(); ?>"> <?php echo $post->getTitel(); ?></a></h1>
		<p class="<?php if(!$viewFullBloggPost){ echo "bloggtextmin"; } else { echo "bloggtext"; } ?>">
			<?php 
				if($viewFullBloggPost){
					echo $post->getText();
				}else{
					echo substr($post->getText(), 0, 120);
				}
			?>
		</p>
		<h5>Skrivet: <?php echo gmdate("Y-m-d H:i:s", $post->getTime()); ?></h5>

		<?php if($userIsLoggedIn === true) {?>
		<p>
			<a href="<?php echo \core\Routes::getRoute('blogg', 'edit') . $post->getId(); ?>"> Redigera</a>
            <a href="<?php echo \core\Routes::getRoute('blogg', 'delete') . $post->getId(); ?>"> Ta bort</a>
        </p>
        <?php }?>
	</div>
	<div class="col-md-5">
		placeholder för bild, kanske kan välja en instagram bild? 
	</div>
	<div class="col-md-12">
		<hr>
	</div>
</div>