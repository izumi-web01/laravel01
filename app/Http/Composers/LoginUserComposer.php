<?php
namespace App\Http\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
// use Illuminate\Support\Facades\View;

class LoginUserComposer {
    public function compose(View $view){
        $loginUser = null;
        if(Auth::check()){
            $login = Auth::user();
            $loginUser = [
                // 'loginUser' => $loginUser,
                'name' => $login->name,
                'email' => $login->email,
                'id' => $login->id,
            ];
            $view->with([
                'loginUser'=>$loginUser
            ]);
        }else{
            print 'ログインしていません<br>';
            $guestUser  = 'ゲスト';
            $view->with([
                'guestUser'=>$guestUser
            ]);
        }
        
    }
}