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
			            <li class="active"><a href="'.  \core\Routes::getRoute('blogg', 'main'). '">Home</a></li>
			            <li><a href="'.  \core\Routes::getRoute('instagram', 'main'). '"> Instagram</a></li>
			            <li><a href="'.  \core\Routes::getRoute('twitter', 'main'). '"> Twitter</a></li>
			          </ul>


			        </div><!--/.nav-collapse -->
			      </div>
			    </div>

				<div class="jumbotron">
				' . $masterPage->getPageHeader() .'
			    </div>
			    <div class="container">
			      	<div class="row">
						<div class="col-md-10">
				    	'. $masterPage->getTwitterView() . $masterPage->getBloggView() . $masterPage->getInstagramView() . ' 
				    	</div>
	        			<div class="col-md-2">
						'  . $masterPage->getAuthView() . ' 
						</div>		
					</div>
       				<div class="row">
	 					<div class="col-md-12">
						 '
						 . $masterPage->getBloggFormView() .'
						 </div>
 					 </div>
				</div>
			</body>
			</html>
		';
	}
}