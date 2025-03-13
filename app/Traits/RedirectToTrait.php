<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RedirectToTrait {
    public function getRedirectTo() {
        $loginUser = Auth::user();
        $redirectTo = $loginUser ? '/tasks' : 'sample';
        return $redirectTo;
    }
}