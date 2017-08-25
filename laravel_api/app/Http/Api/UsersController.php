<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Test;

class UsersController extends Controller
{
    use Helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return json_encode(Test::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "create view";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $valid=$this->valid($request->all());
        if($valid->fails()){
            return $this->response->error($valid->errors(),400);
        }
        else{
            
            $ret=Test::create([
                    'title'=>$request->title,
                    'content'=>$request->content,
                    'tag'=>$request->tag
                ]);
            if($ret){
                return $this->sendSuccessResponse("Create Success",201);
            }
            else{
                return $this->sendFailResponse("Create Fail",500);
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return json_encode(Test::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return "edit view";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data=Test::findOrFail($id);
        $valid=$this->valid($request->all());
        if($valid->fails()){
            return $this->sendFailResponse($valid->errors(),400);
        }
        else{
            $data->title=$request->title;
            $data->content=$request->content;
            $data->tag=$request->tag;
            if($data->save()){
                return $this->sendSuccessResponse("Update Success",201);
            }
            else{
                return $this->sendFailResponse("Update Fail",500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Test::destroy($id)===1){
            return $this->sendSuccessResponse("Delete Success",201);
        }else{
            return $this->sendFailResponse("Delete Fail",500);
        }
    }
    protected function valid($data)
    {
        return Validator::make($data,[
                'title'=>'required|max:30|unique:tests',
                'content'=>'required',
            ]);
    }
    protected function sendSuccessResponse($message,$status_code)
    {
        return $this->response->array([
                'message'=>$message,
                'status_code'=>$status_code
            ]);
    }
    protected function sendFailResponse($message,$status_code)
    {
        return $this->response->error($message,$status_code);
    }
    public function refresh()
    {
        $old_token=JWTAuth::gettoken();
        $new_token=JWTAuth::refresh($old_token);
        JWTAuth::invalidate($old_token);
        return $this->response->array([
                'token'=>$new_token,
                'status_code'=>201
            ]);
    }
}
