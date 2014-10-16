<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<link href="<?php echo ROOT_PATH; ?>css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo ROOT_PATH; ?>css/style.css" rel="stylesheet" />
	<title> Projekt </title>
</head>
<body>
<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo ROOT_PATH; ?>">Home</a></li>
            <li><a href="<?php echo \core\Routes::getRoute('blogg', 'main'); ?>">Blogg</a></li>
            <li><a href="<?php echo \core\Routes::getRoute('instagram', 'main'); ?>"> Instagram</a></li>
            <li><a href="<?php echo \core\Routes::getRoute('twitter', 'main'); ?>"> Twitter</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login ----- <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li>
            			<div class="login">
            			<?php echo $authRenderVar; ?>
        				</div>
                </li>
              </ul>
            </li>
          </ul>


        </div>
      </div>
    </div>

	<div class="jumbotron">
    <div class="container">
      <div class="row">
        <div clas="col-md-12">
          <h1> 
            <?php 
              $titel = isset($titel) ? $titel : "Du har glömt att sätta titel";
              echo $titel 
            ?>
          </h1>
        </div>
      </div>
    </div>
    </div>
    <div class="container">
    <?php echo $layoutdata; ?> 
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo ROOT_PATH; ?>js/bootstrap.min.js"></script>
</body>
</html>
