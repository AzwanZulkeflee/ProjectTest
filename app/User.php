<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password','name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function Employee(){
        return $this->belongsTo('App\Models\AppEmpEmployee', 'id','user_id');
    }

    public function role(){
        return $this->hasOne('App\Models\AppAccRole','id','app_acc_role_id');
    }

    public function hasRole($roles){

        //get role of user
        $this->have_role = $this->getuserRole();

        //check if user is super admin which can control everything
        if($this->have_role->name === 'superadmin'){
            return true;
        }

        if(is_array($roles)){
            foreach ($roles as $need_role) {
                if($this->checkIfUserHasRole($need_role)){
                    return true;
                }
            }
        }
        else{
            if($this->checkIfUserHasRole($roles)){
                    return true;
                }
        }

        
        return false;
    }

    public function getUserRole(){
        return $this->role()->getResults();
    }

    public function checkIfUserHasRole($need_role){
        return (strtolower($need_role)==strtolower($this->have_role->name)) ? true : false;
    }

    public static function checkRole($roles){
        return $this::hasRole($roles);
    }

}
