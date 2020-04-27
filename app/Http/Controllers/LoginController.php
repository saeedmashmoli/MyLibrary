<?php

namespace App\Http\Controllers;

use App\Activationcode;
use App\Events\UserActivation;
use App\Http\Helpers\Sms;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginsController extends Controller
{
    public function login(Request $request){
        if (Auth::attempt(array('username' => $request->username, 'password' => $request->password))){
            if (auth()->user()->status == 0 || auth()->user()->delete == 1){
                Auth::logout();
                return 'Status Failed';
            }
            return "Success";
        }
        else {
            return "Wrong";
        }
    }
    public function logout(Request $request){
        Auth::guard();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }
    public function error(){
        return view('errors.404');
    }
    public function register(Request $request){

        if (User::where('username',$request->username)->first())
            return 'UniqueUsername';
        if (!is_numeric($request->mobile) || (strlen($request->mobile) != 11))
            return 'NumericMobile';
        if (User::where('mobile',$request->mobile)->first())
            return 'UniqueMobile';
        if (trim($request->username) == null || trim($request->password) == null || $request->gender_id ==null)
            return 'Required';
        if ($request->password != $request->confirmPassword)
            return 'Wrong';
        $request->merge(['role_id' => 2,'password' => bcrypt($request->input('password'))]);

        $user = User::create($request->all());
        $user->status = 0;
        $user->save();
        event(new UserActivation($user,null));
        $type =1;

        return view('PartialViews.confirmRegsiter',compact('user','type'));

    }
    public function forgetPasswordModal(){
        $type = 2;
        return view('PartialViews.confirmRegsiter',compact('type'));
    }
    public function forgetPassword(Request $request){
        if (trim($request->mobile) == null || trim($request->password) == null || trim($request->confirmPassword) == null )
            return 'Required';
        $user = User::whereMobile($request->mobile)->first();
        if (!is_numeric($request->mobile) || (strlen($request->mobile) != 11 || !$user) )
            return 'NumericMobile';
        if ($user->delete == 1)
            return 'Delete';
        if ($request->password != $request->confirmPassword)
            return 'Wrong';

        $user->password = bcrypt($request->password);
        $user->status = 0;
        $user->save();
        event(new UserActivation($user,null));
        $type = 1;
        return view('PartialViews.confirmRegsiter',compact('user','type'));
    }
    public function confirmRegister(Request $request){
        $code = Activationcode::whereCode($request->code)->first();
        if (!$code)
            return 'Wrong';
        if ($code->expire < Carbon::now())
            return 'Expired';
        $code->used = 1;
        $user = $code->user;
        $user->status = 1;
        $user->save();
        Auth::login($user);
        return 'Success';
    }
    public function requestRegisterCode(Request $request){
        $code =  Activationcode::whereUserId($request->userId)->whereUsed(0)->where('expire','>',Carbon::now())->with('user')->first();

        if ($code)
            event(new UserActivation($code->user,$code->code));
        else
            event(new UserActivation($code->user,null));
        return 'Success';
    }
}
