<?php

function Route($url){
    // GET: /api/users
    if($url == "/api/users"){
        $controller = new UsersController;
        return $controller->GetUsers();
    }
    
    // GET: /api/users/{id}
    if(preg_match("^/api/users/.*$^",$url)){
        $controller = new UsersController;
        
        $url = explode("/",$url);
        $userid = $url[3];
        
        return $controller->GetUser($userid);
    }
    
    // POST: /api/login (email: {useremail}, password: {userpassword})
    if($url == "/api/account/login"){
        if(!$_POST["email"] AND !$_POST["password"]) die(header(HEADER_404));
        
        $controller = new AccountController;
        return $controller->Login($_POST["email"],$_POST["password"]);
    }
    
    return header(HEADER_404);
}