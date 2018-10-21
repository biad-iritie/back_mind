<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use Illuminate\Http\Request;
use App\Http\Requests\AchatRequest;
use App\Models\Operateur;
use App\Models\Ticket;
use App\Models\Ticket_buy;

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
        //dd("index");
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

        $operateur = Operateur::find($request->operateur_id);
        $tickets = $request->tickets;
        //dd($tickets[0]['nbr_ticket']);

        try {

            //Transaction 
        $montant_total = 0;
        //calcul du montant total
        for ($i = 0; $i < sizeof($tickets); $i++) {
            $ticket = Ticket::find($tickets[$i]['ticket_id']);
            //var_dump($tickets[$i]['nbr_ticket'] * (int)$ticket['prix_tick']);
            $montant_total = $montant_total + ((int)$tickets[$i]['nbr_ticket'] * (int)$ticket['prix_tick']);
            if ($tickets[$i]['nbr_ticket'] > $ticket->qte_rest_tick) {
            $code = 1; 
            $msg="Désolé les tickets sont probablement terminés";
            $data=null;
            return $this->retour($code, $msg, $data);
            }
        }
        //APPEL DE L API DE LOPERATEUR
        //dd($montant_total );
        $num_trans = date("jny") . rand(0, 10000);

        $montant_total = 0;
        for ($i = 0; $i < sizeof($tickets); $i++) {
            $achat = new Achat();
            $achat->user_id = $request->user_id;
            $achat->operateur_id = $request->operateur_id;
            $achat->numero_achat = $request->numero_achat;
            $achat->numero_transaction = $num_trans;
            $achat->status_achat = true;

            $ticket = Ticket::find($tickets[$i]['ticket_id']);
            $ticket->qte_rest_tick = (int)$ticket['qte_rest_tick'] - (int)$tickets[$i]['nbr_ticket'];
            $ticket->save();
            for ($j = 0; $j < $tickets[$i]['nbr_ticket']; $j++) {
                Ticket_buy::create(array(
                    'user_id' => $request->user_id,
                    'ticket_id' => $tickets[$i]['ticket_id'],
                    'event_id' => (int)$ticket['evenement_id'],
                    'receveur_id' => 0,
                    'numero_transaction' => $achat->numero_transaction,
                    'qrcode' => $achat->numero_transaction . $tickets[$i]['ticket_id'] . rand(0, 10000),
                    'statut' => false
                ));
            }
            $achat->ticket_id = $tickets[$i]['ticket_id'];
            $achat->nbr_ticket = (int)$tickets[$i]['nbr_ticket'];
            $achat->montant_achat = $achat->montant_achat + ((int)$tickets[$i]['nbr_ticket'] * (int)$ticket['prix_tick']);

            $achat->save();
            


            $code = 0;
            $msg = 'Achat éffectué';
            $data = null;




        }
        return $this->retour($code, $msg, $data);
        } catch (QueryException $e) {
            $code = 1; 
            $msg="Les tickets sont probablement terminés";
            $data=null;
            return $this->retour($code, $msg, $data);
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

    protected function retour($code, $msg = null, $data)
    {

        //var_dump($token);
        return response()->json([
            'code' => $code,
            'message' => $msg,
            'data' => $data
            //'expires_in' =>  auth()->factory()->getTTL() * 60
        ]);
    }
}
