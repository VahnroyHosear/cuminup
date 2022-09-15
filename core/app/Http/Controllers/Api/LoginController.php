<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Settings;
use App\Models\Audit;
use Carbon\Carbon;
use Session;
use Redirect;
use DB;
class LoginController extends Controller
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
        $this->middleware('guest');
        $this->middleware('guest:user');
    }

    public function login()
    {
		$data['title']='Login';
        return view('/auth/login', $data);
    } 
    
    public function submitlogin(Request $request)
    {
        $set=$data['set']=Settings::first();
        if($set->recaptcha==1){
            $validator = Validator::make($request->all(), [
                //'email' => 'required|string',
                'password' => 'required',
                //'g-recaptcha-response' => 'required|captcha'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                //'email' => 'required|string',
                'password' => 'required'
            ]);
        }
        if ($validator->fails()) {
            
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }
        
        if(strpos($request->email, '@') !== false){
            dd("Word Found!");
            } else{
                dd("Word Not Found!");
            }
        
        $remember_me = $request->has('remember_me') ? true : false; 
        if (Auth::guard('user')->attempt([
            'email' => $request->email,
            
            'password' => $request->password
            ], $remember_me)) {
        	$ip_address=user_ip();
        	$user=User::whereid(Auth::guard('user')->user()->id)->first();
        	if($ip_address!=$user->ip_address && $set['email_notify']==1){
    			send_email($user->email, $user->username, 'Suspicious Login Attempt', 'Sorry your account was just accessed from an unknown IP address<br> ' .$ip_address. '<br>If this was you, please you can ignore this message or reset your account password.');
        	}
	        $user->last_login=Carbon::now();
	        $user->last_login_ip=$user->ip_address;
	        $user->ip_address=$ip_address;
	         if($request->device_id)
	        {
	          $user->device_id = $request->device_id;
	        }
            $user->save();
            if($user->fa_status==1){
                return redirect()->route('2fa');
            }else{
                if(Session::has('oldLink')){
                    return Redirect::to(Session::get('oldLink'));
                }else{
                    if($user->kyc_status == 1 && $user->verify_ssn != NULL && $user->verify_ein != NULL)
                    {
                        return response()->json(['status'=>'1','response'=>'Login successfully.','data'=>$user], 200);
                        //return redirect()->route('user.newdashboard');
                    } else {
                        return response()->json(['status'=>'1','response'=>'Login successfully.','data'=>$user], 200);
                        //return redirect()->route('user.profile');
                    }
                    
                }

            }
            
        } else {
            $i=1;
            Session::put('wrong_attempt_email',$request->email);
            $count = Session::get('wrong_attempt_count');
            Session::put('wrong_attempt_count',$i+$count);
            if(Session::get('wrong_attempt_count') >= '3')
            {
               $userdata = DB::table('users')->where('email',$request->email)->first();
               if($userdata)
               {
                  $ip_address = $_SERVER['REMOTE_ADDR']; 
            	send_email($request->email, $userdata->first_name, 'Account Blocked', 'Dear '.$userdata->first_name.',<br> Due to unusual login attempt, your account has been blocked Please <a href="mailto:support@getvirtualcard.co.uk">Get in touch</a> with us. <br><br>Please contact our support team- support@getvirtualcard.co.uk');
                $user=User::find($userdata->id);
                $user->status=1;
                $user->save();
                   
               }
                   
            }
            $i++;
            return response()->json(['status'=>'0','response'=>'Oops! You have entered invalid credentials.'], 400);
        	//return back()->with('alert', 'Oops! You have entered invalid credentials')->withInput($request->only('email', 'remember'));
        }

    }
    
    public function submitloginphone(Request $request)
    {
        $set=$data['set']=Settings::first();
        if($set->recaptcha==1){
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'password' => 'required',
                'device_id'=>'required',
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'password' => 'required',
                'device_id'=>'required'
            ]);
        }
        if ($validator->fails()) {
            // adding an extra field 'error'...
            $data['title']='Login';
            $data['errors']=$validator->errors();
            return view('/auth/login', $data);
        }
        $remember_me = $request->has('remember_me') ? true : false; 
        
        
        if($request->prefix)
        {
            $getdtls = DB::table('countries')->where('id',$request->prefix)->first();
        }
        
        
        
        if (Auth::guard('user')->attempt([
            'phone_iso' => $getdtls->iso_code,
            'phone' => $request->phone, 
            'password' => $request->password
            ], $remember_me)) {
        	$ip_address=user_ip();
        	$user=User::whereid(Auth::guard('user')->user()->id)->first();
        	if($ip_address!=$user->ip_address && $set['email_notify']==1){
    			send_email($user->email, $user->username, 'Suspicious Login Attempt', 'Sorry your account was just accessed from an unknown IP address<br> ' .$ip_address. '<br>If this was you, please you can ignore this message or reset your account password.');
        	}
	        $user->last_login=Carbon::now();
	        $user->ip_address=$ip_address;
	        if($request->device_id)
	        {
	          $user->device_id = $request->device_id;
	        }
            $user->save();
            if($user->fa_status==1){
                return redirect()->route('2fa');
            }else{
                if(Session::has('oldLink')){
                    return Redirect::to(Session::get('oldLink'));
                }else{
                    return redirect()->route('user.dashboard');
                }

            }
            
        } else {
        	return back()->with('alert', 'Oops! You have entered invalid credentials')->withInput($request->only('phone', 'remember'));
        }

    }

}
