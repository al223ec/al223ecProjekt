<?php
namespace auth\view\auth; 

class UserView extends \auth\view\ViewBase{

	// Skickar rättmeddelandet till setSessionMessage.
	public function successfullLogIn(){
		$this->model->setSessionReadOnceMessage("Inloggningen lyckades!");
	}

	// Skickar rättmeddelandet till setSessionMessage.
	public function successfullLogInWithCookiesSaved(){
		$this->model->setSessionReadOnceMessage("Inloggningen lyckades och vi kommer ihåg dig nästa gång!");
	}

	// Skickar rättmeddelandet till setSessionMessage.
	public function successfullLogInWithCookiesLoad(){
		$this->model->setSessionReadOnceMessage("Inloggningen lyckades via cookies!");
	}

	// Slutlig presentation av utdata.
	public function showUser(){
		$user = $this->model->getLoggedInUser();
		$ret = "<h2>Du är nu inloggad!</h2>";
		
		$ret .= $this->getMessage();
		$ret .= "
					<form action='". \core\routes::getRoute('auth','logout') . "' method='post' >
					<input type='submit' value='Logga ut' name=''>
					</form>
				";		

		return $ret;
	}


}