<?php

namespace core; 

class View{
/**
*otestad funktionalitet, 
*tänkt att fungera som grupperade felmeddelanden inspiation från Andreas
*/
	protected static $messageError = 'error';
	protected static $messageSuccess = 'success';
	protected static $messageWarning = 'warning';

	protected $strMessagesKey = 'View::strMessagesKey';
		
	public function addMessage($strMessage, $strType){
		$_SESSION[$this->strMessagesKey][$strType][] = $strMessage;
	}
	protected function renderFlash(){
		$arrTypes = (isset($_SESSION[$this->strMessagesKey])) ? $_SESSION[$this->strMessagesKey] : array();
		$messagesHtml = '';
		foreach($arrTypes as $type => $arrMessages){
			$strMessages = '';
			foreach($arrMessages as $strMessage){
				$strMessages .= '<span class="flash-message flash-' . $type . '">' . $strMessage . '</span>';
			}
			$messagesHtml .= '<p class="flash" />' . $strMessages . '</p>';
		}
		unset($_SESSION[$this->strMessagesKey]);
		return $messagesHtml;
	}

	protected function getInput($inputName){
		return isset($_POST[$inputName]) ? $_POST[$inputName] : '';
	}
	protected function getCleanInput($inputName) {
		return isset($_POST[$inputName]) ? $this->sanitize($_POST[$inputName]) : '';
	}
	protected function sanitize($input) {
        $temp = trim($input);
        return filter_var($temp, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    }		
    //Flytta denna?? 
    public function redirect(){
		header('Location: ' . ROOT_PATH);
    }
}