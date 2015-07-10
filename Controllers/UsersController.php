<?php
class UsersController extends BaseController{
    public function GetUsers(){
        // Fetch users from DB.
        $result = $this->GetDb()->query("SELECT `id`,`email`,`firstname`,`lastname`,`picture`,`age`,`isgod` FROM `uptotek_users`;");
        
        // If that failed, we got serious issues.
        if(!$result) return header(HEADER_500);
        
        // Create an big fat array from all those users.
        while($data = $result->fetch_assoc()){
            $users[$data["id"]] = $data;
        }
        
        // Fetch the skills from DB.
        $result = $this->GetDb()->query("SELECT * from `uptotek_skills`");
        // Iterate through them.
        while($data = $result->fetch_assoc()){
            // Push them to an array (skills) on the single user object.
            $users[$data["userid"]]["skills"][] = $data["skill"];
        }
        
        return $this->Json(array_values($users));
    }
    
    public function GetUser($userid){
        
        // Fetch user form DB.
        $userid = $this->GetDb()->real_escape_string($userid);
        $result = $this->GetDb()->query("SELECT `id`,`email`,`firstname`,`lastname`,`picture`,`age`,`isgod` FROM `uptotek_users` WHERE `id` = $userid;");
        
        // Do we have exactly 1 user?
        if($result->num_rows == 1){
            
            // Create an array from the result.
            $user = $result->fetch_array();            
            // Remove those satanistic array entries with an numerical key.
            foreach($user as $key => $val){
                if(is_numeric($key)) unset($user[$key]);
            }
            
            // Get the users skills.
            $result = $this->GetDb()->query("SELECT * from `uptotek_skills` WHERE `userid` = $userid");
            // Iterate through them.
            while($data = $result->fetch_assoc()){
                // Add them to the user object.
                $user["skills"][] = $data["skill"];
            }  
            
            return $this->Json($user);   
        }else{
            // The users does not exist - 404.
            return header(HEADER_404);        
        }        
    }
}
