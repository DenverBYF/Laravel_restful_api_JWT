<?php

namespace App\Http\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
	use RegistersUsers;
	use Helpers;

	public function register(Request $request)
    {
    	$valid=$this->valid($request->all());
    	if($valid->fails()){
    		$this->sendFailResponse($valid->errors());
    	}
    	else{
    		$user=User::create([
    				'name'=>$request->name,
    				'email'=>$request->email,
    				'password'=>bcrypt($request->password)
    			]);
    		if($user){
    			$token=JWTAuth::fromuser($user);
    			return $this->response->array([
		            "token" => $token,
		            "message" => "Registration Success",
		            "status_code" => 201
		       	]);
    		}
    		else{
    			$this->sendFailResponse("Register Error");
    		}
    	}
    }
    public function valid($data)
    {
    	return Validator::make($data,[
    		'name'=>'required|unique:users|max:10',
    		'email'=>'required|unique:users|email',
    		'password'=>'required|min:6']);
    }
    public function sendFailResponse($message)
    {
    	return $this->response->error($message,400);
    }

}
