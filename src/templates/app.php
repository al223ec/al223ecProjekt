<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link href="<?php echo ROOT_PATH; ?>css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo ROOT_PATH; ?>css/font-awesome.css" rel="stylesheet" />
	<link href="<?php echo ROOT_PATH; ?>css/style.css" rel="stylesheet" />
  <link href="<?php echo ROOT_PATH; ?>css/queries.css" rel="stylesheet" />
  <link href="<?php echo ROOT_PATH; ?>css/animate.css" rel="stylesheet" />
	<title> Projekt </title>
</head>
<body>
  <!-- Fixed navbar -->
  <div class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand nav-mybrand" href="<?php echo \core\Routes::getRoute('home', 'main'); ?>">Anton<span> - ytterligare en blogg</span></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li <?php if(isset($active) && $active == "home") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('home', 'main'); ?>">Home</a></li>
          <li <?php if(isset($active) && $active == "blogg") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('blogg', 'main'); ?>">Blogg</a></li>
          <li <?php if(isset($active) && $active == "instagram") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('instagram', 'main'); ?>"> Instagram</a></li>
          <li <?php if(isset($active) && $active == "twitter") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('twitter', 'main'); ?>"> Twitter</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login </a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <div class="login">
                <?php 
                  if(isset($authRenderVar)) echo $authRenderVar;
                ?>
              </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
<section class="hero <?php if(isset($active) && $active == "home") echo "hero-home"; ?>">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center inner">
      <h1 class="animated fadeInDown">Antons <span> blogg</span></h1>
      <p class="animated fadeInUp delay-05s">
        <?php 
        $pageTitel = isset($pageTitel) ? $pageTitel : "Anton Ledström al223ec";
        echo $pageTitel;
        ?>
      </p>
      </div>
    </div>
  </div>
</section>
  <?php
    if(isset($userIsLoggedIn) && $userIsLoggedIn === true){
          include_once(SRC_DIR . "templates" . DS . "admin" . DS . "admin_nav.php"); 
      }
    if(!isset($layoutdata)){
      throw new \Exception("Template: App.php you have to always define layoutdata! Plz see base view");        
    }
    echo $layoutdata; 
  ?> 
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <ul class="links">
            <li <?php if(isset($active) && $active == "home") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('home', 'main'); ?>">Home</a></li>
            <li <?php if(isset($active) && $active == "blogg") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('blogg', 'main'); ?>">Blogg</a></li>
            <li <?php if(isset($active) && $active == "instagram") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('instagram', 'main'); ?>"> Instagram</a></li>
            <li <?php if(isset($active) && $active == "twitter") echo 'class="active"'; ?>><a href="<?php echo \core\Routes::getRoute('twitter', 'main'); ?>"> Twitter</a></li>
            </ul>
          </div>
          <div class="col-md-6 credit">
            <p>Utvecklad av <a href="http://www.antonledstrom.se/">Anton Ledstörm</a> designen av sidan hämtad från <a href="http://tympanus.net/codrops/"><em>Codrops</em></a></p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo ROOT_PATH; ?>js/bootstrap.min.js"></script>
</body>
</html>
