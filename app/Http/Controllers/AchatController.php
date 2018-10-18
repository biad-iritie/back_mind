<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use Illuminate\Http\Request;
use App\Http\Requests\AchatRequest;
use App\Models\Operateur;
use App\Models\Ticket;

class AchatController extends Controller
{
    //protected $user;

    public function __construct()
    {
        //$this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(AchatRequest $request)
    {
        $achat = new Achat();
        $operateur = Operateur::find($request->operateur_id);
        //Api de l operateur
        //var_dump($request);
        var_dump($request->tickets);
        $tickets = $request->tickets;
        $achat->user_id = $request->user_id;
        $achat->operateur_id = $request->operateur_id;
        $achat->numero_achat = $request->numero_achat;
        $achat->numero_transaction = $request->numero_transaction;
        $achat->status_achat = $request->status_achat;
        for ($i = 0; $i < sizeof($tickets); $i++) {
            $ticket = Ticket::find($request->ticket_id);
            $achat->ticket_id = $request->ticket_id;
            $achat->nbr_ticket = $request->nbr_ticket;
            $achat->montant_achat = $request->nbr_ticket * $ticket['prix_tick'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function show(Achat $achat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function edit(Achat $achat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Achat $achat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Achat $achat)
    {
        //
    }
}
