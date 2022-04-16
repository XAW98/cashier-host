<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\UserConfirmMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class ActivationAccountController extends Controller
{

    public function check(Request $request)
    {
        // dd($request->all());
        return Inertia::render('Auth/ActivationAccount',$request->all());
    }

    public function verify(Request $request)
    {
        // dd($request->verification_code);
        try{
            $user = User::find(Auth::user()->id);
            if($user->verification_code == $request->verification_code){
                $user->account_state = 1;
                $user->save();
                return redirect('/dashboard');
            }
            return redirect()->route("activation.check",["error"=>"the code is note match"]);

        }
        catch(Exception $e){
            return redirect()->route("activation.check",["error"=>$e]);
        }

    }

    public function resendCode(Request $request){

        try{
            $user = User::find(Auth::user()->id);
            if(!$user){
                return redirect()->route("activation.check",["message"=>"User Note Found"]);
            }

            $user->verification_code = rand(1000, 9999);
            $user->save();

            $user_data = [
                'url' => $request->getSchemeAndHttpHost() . '/activation/verify/' . $user->id.'/'.$user->verification_code,
                'img_src' => 'C:\wamp64\www\cashier-host\public\img\logo.png',
                'verification_code' => $user->verification_code
                ];
            Mail::to($user->email)->send(new UserConfirmMail($user_data));
            return redirect()->route("activation.check",["message"=> 'The Email Is Send']);

        }
        catch(Exception $e){
            return redirect()->route("activation.check",["error"=>$e]);
        }

    }

}
