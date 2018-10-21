<?php

namespace App\Http\Controllers;

use App\Models\Type_event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        var_dump($user);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type_event  $type_event
     * @return \Illuminate\Http\Response
     */
    public function show(Type_event $type_event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type_event  $type_event
     * @return \Illuminate\Http\Response
     */
    public function edit(Type_event $type_event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type_event  $type_event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_event $type_event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type_event  $type_event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type_event $type_event)
    {
        //
    }
}
