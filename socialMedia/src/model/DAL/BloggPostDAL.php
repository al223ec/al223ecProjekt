<?php

namespace DAL; 

require_once(ROOT_DIR . "/src/model/DAL/DBConfig.php"); 
require_once(ROOT_DIR . "/src/model/BloggPost.php"); 

class BloggPostDAL{
	
	private $mysqli;

	public function __construct(){
		$this->mysqli = new \mysqli(DBConfig::DB_CONNECTION, DBConfig::DB_USERNAME, DBConfig::DB_PASSWORD, DBConfig::DB_NAME);
	}
    //Implementera paginering
    public function getBloggPosts() {
        $ret = array();
 
        $sql = "SELECT * FROM ". DBConfig::TBL_NAME ." ORDER BY BloggPostID DESC";

        //(SELECT * FROM ". DBConfig::TBL_NAME . "ORDER BY BloggPostID DESC LIMIT 10) AS `table` ORDER by BloggPostID ASC "; 
 
        //http://www.php.net/manual/en/mysqli-stmt.prepare.php
        $statement = $this->mysqli->prepare($sql);
        if ($statement === FALSE) {
            throw new \Exception("prepare of $sql failed " . $this->mysqli->error);
        }
 
        //http://www.php.net/manual/en/mysqli-stmt.execute.php
        if ($statement->execute() === FALSE) {
            throw new \Exception("execute of $sql failed " . $statement->error);
        }
 
        //http://www.php.net/manual/en/mysqli-stmt.get-result.php
        $result = $statement->get_result();
             
        //http://www.php.net/manual/en/mysqli-result.fetch-array.php
        while ($object = $result->fetch_array(MYSQLI_ASSOC))
        {
	 		$ret[] = new \model\BloggPost(
                $object["UserID"],
                $object["Author"],
                $object["Titel"],
                $object["Text"], 
                $object["Time"], 
                $object["BloggPostID"]);
        }
 
        return $ret;
    }

    public function saveBloggPost(\model\BloggPost $bloggPost){
        $userID = $bloggPost->getUserID(); 
        $author = $bloggPost->getAuthor(); 
        $titel = $bloggPost->getTitel(); 
        $text = $bloggPost->getText(); 
        $time = $bloggPost->getTime(); 
        //$text

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }   
        $sql = "INSERT INTO bloggposts(UserID, Author, Titel, `Text`, Time) VALUES ( ?, ?, ?, ?, ?)";
        $statement = $this->mysqli->prepare($sql);

        if ($statement === FALSE) {
            throw new \Exception("prepare of $sql failed " . $this->mysqli->error);
        }   
        $statement->bind_param("isssi", $userID, $author, $titel, $text, $time); 

        //http://www.php.net/manual/en/mysqli-stmt.execute.php
        if ($statement->execute() === FALSE) {
            throw new \Exception("execute of $sql failed " . $statement->error);
        }
        return true;//Allt har gått väl
    }

    public function deleteBloggPost($bloggPostID){
        if(!is_numeric($bloggPostID) || $bloggPostID < 1){
            throw new \Exception("BloggPostDAL::deletePost wrong argument sent");            
        }

        $sql = "DELETE FROM " . DBConfig::TBL_NAME . " WHERE BloggPostID = ?";
        $statement = $this->mysqli->prepare($sql);

        if ($statement === FALSE) {
            throw new \Exception("prepare of $sql failed " . $this->mysqli->error);
        }   
        $statement->bind_param("i", $bloggPostID); 

        //http://www.php.net/manual/en/mysqli-stmt.execute.php
        if ($statement->execute() === FALSE) {
            throw new \Exception("execute of $sql failed " . $statement->error);
        }
 
        return true; 
    }

    public function updatePost(\model\BloggPost $bloggPost){
        if($bloggPost === null){
            throw new \Exception("BloggPostDAL::updatePost wrong argument sent");            
        }
        $author = $bloggPost->getAuthor(); 
        $titel = $bloggPost->getTitel(); 
        $text = $bloggPost->getText(); 
        $time = $bloggPost->getTime(); 

        $sql = "UPDATE " . DBConfig::TBL_NAME . " SET Author = ?, Titel = ?, `Text` = ?, Time = ? WHERE BloggPostID = ?";
        $statement = $this->mysqli->prepare($sql);

        if ($statement === FALSE) {
            throw new \Exception("prepare of $sql failed " . $this->mysqli->error);
        }   
        $statement->bind_param("sssi", $cookieValue, $cookieExpiration, $bloggPostID); 

        //http://www.php.net/manual/en/mysqli-stmt.execute.php
        if ($statement->execute() === FALSE) {
            throw new \Exception("execute of $sql failed " . $statement->error);
        }
        return true; 
    }
}