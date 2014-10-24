<?php 

namespace core\db; 

class DatabaseSetup {

	private $dbConnection; 
	private $settings; 

	public function __construct(){
		$this->settings = \core\Loader::load('blogg\model\admin\Settings')->getBloggSettings(); 
	}
	/**
	* @return PDO object, 
	*/
	protected function connection(){
		if($this->dbConnection == null){
			$this->dbConnection = new \PDO($this->settings->connectionString, $this->settings->dbUserName, $this->settings->dbPassword);
			if(\Config::DEBUG){
				$this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
		} 
		return $this->dbConnection; 
	}

	public function setUp(){

	}

	private function setUpUsersTable(){
		$sql ="CREATE TABLE IF NOT EXISTS `users` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `user_name` (`user_name`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;
		"; 
		$this->connection()->exec($sql); 
	}

	private function setUpBloggPostsTable(){
		$sql = " CREATE TABLE IF NOT EXISTS `bloggposts` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `titel` varchar(100)  CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `text` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `time` int(11) NOT NULL,
		  `user_id` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76;
		"; 
		$this->connection()->exec($sql); 
	}

}