<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(Card::where('id',1)->with('payments')->get()->toArray());
        try{
            $cards = Card::
            where('id',$request->client_id)
            ->with('payments')
            ->get()
            ->toArray();
            return response()->json($cards, 200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $card = $request->all();
        // Card::create([
        //     // 'id' => ,
        //     'type' => $card['type'],
        //     'number' => $card['number'],
        //     'cvv' => $card['cvv'],
        //     'expiration_date' => $card['expiration_date'],
        //     'client_id' => $card['client_id']
        // ]);
        // return response()->json(['success_message' => "success"],200);
        return response([], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $card = $request->all();
        try{
            Card::create([
                // 'id' => ,
                'type' => $card['type'],
                'number' => $card['number'],
                'cvv' => $card['cvv'],
                'expiration_date' => $card['expiration_date'],
                'client_id' => $card['client_id']
            ]);
            return response()->json(['success_message' => "success"], 200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
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
        try{
            $card = Card::findOrFail($id);
            if(!$card){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($card, 200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $card = Card::findOrFail($id);
            if(!$card){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($card, 200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
        }

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
        try{
            $card = Card::findOrFail($id);
            if(!$card){
             return response()->json(['error' => 'error'],404);
            }

            $card->update([
                 'type' => $request['type'],
                 'number' => $request['number'],
                 'cvv' => $request['cvv'],
                 'expiration_date' => $request['expiration_date'],
                 'client_id' => $request['client_id']
            ]);
            return response()->json($card,200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
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
        try{
            $card = Card::findOrFail($id);
            if(!$card){
             return response()->json(['error' => 'error'],404);
            }

            $card->delete();
            return response(['success' => 'success'],200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
        }
    }
}
