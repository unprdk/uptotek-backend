<?php
abstract class BaseController {    
    // The field where we store our mysqli object.
    private $db;
    
    // Getter for out $db, which makes use of instantiation pattern.
    public function GetDb(){
        if($this->db == null){
            $this->db = new mysqli(MYSQL_HOST, MYSQL_NAME, MYSQL_PASS, MYSQL_DB);
        }
        return $this->db;
    }
    
    // Return array as json.
    public function Json($array){
        return json_encode($array,JSON_NUMERIC_CHECK);
    }
    
    public function Authorize($token){
        // Fetch token from DB.        
        $token = $this->GetDb()->real_escape_string($token);
        $token = $this->GetDb()->query("SELECT * FROM `uptotek_accesstokens` WHERE `token` = '$token' AND `expires` > ".time()." LIMIT 1;");
        
        // Do we have exactly one token?
        if($token->num_rows == 1){
            return true;
        }
        
        // If we got this far, we have an invalid token.
        return false;
    }
}
