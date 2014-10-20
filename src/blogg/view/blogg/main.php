<?php
	foreach ($posts as $post) {
		include("view.php"); 
	} 
	if($pagingPrev === 0 && $pagingNext === $numberOfPostsPerPage){?>
		Föregående sida
	<?php } else {?>
		<a href="<?php echo \core\Routes::getRoute('blogg', 'main') . $pagingPrev; ?>"> Föregående sida</a>
	<?php } 
		for ($i=0; $i < 5; $i++) { 
			$nextPosts = $pagingPrev + $numberOfPostsPerPage  * $i; 
			if($nextPosts > $numberOfPostsInDb){
				break; 
			} ?>
			<a href="<?php echo \core\Routes::getRoute('blogg', 'main') . $nextPosts; ?>"> <?php echo intval($nextPosts/$numberOfPostsPerPage + 1); ?></a>
	<?php }
	
	if($numberOfPostsPerPage <= count($posts)){?>
		<a href="<?php echo \core\Routes::getRoute('blogg', 'main') . $pagingNext; ?>"> Nästa sida</a>
	<?php } else{ ?>
			Nästa sida
	<?php } ?>
