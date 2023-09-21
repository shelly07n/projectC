<?php

namespace App\Http\Controllers;

use App\Mail\mailSetup;
use Illuminate\Http\Request;

use App\Services\userService;
use Mail;


class userController extends Controller
{
    public function getUsers(){
     $isSent = \Mail::to('1mikeset23@gmail.com')->send(new mailSetup());
     return $isSent ? "mail sent" : "not sent";
    }

    public function createuser(userService $userService){
      return $userService->getUsers();
    }
}
