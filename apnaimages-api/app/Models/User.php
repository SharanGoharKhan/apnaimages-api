<?php namespace App\Models;

use App\Models\Root;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Root implements AuthenticatableContract{

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    protected $appends = array('full_name');
    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'access_token', 'token_expired','verification_code'];

	/*
		Always store password in a hash
	*/
	public function setPasswordAttribute($value){
    $this->attributes["password"] = \Hash::make($value);
    }
     /**
	 *	Check the format of email while creating a user
     */
    public function setEmailAttribute($value){
        if(!(filter_var($value, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $value))){
            \App::abort(403, "Email is not in a valid format");
        }
        $this->attributes["email"] = $value;
    }
    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] .' '. $this->attributes['last_name'];
    }
User::creating(function($user){
	//Check for email if exists. If exists than return HTTPException
    
	$test = User::whereEmail($user->email)->first(); 
    if($test){
        \App::abort(403, "Email address already exists");
    }
    $user->verification_code = md5($user->email . rand(10000,99999));
    return true; 
});