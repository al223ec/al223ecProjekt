<?php

namespace blogg\model\admin; 

class BloggSettings extends SettingsObject{
//De för bestämda värdena används för att återställa detta objekt
	protected $data = array(
		"bloggNumberOfBloggPostsPerPage" => 10,
		"dbPassword" => "",
		"dbUserName" => "root",
		"dbName" => "project",
		"dbIpAddress" => "127.0.0.1"
	); 

    protected $elementName = "bloggSettings"; 

    public function __construct(){
    	$this->data["connectionString"] = "mysql:host=". $this->data["dbIpAddress"] .";dbname=". $this->data["dbName"];
    }
}	