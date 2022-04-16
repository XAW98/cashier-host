<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Exception;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $feature = Feature::
            with('subscribes_features')
            ->get()
            ->toArray();
            return response()->json($feature, 200);
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
        $feature = $request->all();
        try{
            Feature::create([
                // 'id' => ,
                'name_ar' => $feature['name_ar'],
                'name_en' => $feature['name_en'],
                'name_tr' => $feature['name_tr']
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
            $feature = Feature::findOrFail($id);
            if(!$feature){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($feature, 200);
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
            $feature = Feature::findOrFail($id);
            if(!$feature){
                return response()->json(['error' => 'error'], 404);
            }
            return response()->json($feature, 200);
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
            $feature = Feature::findOrFail($id);
            if(!$feature){
             return response()->json(['error' => 'error'],404);
            }

            $feature->update([
                'name_ar' => $request['name_ar'],
                'name_en' => $request['name_en'],
                'name_tr' => $request['name_tr']
            ]);
            return response()->json($feature,200);
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
            $feature = Feature::findOrFail($id);
            if(!$feature){
             return response()->json(['error' => 'error'],404);
            }
            
            $feature->delete();
            return response(['success' => 'success'],200);
        }
        catch(Exception $e){
            return response()->json(['error' => 'error' . $e], 400);
        }
    }
}
