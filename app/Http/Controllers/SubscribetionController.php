<?php

namespace App\Http\Controllers;

use App\Models\Subscribetion;
use Exception;
use Illuminate\Http\Request;

class SubscribetionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $subscribetion = Subscribetion::
            with('payments')
            ->with('features')
            ->get()
            ->toArray();
            return response()->json($subscribetion, 200);
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
        $subscribetion = $request->all();
        try{
            Subscribetion::create([
                // 'id' => ,
                'name_ar' => $subscribetion['name_ar'],
                'name_en' => $subscribetion['name_en'],
                'name_tr' => $subscribetion['name_tr'],
                'price' => $subscribetion['price'],
                'period' => $subscribetion['period']
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
            $subscribetion = Subscribetion::findOrFail($id);
            if(!$subscribetion){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($subscribetion, 200);
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
            $subscribetion = Subscribetion::findOrFail($id);
            if(!$subscribetion){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($subscribetion, 200);
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
            $subscribetion = Subscribetion::findOrFail($id);
            if(!$subscribetion){
             return response()->json(['error' => 'error'],404);
            }

            $subscribetion->update([
                'name_ar' => $request['name_ar'],
                'name_en' => $request['name_en'],
                'name_tr' => $request['name_tr'],
                'price' => $request['price'],
                'period' => $request['period']
            ]);
            return response()->json($subscribetion,200);
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
            $subscribetion = Subscribetion::findOrFail($id);
            if(!$subscribetion){
             return response()->json(['error' => 'error'],404);
            }

            $subscribetion->delete();
            return response(['success' => 'success'],200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
        }
    }
}
