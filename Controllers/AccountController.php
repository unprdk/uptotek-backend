<?php
class AccountController extends BaseController{
    public function Login($username,$password){
        
        // Escape the username.
        $email = $this->GetDb()->real_escape_string($username);
        // Hash the password
        $pass = md5($password);
        
        // Fetch the user from DB.
        $usercheck = $this->GetDb()->query("SELECT `id`,`email` FROM `uptotek_users` WHERE `email` = '$email' AND `password` = '$pass';");
        // Do we have exactly 1 user?
        if($usercheck->num_rows == 1){
            
            // Create an array from the user result;
            $user = $usercheck->fetch_array();
            
            // Do we have a token?
            $token = $this->GetDb()->query("SELECT * FROM `uptotek_accesstokens` WHERE `userid` = $user[id] AND `expires` > ".time()." LIMIT 1;");
            if($token->num_rows == 1){
                
                // Existing token.                
                $token = $token->fetch_array();
                $output["userid"] = $user["id"];
                $output["token"] = $token["token"];
            }else{
                
                // New token.
                $token = base64_encode($user["email"]."//".microtime().rand(1,100));
                // Set the expire date 7 days from now.
                $expires = time() + (3600*24)*7;
                $this->GetDb()->query("INSERT INTO `uptotek_accesstokens` (`token`,`userid`,`expires`) VALUES('$token',$user[id],$expires);");
                
                $output["userid"] = $user["id"];
                $output["token"] = $token;
            }
            
            return $this->Json($output);
        }else{
            // We didn't have a matching user..
            $output["token"] = null;
            return $this->Json($output);
        }        
    }
}