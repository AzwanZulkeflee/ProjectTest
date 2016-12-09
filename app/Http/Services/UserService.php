<?php

namespace App\Http\Services;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserService 
{
    public function save($data, $user=NULL)
    {
		$userdata = $data->user;
     
        if(is_null($user)){
            $user = User::firstOrNew(['email'=>$userdata['email']]);
        }

        $user->name = $userdata['name'];
        
        if(is_numeric($userdata['password']))
            $user->app_acc_role_id = $userdata['role_id'];

        if(!is_null($userdata['password']))
        	$user->password =  Hash::make($userdata['password']);
        
        $user->save();

        return $user;
    }

   
}