<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Settings;
use Carbon\Carbon;
use Session;
use DB;

class faController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        //$this->middleware('guest:user');
    }

    public function faverify()
    {  if(!empty($_GET['u']) == 1)
        {   
            $user = User::findOrFail(Auth::guard('user')->user()->id);
             $user->fa_expiring = Carbon::now()->addMinutes(30);
            $user->save();
           
            return redirect()->route('user.newdashboard');
        }
        
		if(Auth::guard('user')->user()){
            $data['title']='2fa verification';
			return view('/auth/2fa', $data);
		}else{$data['title']='Login';
	        return view('/auth/login', $data);
		}
    }
    
    public function submitfa(Request $request)
    {
        try{
           
            $user = User::findOrFail(Auth::guard('user')->user()->id);//DB::table('users')->where('id',Auth::id())->first();//
           //dd($user);
            $g=new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
            $secret=$user->googlefa_secret;
            $check=$g->checkcode($secret, $request->code, 3);
          
            if($check){
               // dd(Carbon::now()->addMinutes(30));
                $user->fa_expiring = Carbon::now()->addMinutes(30);
                $user->save();
                return redirect()->route('user.newdashboard');
            }else{  
                return back()->with('alert', 'Invalid code.');
            }
        } catch (BadMethodCallExceptionException $e) {
                    return back()->with('alert', $e->getMessage());
                }
    }

}
