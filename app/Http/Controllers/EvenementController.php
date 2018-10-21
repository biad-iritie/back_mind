<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Http\Requests\EvenementRequest;
use Illuminate\Database\QueryException;
use App\Models\Ticket;
use JWTAuth;
use App\Http\Resources\EvenementResource;
use Storage;

class EvenementController extends Controller
{
    protected $user;

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
        $categorie = htmlspecialchars($_GET["cat"]) ;
 //dd();
        if($categorie == ""){
            return EvenementResource::collection(Evenement::all());
        }else {
            return EvenementResource::collection(Evenement::where('type_event_id','=',$categorie)->get());
        }

        
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
    public function store(EvenementRequest $request)
    {
        $code = null;
        $code_http = null;
        $msg = null;
        $event = null;
        /* $lien = $request->image->store(config('images.path'), 'public');
        dd($lien); */
        try {
            $tickets = $request->input('tickets');
            $image_str = explode(',', $request->input('image_event'));
            $meme = $image_str[0];
            $image = $image_str[1];
            
            $meme = explode("/", $meme);
			$meme = explode(";", $meme[1]);
            $type = $meme[0];
            $name_image = time().'.png';
            //var_dump(base64_decode($image));
            $result_upload = Storage::disk('public')->put($name_image,base64_decode($image));
            ///dd(storage_path('app/public/event').'/'.$name_image);
            //$im = base64_decode($image);
            //$path = $im->store(config('images.path'),'public');

            if ($request->input('type_user_id') == 1 && $result_upload) {
                if (sizeof($tickets) > 0) {
                    $evenement = new Evenement();
                    $evenement ->user_id =$request->input('user_id');
                    $evenement ->type_event_id =$request->input('type_event_id');
                    $evenement ->lib_event =$request->input('lib_event');
                    $evenement ->lieu_event =$request->input('lieu_event');
                    $evenement ->description_event =$request->input('description_event');
                    $evenement ->datedebut_event =$request->input('datedebut_event');
                    $evenement ->datefin_event =$request->input('datefin_event');
                    $evenement ->heuredebut_event =$request->input('heuredebut_event');
                    $evenement ->heurefin_event =$request->input('heurefin_event');
                    $evenement ->image_event =$name_image;
                    $evenement ->statut = true;


                    if ($evenement->save()) {

                        for ($i = 0; $i < sizeof($tickets); $i++) {
                            $ticket = new Ticket();
                            $ticket->evenement_id = $evenement->id;
                        //var_dump($tickets[$i]['categ_tick']);
                            $ticket->categ_tick = $tickets[$i]['categ_tick'];
                            $ticket->prix_tick = $tickets[$i]['prix_tick'];
                            $ticket->nbre_tick = $tickets[$i]['nbre_tick'];
                            $ticket->qte_ini_tick = $tickets[$i]['nbre_tick'];
                            $ticket->qte_rest_tick = $tickets[$i]['nbre_tick'];

                            $ticket->save();
                        }
                        $event = $evenement;
                        $code = 0;
                        $msg = 'Evènement crée avec succès';
                    }
                } else {
                    $code = 1;
                    $msg = 'Ajouté des tickets à votre évenement ';
                }

            } else {
                $code = 1;
                $msg = "Oups Désolé";
            };
            return $this->retour($code, $msg, $event, $code_http);
        } catch (QueryException $e) {
            return response()->json([
                'Désolé aucune suite'
            ]);
        }
        //var_dump(sizeof($tickets) );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function show(Evenement $evenement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function edit(Evenement $evenement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evenement $evenement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evenement $evenement)
    {
        //
    }

    protected function retour($code, $msg = null, $event = null, $code_http = null)
    {

        //var_dump($token);
        return response()->json([
            'code' => $code,
            'message' => $msg,
            'event' => $event
            //'expires_in' =>  auth()->factory()->getTTL() * 60
        ]);
    }
}
