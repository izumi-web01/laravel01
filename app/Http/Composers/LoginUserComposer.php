<?php
namespace App\Http\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
// use Illuminate\Support\Facades\View;

class LoginUserComposer {
    public function compose(View $view){
        $loginUser = null;
        if(Auth::check()){
            print 'ログインしています<br>';
            $loginUser = Auth::user();
            $loginUser = [
                'loginUser' => $loginUser,
                'name' => $loginUser->name,
                'email' => $loginUser->email,
                'id' => $loginUser->id,
            ];
        }else{
            print 'ログインしていません<br>';
        }
        $view->with('loginUser', $loginUser);
    }
}