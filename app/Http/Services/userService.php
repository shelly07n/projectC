<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \DateTime;




class userService
{

    public function getUsers()
    {
        return User::all()->toArray();
    }
}
