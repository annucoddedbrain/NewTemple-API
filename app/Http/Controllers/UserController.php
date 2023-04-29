<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\User;
//use Illuminate\Foundation\Auth\User;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        return response()->json($user);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            "first_name" => "string|min:3|required",
            "last_name" => "string|min:3",
            "email"     => "required|email|unique:users,email",
            "phone"     => "required|max:13|min:10",
            "password" => "required|min:8",
            "username" => "string|regex:/\w*$/|min:6|unique:users,username"
        ];
        $validator = Validator::make($request->all(), $rules);
        

        if ($validator->fails())
        {
            return response()->json([
                "status" => false,
                "message" => "There is something error while registering.",
                "errors" => $validator->errors()
            ]);

        }

        $input = $request->all();
        $input['password']= bcrypt($input['password']);
        $user = User::create($input);

        $success ['first_name'] = $user->first_name;
        $success ['last_name'] = $user->last_name;
        $success ['username'] = $user->username;
        $success ['email'] = $user->email;
        $success ['phone'] = $user->phone;
        $success ['password'] = $user->password;
        $success['remember_token'] =$user->createToken(env("APP_TOKEN", ''))->plainTextToken;


                    
        return response()->json([
            "status" => true,
            "message" => "User has been registered successfully.",
            "data" => $success,
        ]);
        // else
        // {
        //     if($validator)
        //     {
        //         $user = new User;
        //         $user->first_name=$request->first_name;
        //         $user->last_name=$request->last_name;
        //         $user->username=$request->username;
        //         $user->email=$request->email;
        //         $user->phone=$request->phone;
        //         $user->password=$request->bcrypt('password');

        //         $user->remember_token = $user->createToken(env("APP_TOKEN", ''))->plainTextToken;

               

        //         if($user)
        //         {
        //             $userdata = Auth::user();

        //             return response()->json([
        //             "status" => true,
        //             "message" => "User has been registered successfully.",
        //             "data" => $user,
        //             'authorisation' => [
        //                 'token' => $user->remember_token,
        //                 'type' => 'bearer',
        //             ]
        //             ]);
        //         } 
        //         else
        //         {
        //             return response()->json([
        //             "message" => "error"
        //             ]);
        //          } 
        //     }
        // }
    }

    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email,'password' => $request->password]))
        {
            return response()->json([
            "status" => true,
            "message" => "User has been login successfully.",
            "data" =>Auth::user(),
        ]);
        }else{
            return response()->json([
                "status" => false,
                "message" => " error ",
            ]);
        }
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
    }
}
