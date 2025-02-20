<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

trait AuthTrait
{
    protected $loginUser;
    protected $loginUserName;
    protected $loginUserId;
    protected $loginUserMail;

    

    public function getLoginUser()
    {
        $this->loginUser = Auth::user();
        // if($this->loginUser){
        //     $this->loginUserName = $this->loginUser->name;
        //     $this->loginUserId = $this->loginUser->id;
        //     $this->loginUserMail = $this->loginUser->email;
        //     View::share('loginUser', $this->loginUser);
        //     View::share('loginUserName', $this->loginUserName);
        //     View::share('loginUserId', $this->loginUserId);
        //     View::share('loginUserMail', $this->loginUserMail);

        // }
        
        return $this->loginUser;
    }
    
}