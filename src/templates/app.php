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
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo \core\Routes::getRoute('home', 'main'); ?>">Anton - ytterligare en blogg</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li <?php if($active == "home") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('home', 'main'); ?>">Home</a></li>
          <li <?php if($active == "blogg") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('blogg', 'main'); ?>">Blogg</a></li>
          <li <?php if($active == "instagram") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('instagram', 'main'); ?>"> Instagram</a></li>
          <li <?php if($active == "twitter") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('twitter', 'main'); ?>"> Twitter</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login </a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <div class="login">
                <?php if(isset($authRenderVar)) echo $authRenderVar; ?>
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
              $pageTitel = isset($pageTitel) ? $pageTitel : "";
              echo $pageTitel;
            ?>
          </h1>
        </div>
      </div>
    </div>
    </div>
    <div class="container main">
    <?php
      if(isset($userIsLoggedIn) && $userIsLoggedIn === true){
          include_once(SRC_DIR . "templates" . DS . "admin" . DS . "admin_nav.php"); 
      }
      if(!isset($layoutdata)){
        throw new \Exception("Template: App.php you have to always define layoutdata! Plz see base view");        
      }
      echo $layoutdata; 
    ?> 
	 </div>
    <div class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo ROOT_PATH; ?>js/bootstrap.min.js"></script>
</body>
</html>
