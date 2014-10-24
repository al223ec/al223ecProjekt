<?php 
	if(!isset($post)){
		throw new \Exception("Blogg::View.php $post is not defiend!");
	}
	if(!isset($viewFullBloggPost)){
		$viewFullBloggPost = false; 
	}
	if($viewFullBloggPost){?>
	<section>
		<div class="container">
<?php } ?>
<div class="row bloggpost"> 
	<div class="<?php if($viewFullBloggPost) echo "col-md-10"; else echo "col-md-7";?>">
		<h1 class="bloggTitle"> <a href="<?php echo \core\Routes::getRoute('blogg', 'view') . $post->getId(); ?>"> <?php echo $post->getTitel(); ?></a></h1>
		<p class="bloggtext <?php if(!$viewFullBloggPost){ echo "min"; } ?>">
			<?php 
				if($viewFullBloggPost){
					echo $post->getText();
				}else{
					echo substr($post->getText(), 0, 120);
				}
			?>
		</p>
		<h5 >Skrivet: <?php echo gmdate("Y-m-d H:i:s", $post->getTime()) . " av: " . $post->getAuthor(); ?></h5>

		<?php if($userIsLoggedIn === true) {?>
		<p>
			<?php if($loggedInUserId == $post->getUserId() || $adminIsLoggedIn) {?>
				<a href="<?php echo \core\Routes::getRoute('blogg', 'edit') . $post->getId(); ?>"> Redigera</a>
			<?php }?>

			<?php if($adminIsLoggedIn) {?>  
	        	<a href="<?php echo \core\Routes::getRoute('blogg', 'delete') . $post->getId(); ?>"> Ta bort</a>
	        <?php }?>
	    </p>
	    <?php }?>

	</div>
	<div class="<?php if($viewFullBloggPost) echo "col-md-2"; else echo "col-md-5";?>">
		<img src="<?php echo ROOT_PATH; ?>img/blogg.png" alt="blogg image">
	</div>
	<div class="col-md-12">
		<hr>
	</div>
</div>
<?php if($viewFullBloggPost){?>
		</div>
	</section>
<?php } ?>