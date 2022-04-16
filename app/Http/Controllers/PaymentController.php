<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $payment = Payment::
            with('subscribetion')
            ->with('card')
            ->with('client')
            ->get()
            ->toArray();
            return response()->json($payment, 200);
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
        $payment = $request->all();
        try{
            Payment::create([
                // 'id' => ,
                'price' => $payment['price'],
                'date_of_pay' => $payment['date_of_pay'],
                'card_id' => $payment['card_id'],
                'subscribetion_id' => $payment['subscribetion_id'],
                'client_id' => $payment['client_id']
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
            $payment = Payment::findOrFail($id);
            if(!$payment){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($payment, 200);
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
            $payment = Payment::findOrFail($id);
            if(!$payment){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($payment, 200);
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
            $payment = Payment::findOrFail($id);
            if(!$payment){
             return response()->json(['error' => 'error'],404);
            }

            $payment->update([
                'price' => $payment['price'],
                'date_of_pay' => $payment['date_of_pay'],
                'card_id' => $payment['card_id'],
                'subscribetion_id' => $payment['subscribetion_id'],
                'client_id' => $payment['client_id']
            ]);
            return response()->json($payment,200);
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
            $payment = Payment::findOrFail($id);
            if(!$payment){
             return response()->json(['error' => 'error'],404);
            }

            $payment->delete();
            return response(['success' => 'success'],200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
        }
    }
}
