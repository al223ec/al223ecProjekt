<?php

class HTMLView{
	public function echoHTML($masterPage){
		if($masterPage === NULL){
			throw new \Exception('HTMLView::echoHTML does not allow body to be null');
		}

		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="UTF-8">

				<link href="' . ROOT_PATH . 'css/bootstrap.min.css" rel="stylesheet" />
				<link href="' . ROOT_PATH . 'css/style.css" rel="stylesheet" />
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
			            <li class="active"><a href="'.  ROOT_PATH . '">Home</a></li>
			            <li><a href="'.  \core\Routes::getRoute('blogg', 'main'). '">Blogg</a></li>
			            <li><a href="'.  \core\Routes::getRoute('instagram', 'main'). '"> Instagram</a></li>
			            <li><a href="'.  \core\Routes::getRoute('twitter', 'main'). '"> Twitter</a></li>
			            <li class="dropdown">
			              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login ----- <span class="caret"></span></a>
			              <ul class="dropdown-menu" role="menu">
			                <li>
		        			<div class="login">
							'  . $masterPage->getAuthView() . ' 
							</div>
			                </li>
			              </ul>
			            </li>
			          </ul>


			        </div>
			      </div>
			    </div>

				<div class="jumbotron">
				' . $masterPage->getPageHeader() .'
			    </div>
			    <div class="container">
				    	'. 
				    	$masterPage->getView().
				    '
				</div>

			    <!-- Bootstrap core JavaScript
			    ================================================== -->
			    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			    <script src="'. ROOT_PATH .'js/bootstrap.min.js"></script>
			</body>
			</html>
		';
	}
}
/*
	$masterPage->getBloggView() . 
				    	$masterPage->getInstagramView() . 
				    	$masterPage->getBloggFormView() 
*/				    	