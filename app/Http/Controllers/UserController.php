<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required|email|unique:users'
        ]);
        if($validate->passes())
            return response()->json(User::create($request->all()));

        return response()->json(['errors'=>$validate->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user){
            return response()->json($user);
        }
        return response()->json(['error'=>'No se encontro el usuario']);
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
        $user = User::find($id);
        if($user){
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email'=> 'email|unique:users'
            ]);
            if($validate->passes()){
                $user->name = $request->name;
                if($request->has('email')){
                    $user->email = $request->email;
                }
                $user->save();
                return response()->json($user);
            }
            return response()->json(['errors'=>$validate->errors()]);
        }
        return response()->json(['error'=>'No se encontro el usuario']);
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
