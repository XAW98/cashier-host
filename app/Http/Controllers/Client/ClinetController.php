<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;

class ClinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        try{
            $client = Client::
            where('id',$request->client_id)
            ->with('payments')
            ->with('Cashiers')
            ->with('cards')
            ->get()
            ->toArray();
            return response()->json($client, 200);
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
    public function create()
    {
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
        $client = $request->all();
        try{
            Client::create([
                // 'id' => ,
                'full_name' => $client['full_name'],
                'email' => $client['email'],
                'phone' => $client['phone'],
                'password' => $client['password']
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
            $client = Client::findOrFail($id);
            if(!$client){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($client, 200);
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
            $client = Client::findOrFail($id);
            if(!$client){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($client, 200);
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
            $client = Client::findOrFail($id);
            if(!$client){
             return response()->json(['error' => 'error'],404);
            }

            $client->update([
                'full_name' => $request['full_name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'password' => $request['password']
            ]);
            return response()->json($client,200);
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
            $client = Client::findOrFail($id);
            if(!$client){
             return response()->json(['error' => 'error'],404);
            }

            $client->delete();
            return response(['success' => 'success'],200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
        }
    }
}
