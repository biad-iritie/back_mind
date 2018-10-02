<?php

namespace App\Http\Controllers;

use App\Models\Type_user;
use App\Http\Resources\Type_userResource;
use App\Http\Requests\Type_userRequest;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class Type_userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*  $type_user = new Type_user();
        $type_user ->lib_tuser = "Createur d'évènement";
        $type_user->save(); */
        
        return Type_userResource::collection(Type_user::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function create()
    {
        //
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Type_userRequest $request)
    {
    //var_dump("oki");
        return Type_user::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type_user  $type_user
     * @return \Illuminate\Http\Response
     */
    public function show(Type_user $type_user)
    {
        //return $type_user
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type_user  $type_user
     * @return \Illuminate\Http\Response
     */
    /* public function edit(Type_user $type_user)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type_user  $type_user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_user $type_user)
    {
        $type_user = Type_user::findOrFail($type_user->id);
        $type_user->lib_tuser = $request->input('lib_tuser');
        $type_user->save();
        //var_dump($type_user);
        return new Type_userResource($type_user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type_user  $type_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type_user $type_user)
    {
        if($type_user->delete()){
            return new Type_userResource($type_user);
        }/* else {
            var_dump("ok");
        } */
    }
}
