<?php

namespace Framework;

class Authorisation
{
    public static function isOwner($resourceId)  
    {  
        $sessionUser = Session::get('user');  
      
        if ($sessionUser !== null && isset($sessionUser['id'])) {  
            $sessionUserId = (int)$sessionUser['id'];  
            return $sessionUserId === $resourceId;  
        }  
      
        return false;  
    }

    public function isAuthenticated()  
{  
    return Session::has('user');  
}

public function handle($role)  
{  
    if ($role === 'guest' && $this->isAuthenticated()) {  
        return redirect('/');  
    }  
  
    if ($role === 'auth' && !$this->isAuthenticated()) {  
        return redirect('/auth/login');  
    }  
}
}
