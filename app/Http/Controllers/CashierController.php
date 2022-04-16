<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use Exception;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $cashier = Cashier::
            where('client_id', $request->cashier_id)
            ->with('client')
            ->get()
            ->toArray();
            return response()->json($cashier, 200);
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
        $cashier = $request->all();
        try{
            Cashier::create([
                // 'id' => ,
                'name' => $cashier['name'],
                'email' => $cashier['email'],
                'password' => $cashier['password'],
                'domain' => $cashier['domain'],
                'domain_type' => $cashier['domain_type']
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
            $cashier = Cashier::findOrFail($id);
            if(!$cashier){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($cashier, 200);
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
            $cashier = Cashier::findOrFail($id);
            if(!$cashier){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($cashier, 200);
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
        $cashier = $request->all();
        try{
            $cashier = Cashier::findOrFail($id);
            if(!$cashier){
             return response()->json(['error' => 'error'],404);
            }

            $cashier->update([
                'name' => $cashier['name'],
                'email' => $cashier['email'],
                'password' => $cashier['password'],
                'domain' => $cashier['domain'],
                'domain_type' => $cashier['domain_type']
            ]);
            return response()->json($cashier,200);
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
            $cashier = Cashier::findOrFail($id);
            if(!$cashier){
             return response()->json(['error' => 'error'],404);
            }

            $cashier->delete();
            return response(['success' => 'success'],200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
        }
    }
}
