<h3>Detta kommer permantent ta bort användren <?php echo $user; ?></h3>
<a class="btn btn-danger" href="<?php echo \core\Routes::getRoute('admin', 'deleteConfirmed') . $user->getUserId(); ?>"> Bekräfta <a>
<a class="btn btn-success" href="<?php echo \core\Routes::getRoute('admin', 'main'); ?>"> Avbryt <a>
