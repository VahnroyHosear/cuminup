<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Settings;
use App\Models\Audit;
use App\Models\Referral;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\Bank;
use Image;
use Carbon\Carbon;
use Session;
use DB;
class ApiUserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

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

    public function register(Request $request)
    {
        // echo request()->headers->get('referer');
        
        // if(isset($_SERVER['HTTP_REFERER']))
        // {
        //     $allowed_host = 'cuminup.com';
        //     $host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        
        //     if(substr($host, 0 - strlen($allowed_host)) == $allowed_host) {
        //       echo "yes";
        //     } else {
        //       echo "no";
        //     }
        // }
        // die('helo');
        $data['title']='Register';
        return view('/auth/register', $data);
    }    
    
    public function submitregister(Request $request)
    {  
        $set=Settings::first();
        if($set->recaptcha==1){
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'business_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                 'phone' => 'required|unique:users',
                'password' => 'required|string|min:6',
                //'g-recaptcha-response' => 'required|captcha'
            ]);        
        }else{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'business_name' => 'required|string|max:255',
                'phone' => 'required|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
        }
        if ($validator->fails()) {
            // adding an extra field 'error'...
            //$data['title']='Register';
            //$data['errors']=$validator->errors();
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }

        $basic = Settings::first();

        if ($basic->email_verification == 1) {
            $email_verify = 0;
        } else {
            $email_verify = 1;
        }

        if ($basic->sms_verification == 1) {
            $phone_verify = 1;
        } else {
            $phone_verify = 1;
        }
        $verification_code = strtoupper(Str::random(6));
        $sms_code = strtoupper(Str::random(6));
        $email_time = Carbon::parse()->addMinutes(5);
        $phone_time = Carbon::parse()->addMinutes(5);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->business_name = $request->business_name;
        $user->email = $request->email;
        $user->email_verify = $email_verify;
        $user->image = 'person.jpg';
        $user->verification_code = $verification_code;
        $user->email_time = $email_time;
        $user->balance = $basic->balance_reg;
        $user->ip_address = user_ip();
        $user->signup_ip = user_ip();
        $user->password = Hash::make($request->password);
        
        if($request->prefix)
        {
            $getdtls = DB::table('countries')->where('id',$request->prefix)->first();
        }
        $user->prefix = $getdtls->calling_code;
        $user->phone_iso = $getdtls->iso_code;
        $user->phone = $request->phone;
        $user->source_from = $request->source_from;
        $user->business_country = $request->business_country;
        
        $user->save();


        if ($basic->email_verification == 1) {
            $text = "Before you can start accepting payments, you need to confirm your email address. Your email verification code is <b>".$user->verification_code."</b>";
            send_email($user->email, $user->business_name, 'Hello '.$request->business_name, $text);
            send_email($user->email, $user->business_name, 'Welcome to '.$basic->site_name, 'We are excited to have you on board!, It’s our duty to make your experience smooth and convenient.');
        }

        if (Auth::guard('user')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return response()->json(['status'=>'1','response'=>'User register successfuly.','Data'=>$user], 200);
            //return redirect()->route('user.profile');
        }
    }
    
    public function signupbyPhone(Request $request)
    {  
        $set=Settings::first();
       
            $validator = Validator::make($request->all(), [
                'prefix' => 'required|string|max:255',
                'phone' => 'required',
                'password' => 'required',
            ]);
        
        if ($validator->fails()) {
            // adding an extra field 'error'...
            //$data['title']='Register';
            //$data['errors']=$validator->errors();
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }
    $checkPhone = DB::table('users')->where('phone',$request->phone)->first();
   if(empty($checkPhone))
   {
           $basic = Settings::first();
    
            if ($basic->email_verification == 1) {
                $email_verify = 0;
            } else {
                $email_verify = 1;
            }
    
            if ($basic->sms_verification == 1) {
                $phone_verify = 1;
            } else {
                $phone_verify = 1;
            }
            //$verification_code = strtoupper(Str::random(6));
            //$sms_code = strtoupper(Str::random(6));
            //$email_time = Carbon::parse()->addMinutes(5);
            //$phone_time = Carbon::parse()->addMinutes(5);
            $user = array();
            //$user->first_name = $request->first_name;
            //$user->last_name = $request->last_name;
            //$user->business_name = $request->business_name;
            //$user->email = $request->email;
            $user['email_verify'] = $email_verify;
            $user['image'] = 'person.jpg';
            //$user->verification_code = $verification_code;
            //$user->email_time = $email_time;
            $user['balance'] = $basic->balance_reg;
            $user['ip_address'] = user_ip();
            $user['signup_ip'] = user_ip();
            $user['password'] = Hash::make($request->password);
            
            if($request->prefix)
            {
                $getdtls = DB::table('countries')->where('id',$request->prefix)->first();
            }
            $user['prefix'] = $getdtls->calling_code;
            $user['phone_iso'] = $getdtls->iso_code;
            $user['phone'] = $request->phone;
            $user['phone_with_prefix'] = $getdtls->calling_code.$request->phone;
            $user['login_token'] = bin2hex(random_bytes(128));
            //$user->source_from = $request->source_from;
            //$user->business_country = $request->business_country;
            
            $insertResult = DB::table('users')->insert($user);
            if($insertResult)
            {
                /*
                if ($basic->email_verification == 1) {
                    $text = "Before you can start accepting payments, you need to confirm your email address. Your email verification code is <b>".$user->verification_code."</b>";
                    send_email($user->email, $user->business_name, 'Hello '.$request->business_name, $text);
                    send_email($user->email, $user->business_name, 'Welcome to '.$basic->site_name, 'We are excited to have you on board!, It’s our duty to make your experience smooth and convenient.');
                } */
        
                if (Auth::guard('user')->attempt([
                    'phone' => $request->phone,
                    'password' => $request->password,
                ])) {
                    
                    $userData = User::whereid(Auth::guard('user')->user()->id)->first();
                    return response()->json(['status'=>'1','response'=>'User register successfuly.','auth_token'=>$userData->login_token,'Data'=>$userData], 200);
                    //return redirect()->route('user.profile');
                }
            } else {
                return response()->json(['status'=>'0','response'=>'Sorry, something went wrong!'], 400);
            }
            
       } else {
           return response()->json(['status'=>'0','response'=>'Sorry, phone is already exists!'], 400); 
        }
        
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    public function updateMobile(Request $request)
        {   die('SKK');
            $update = array(
                'updated_at'=>date('Y-m-d H:i:s')
                );
                 
            if(!empty($request->prefix))
            {
                $update['prefix'] = $request->prefix;
            }
             
            if(!empty($request->phone))
            {
                $update['phone'] = $request->phone;
            }
            die($update);
            $update = DB::table('users')->where('id',Auth::guard('user')->user()->id)->update($update);
            if($update)
            {
                return redirect('user/profile')->with('success', 'Mobile updated successfully');
            } else {
                return back()->with('alert', 'Something went wrong!');
            }
            
        }
     
      public function submitlogin(Request $request)
    {
        $set=$data['set']=Settings::first();
        if($set->recaptcha==1){
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required',
                'device_id'=>'required'
                //'g-recaptcha-response' => 'required|captcha'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required',
                'device_id'=>'required'
            ]);
        }
        if ($validator->fails()) {
            
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }
       /* if(strpos($request->email, '@') !== false){
            dd("Word Found!");
            } else{
                dd("Word Not Found!");
            } */
        if(strpos($request->username, '@') !== false)
        {    //LOGIN BY EMAIL
          
            $remember_me = $request->has('remember_me') ? true : false; 
            if (Auth::guard('user')->attempt([
                'email' => $request->username, 
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
    	        $user->device_id = $request->device_id;
    	         $user->login_token = bin2hex(random_bytes(128));
                 $user->save();
                if($user->fa_status==1){
                    return redirect()->route('2fa');
                }else{
                    if(Session::has('oldLink')){
                        return Redirect::to(Session::get('oldLink'));
                    }else{
                        if($user->kyc_status == 1 && $user->verify_ssn != NULL && $user->verify_ein != NULL)
                        {
                            return response()->json(['status'=>'1','response'=>'Login successfully.','auth_token'=>$user->login_token,'data'=>$user], 200);
                            //return redirect()->route('user.newdashboard');
                        } else {
                            return response()->json(['status'=>'1','response'=>'Login successfully.','auth_token'=>$user->login_token,'data'=>$user], 200);
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
    } else {
         //LOGIN BY PHONE
        
            $remember_me = $request->has('remember_me') ? true : false; 
            if (Auth::guard('user')->attempt([
                'phone_with_prefix' => $request->username, 
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
    	         $user->device_id = $request->device_id; 
    	          $user->login_token = bin2hex(random_bytes(128));
    	          
    	       
                $user->save();
                if($user->fa_status==1){
                    return redirect()->route('2fa');
                }else{
                    if(Session::has('oldLink')){
                        return Redirect::to(Session::get('oldLink'));
                    }else{
                        if($user->kyc_status == 1 && $user->verify_ssn != NULL && $user->verify_ein != NULL)
                        {
                            return response()->json(['status'=>'1','response'=>'Login successfully.','auth_token'=>$user->login_token,'data'=>$user], 200);
                            //return redirect()->route('user.newdashboard');
                        } else {
                            return response()->json(['status'=>'1','response'=>'Login successfully.','auth_token'=>$user->login_token,'data'=>$user], 200);
                            //return redirect()->route('user.profile');
                        }
                        
                    }
    
                }
                
            } else {
                $i=1;
                Session::put('wrong_attempt_email',$request->username);
                $count = Session::get('wrong_attempt_count');
                Session::put('wrong_attempt_count',$i+$count);
                if(Session::get('wrong_attempt_count') >= '3')
                {
                   $userdata = DB::table('users')->where('phone',$request->username)->first();
                   if($userdata)
                   {
                      $ip_address = $_SERVER['REMOTE_ADDR']; 
                	send_email($userdata->email, $userdata->first_name, 'Account Blocked', 'Dear '.$userdata->first_name.',<br> Due to unusual login attempt, your account has been blocked Please <a href="mailto:support@getvirtualcard.co.uk">Get in touch</a> with us. <br><br>Please contact our support team- support@getvirtualcard.co.uk');
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

    }
    
    public function submitloginphone(Request $request)
    {
        $set=$data['set']=Settings::first();
        if($set->recaptcha==1){
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'password' => 'required',
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'password' => 'required'
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
     
     public function postEmailVerify(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|max:11',
                'email_code' => 'required|string|max:255',
                
            ]);
            if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }  
            $user = DB::table('users')->where('id',$request->user_id)->first();
           if(!empty($user))
           { 
                if ($user->verification_code == $request->email_code) {
                    
                    DB::table('users')->where('id',$request->user_id)->update(['email_verify'=>1]);
                    
                    $bank = new Bank;
                    $bank->name = "";
                    $bank->acct_no = "";
                    $bank->acct_name = "";
                    $bank->swift = "";
                    $bank->user_id = $request->user_id;
                    $bank->save();
                    
                    return response()->json(['status'=>'0','response'=>'Your Profile has been verified successfully'], 200);   
                } else {
                    return response()->json(['status'=>'0','response'=>'Verification Code Did not matched'], 400); 
                   
                }
                return back();
           } else {
            return response()->json(['status'=>'0','response'=>'User does not exist!'], 400);   
           }
        } 
        
    public function EmailVerify(Request $request)
        {
            $validator = Validator::make($request->all(), [
               
                'user_email' => 'required|string|max:255',
                
            ]);
            if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }  
            $user = DB::table('users')->where('email',$request->user_email)->first();
           if(!empty($user))
           { 
                if ($user->verification_code == $request->email_code) {
                    
                    DB::table('users')->where('id',$request->user_id)->update(['email_verify'=>1]);
                    
                    $bank = new Bank;
                    $bank->name = "";
                    $bank->acct_no = "";
                    $bank->acct_name = "";
                    $bank->swift = "";
                    $bank->user_id = $request->user_id;
                    $bank->save();
                    
                    return response()->json(['status'=>'0','response'=>'Your Profile has been verified successfully'], 200);   
                } else {
                    return response()->json(['status'=>'0','response'=>'Verification Code Did not matched'], 400); 
                   
                }
                return back();
           } else {
            return response()->json(['status'=>'0','response'=>'User does not exist!'], 400);   
           }
        }
        
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
               
                'user_email' => 'required|string|max:255',
                
            ]);
            if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }
        //$this->validateEmail($request);
        $us = User::whereEmail($request->user_email)->count();
        if ($us == 0)
        {
            return response()->json(['status'=>'0','response'=>'We can\'t find a user with that e-mail address.'], 400);
        }else{ 
            $user = User::whereEmail($request->user_email)->first();
            $to =$user->email;
            $name = $user->name;
            $subject = 'Password Reset';
            $code = str_random(30);
            $link = url('/user-password/').'/reset/'.$code;
            $message = "Use This Link to Reset Password: <br>";
            $message .= "<a href='$link'>".$link."</a>";
            DB::table('password_resets')->insert(
                ['email' => $to, 'token' => $code,  'created_at' => date("Y-m-d h:i:s")]
            );
            send_email($to,  $name, $subject,$message);
            return response()->json(['status'=>'1','response'=>'Password Reset Link Send Your E-mail'], 200);
           // return back()->with('success', 'Password Reset Link Send Your E-mail');
        }
    }
    
    public function account(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'user_id' => 'required|max:11',
            ]);
        if ($validator->fails()) {
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }
       // dd($request->header());
        $user = DB::table('users')->where('id',$request->user_id)->first();
           $update = array();
           if(!empty($user))
           {  
              if($user->login_token == $request->header('auth-token'))
              {
            if($request->first_name)
            {
                $update['first_name']=$request->first_name;
            }
            if($request->last_name)
            {
                $update['last_name']=$request->last_name;
            }
            if($request->business_name)
            {
                $update['business_name']=$request->business_name;
            }
            if($request->office_address)
            {
                $update['office_address']=$request->office_address;
            }
            if($request->address1)
            {
                $update['address1']=$request->address1;
            }
            if($request->address2)
            {
                $update['address2']=$request->address2;
            }
            if($request->city)
            {
                $update['city']=$request->city;
            }
            if($request->state)
            {
                $update['state']=$request->state;
            }
            if($request->country)
            {
                $update['country'] = $request->country;
            }
            if($request->zip_code)
            {
                $update['zip_code']=$request->zip_code;
            }
            if($request->website_link)
            {
                $update['website_link']=$request->website_link;
            }
            if($request->developer)
            {
                $update['developer'] = $request->developer;
            }
            // 9-11-202
             if($request->prefix)
            {
                $getdtls = DB::table('countries')->where('id',$request->prefix)->first();
            }
            if($request->calling_code)
            {
                $update['prefix'] = $getdtls->calling_code;
            }
            if($request->iso_code)
            {
                $update['phone_iso'] = $getdtls->iso_code;
            }
          /*  if($request->phone)
            {
                $update['phone'] = $request->phone;
            }
            */
            // 9-11-2020
            
            
            //$user->save();
            
            $audit['user_id']=$request->user_id;
            $audit['trx']=str_random(16);
            $audit['log']='Updated account details';
            Audit::create($audit);    
           /* if(!empty($request->email))
            {
                if($user->email!=$request->email){
                    $check=User::whereEmail($request->email)->get();
                    if(count($check)<1){
                        $update['email_verify']=0;
                        $update['email']=$request->email;
                        //$user->save();
                    }else{
                        return response()->json(['status'=>'0','response'=>'Email already in use.'], 400);
                    }
                }
           }
           */
          /* if(!empty($request->phone))
            {
                if($user->phone!=$request->phone){
                    $checkPhone = DB::table('users')->where('phone',$request->phone)->first();//User::whereEmail($request->email)->get();
                    if(empty($checkPhone)){
                        //$update['email_verify']=0;
                        $update['phone']=$request->phone;
                        //$user->save();
                    }else{
                        return response()->json(['status'=>'0','response'=>'Phone already in use.'], 400);
                    }
                }
           }
           */
            $update['updated_at'] = date('Y-m-d h:i:s');
           
            DB::table('users')->where('id',$request->user_id)->update($update);
             $user = DB::table('users')->where('id',$request->user_id)->first();
            return response()->json(['status'=>'1','response'=>'Profile Updated Successfully.','Data'=>$user], 200);  
            //return redirect('user/profile#section2')->with('success', 'Profile Updated Successfully.');
           } else {
               return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400);
           }
               
           } else {
            return response()->json(['status'=>'0','response'=>'User does not exist!'], 400);   
           }
    }
    
    //uploadKycDocument
    public function uploadKycDocument(Request $request)
    {
       //echo "SK";die;
        try
        {
          // \DB::beginTransaction();
        $user_id = request('user_id');
        //$identitytype = "";
        //$identitynumber = "";
        //$documenttype = request('document_type');
        
        if(request('photo_id')) {
            //echo request('photo'); die;
            $user  = User::find($user_id);
            //$user->identity_verified = false;
            //$user->save();
          
            $param = "photo_id";
            $path       = '/home/getvirtualcardco/public_html/cards/asset/profile';
            $fileId = $this->createImageFromBase64(request('photo_id'),$param, $path);
            $photo_result = DB::table('users')->where('id',$request->user_id)->update(['photo_id'=>$fileId,'updated_at'=>date('Y-m-d h:i:s')]);
            if ($photo_result)
            {
               $success['message'] = "Kyc document is uploaded successfully.";
               return response()->json(['status'=>1, 'success' => $success], 200); 
            } else {
                return response()->json(['status'=>0,'error' => 'Something went wrong!'],400);
            }
          }
          if(request('address_id')) {
            //echo request('photo'); die;
            $user  = User::find($user_id);
            //$user->identity_verified = false;
            //$user->save();
          
            $param = "address_id";
            $path       = '/home/getvirtualcardco/public_html/cards/asset/profile';
            $fileId2 = $this->createImageFromBase64(request('address_id'),$param, $path);
            //print_r($fileId2);die;
            $photo_result = DB::table('users')->where('id',$request->user_id)->update(['address_id'=>$fileId2,'updated_at'=>date('Y-m-d h:i:s')]);
            if ($photo_result)
            {
               $success['message'] = "Kyc document is uploaded successfully.";
               return response()->json(['status'=>1, 'success' => $success], 200); 
            } else {
                return response()->json(['status'=>0,'error' => 'Something went wrong!'],400);
            }
          }
          if(request('company_certificate')) {
            //echo request('photo'); die;
            $user  = User::find($user_id);
            //$user->identity_verified = false;
            //$user->save();
          
            $param = "company_certificate";
            $path       = '/home/getvirtualcardco/public_html/cards/asset/profile';
            $fileId = $this->createImageFromBase64(request('company_certificate'),$param, $path);
            $photo_result = DB::table('users')->where('id',$request->user_id)->update(['kyc_link'=>$fileId,'updated_at'=>date('Y-m-d h:i:s')]);
            if ($photo_result)
            {
               $success['message'] = "Kyc document is uploaded successfully.";
               return response()->json(['status'=>1, 'success' => $success], 200); 
            } else {
                return response()->json(['status'=>0,'error' => 'Something went wrong!'],400);
            }
          }
        }
        catch (\Exception $e)
        {
            
            $success['message'] = 'Something went wrong!'; // echo print_r($e->getMessage());
            return response()->json(['status'=>0,'error' => $success],400);
        }
        
    }
    
      // Create Image From Base64
    public function createImageFromBase64($image,$param,$imagedir) {
       
        if(isset($image) && $image && isset($imagedir) && $imagedir) {
            $upload_dir = $imagedir;
            $img =$image;
            
            $type= "data:image/png";
            list($type, $img) = explode(';', $img);
            list(, $img)      = explode(',', $img);
            $datas = base64_decode($img);
            $extention = ".png";
            $fileName = strtolower(time() .$extention);
            $file = $upload_dir .'/'. $fileName;
            $success = file_put_contents($file, $datas);
            return $fileName;
        } else {
            return "";
        }
    }
    
    public function addFund(Request $request)
    {
        $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                    'trx_id' => 'required',
                    'gateway_id'=>'required',
                    'charge' => 'required',
                    'amount' => 'required',
                   'payment_via' => 'required'
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
         //print_r($request->all());die;          
        $insertData = array(
            'user_id'=>$request->user_id,
            'gateway_id'=>$request->gateway_id,
            'charge'=>$request->charge,
            'amount'=>$request->amount,//$request->details['purchase_units'][0]['amount']['value'],
            'trx'=>$request->trx_id,//$request->details['id'],
           
            'created_at'=>date('Y-m-d H:i:s')
            );
        $addedfundStatus = DB::table('deposits')->insert($insertData);    
       if($addedfundStatus)
       {
           $userDetails = DB::table('users')->where('id',$request->user_id)->first();
            $insertDataTrx = array(
            'email'=>$userDetails->email,
            'first_name'=>$userDetails->first_name,
            'last_name'=>$userDetails->last_name,
            'receiver_id'=>$request->user_id,
            'amount'=>$request->amount,
            'charge'=>$request->charge,
            'type'=>1,
           'transaction_type'=>'cr',
            'payment_type'=>$request->payment_via,
            'payment_link'=>1,
            'ref_id'=>$request->trx_id,//$request->details['id'],
            'status'=>1,
            'created_at'=>date('Y-m-d H:i:s')
            );
           $addedTrx = DB::table('transactions')->insert($insertDataTrx);
           
           
           $now_total = $userDetails->balance+$request->amount-$request->charge;
           DB::table('users')->where('id',$request->user_id)->update(['balance'=>number_format($now_total,2),'updated_at'=>date('Y-m-d H:i:s')]);
           
            //return response()->json(['result'=>'1','response'=>'Fund added successfully.'], 200);
           return response()->json(['status'=>'1','response'=>'Fund added successfully'], 200); 
           //return redirect('user/transfer')->with('success','Fund added successfully.');
       } else {
            return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
            return back()->with('alert','Something went wrong!');
       }
         
    }
    
    public function fetchTrxList(Request $request)
    {
        $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        $user=User::find($request->user_id);    
       if($user->login_token == $request->header('auth-token'))
       {
            $fetchResult = DB::table('transactions')->where('receiver_id',$request->user_id)->orderBy('id','DESC')->get();    
           if($fetchResult)
           {
               
              
               return response()->json(['status'=>'1','response'=>'List fetched successfully.','data'=>$fetchResult], 200); 
           } else {
                return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
           }
           
        } else {
                  return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
              }
         
    }
    
    public function vcardPurchasedPlan(Request $request)
    {
        $validator=Validator::make($request->all(), [
                    'user_id'=>'required',
                    'design_id'=>'required',
                    'plan_id'=>'required',
                    'payment_link_ref_id' => 'required',
                    'trx_id' => 'required',
                    'payment_via'=>'required',
                    'charge' => 'required',
                    'amount' => 'required',
                   
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        $link = DB::table('admin_payment_link')->where('ref_id',$request->payment_link_ref_id)->first(); 
        $planData = DB::table('virtual_cards_plan')->where('id',$request->plan_id)->first();
        $receiver = DB::table('users')->where('id',$request->user_id)->first();

        //$xtoken=str_random(16);
        if($request->payment_via=='paypal'){
                
                $userDetails = DB::table('users')->where('id',$request->user_id)->first();
                $sav['ref_id']=$request->trx_id;
                $sav['type']=2;
                $sav['amount']=$request->amount;
                $sav['email']=$userDetails->email;//$request->email;
                $sav['first_name']=$userDetails->first_name;//$request->first_name;
                $sav['last_name']=$userDetails->last_name;
               // $sav['card_number']=$request->cardNumber;
                //$sav['ip_address']=user_ip();
                $sav['receiver_id']=$userDetails->id;//$link->user_id;
                $sav['payment_link']= $link->id;
                $sav['payment_type']='paypal';
                //$sav['paypal_amount']=$request->paypal_amount;
               // $sav['paypal_status']=$request->paypal_status;
                //$sav['paypal_email']=$request->paypal_email;
                //$sav['paypal_trx_id']=$request->paypal_trx_id;
                DB::table('transactions')->insert($sav);
                
                        
                //$receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->single_charge/100));
                //$receiver->save();
                //Audit
                /*$audit['user_id']=$receiver->id;
                $audit['trx']=$request->trx_id;
                $audit['log']='Received payment for Payment Link' .$request->payment_link_ref_id;
                Audit::create($audit);
                DB::table('')
                //Charges
                $charges['user_id']=$receiver->id;
                $charges['ref_id']=str_random(16);
                $charges['amount']=$request->paypal_amount*$set->single_charge/100;
                $charges['log']='Received payment for Payment Link #' .$request->payment_link_ref_id;
                Charges::create($charges);
                //Change status to successful
                $change=Transactions::whereref_id($xtoken)->first();
                $change->status=1;
                $change->charge=$request->paypal_amount*$set->single_charge/100;
                $change->save(); 
                //Notify users
                if($set->email_notify==1){
                    //send_paymentlinkreceipt($request->payment_link_ref_id, 'card', $xtoken);
                } */
               // $planData = DB::table('virtual_cards_plan')->where('id',Session::get('plan_id'))->first();
                $orderCreate = array(
                    'user_id'=>$request->user_id,
                    'order_ref_no'=>$request->trx_id,
                    'product__type_id'=>1,
                    'design_id'=>$request->design_id,
                     'plan_id'=>$request->plan_id,
                     'quantity'=>$planData->plan_quantity,
                     'remain_qty'=>$planData->plan_quantity,
                    'amount'=>$request->amount,
                    'status'=>1,
                    'created_at'=>date('Y-m-d H:i:s')
                    );
                $orderCreated = DB::table('virtual_cards_orders')->insert($orderCreate); 
                
                $total_limit = number_format($receiver->cvard_limit+$planData->plan_quantity);
               $planResult = DB::table('users')->where('id',$request->user_id)->update(['cvard_limit'=>$total_limit,'updated_at'=>date('Y-m-d H:i:s')]);
               if($planResult)
               {
                $text = "You have successfully purchased ".$planData->plan_name." Plan with amount $".$request->amount.", now your virtual card creation limit is ".$total_limit;
                send_email($receiver->email, $receiver->first_name .$receiver->last_name, 'Virtual Card Plan Purchased', $text);
                 return response()->json(['status'=>'1','response'=>'Virtual Card plan purchased successfully.'], 200);  
               } else {
                    return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);  
               }
            }
            else {
                    return response()->json(['status'=>'0','response'=>'Payment_via not found!'], 400);  
               }
    }
    
    public function fetchvCardPalnList(Request $request)
    {
        $check = DB::table('users')->where('login_token',$request->header('auth-token'))->first();
        if(!empty($check))
        {
        $fetchResult = DB::table('virtual_cards_plan')->orderBy('id','DESC')->get();    
       if($fetchResult)
       {
           
          
           return response()->json(['status'=>'1','response'=>'List fetched successfully.','data'=>$fetchResult], 200); 
       } else {
            return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
       }
        } else {
            return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
        }  
    }
    
    public function vcardList(Request $request)
    {
        $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        $user = User::find($request->user_id);   
        if($user->login_token == $request->header('auth-token'))
        {  
            $fetchResult = DB::table('virtual_cards')->where('user_id',$request->user_id)->orderBy('id','DESC')->get();    
           if($fetchResult)
           {
               return response()->json(['status'=>'1','response'=>'List fetched successfully.','data'=>$fetchResult], 200); 
           } else {
                return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
           }
        } else {
                  return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
              }
         
    }
    
    public function fetchvCountryList(Request $request)
    {
            $fetchResult = DB::table('countries')->where('active',1)->get();    
           if($fetchResult)
           {
              foreach($fetchResult as $k=>$val)
              {
                $fetchResult[$k]->flag_link = 'https://s3.amazonaws.com/rld-flags/'.strtolower($val->iso_code).'.svg';
                   
              }
             
               return response()->json(['status'=>'1','response'=>'List fetched successfully.','data'=>$fetchResult], 200); 
           } else {
                return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
           }
    }
    
    public function fetchProductTypeList(Request $request)
    {
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
        $check = DB::table('users')->where('login_token',$request->header('auth-token'))->first();
        if(!empty($check))
        {
            $fetchResult = DB::table('virtual_cards_product_type')->get();    
           if($fetchResult)
           {
               return response()->json(['status'=>'1','response'=>'List fetched successfully.','data'=>$fetchResult], 200); 
           } else {
                return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
           }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }  
    }
    
    public function fetchVcardDesignList(Request $request)
    {
       
       if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
        $check = DB::table('users')->where('login_token',$request->header('auth-token'))->first();
        if(!empty($check))
        {   
            $fetchResult = DB::table('virtual_cards_design')->get();    
           if($fetchResult)
           {
               
              
               return response()->json(['status'=>'1','response'=>'List fetched successfully.','data'=>$fetchResult], 200); 
           } else {
                return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
           }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }   
    }
    
    public function fetchCurrencyList(Request $request)
    {
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
        $check = DB::table('users')->where('login_token',$request->header('auth-token'))->first();
        if(!empty($check))
        { 
        $fetchResult = DB::table('currency')->where('status',1)->get();    
       if($fetchResult)
       {
           
          
           return response()->json(['status'=>'1','response'=>'fetched successfully.','data'=>$fetchResult], 200); 
       } else {
            return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
       }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }   
         
    }
    
    public function vcardOrdersList(Request $request)
    {
        $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        $user = User::find($request->user_id);    
        if($user->login_token == $request->header('auth-token'))
        { 
          //  $fetchResult = DB::table('virtual_cards_orders')
            //                ->where('user_id',$request->user_id)->orderBy('id','DESC')->get();  
                    $fetchResult =  DB::table('virtual_cards_orders')
                        ->select('virtual_cards_plan.plan_name as planName','virtual_cards_product_type.name as productName','virtual_cards_design.class_name as designClassName','virtual_cards_orders.*')
                        ->join('virtual_cards_product_type','virtual_cards_product_type.id','=','virtual_cards_orders.product__type_id')
                        ->join('virtual_cards_plan','virtual_cards_plan.id','=','virtual_cards_orders.plan_id')
                        ->join('virtual_cards_design','virtual_cards_design.id','=','virtual_cards_orders.design_id')
                        //->where(['something' => 'something', 'otherThing' => 'otherThing'])
                        ->where('virtual_cards_orders.user_id',$request->user_id)
                        ->get();
    
           if($fetchResult)
           {
               
              
               return response()->json(['status'=>'1','response'=>'List fetched successfully.','data'=>$fetchResult], 200); 
           } else {
                return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
           }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }  
    }
    
    public function chargeCheck(Request $request)
    {
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
        $check = DB::table('users')->where('login_token',$request->header('auth-token'))->first();
        if(!empty($check))
        {
        $validator=Validator::make($request->all(), [
                    'gateway_id' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        
        $fetchResult = DB::table('gateways')->where('id',$request->gateway_id)->orderBy('id','DESC')->first();    
       if($fetchResult)
       {
           return response()->json(['status'=>'1','response'=>'List fetched successfully.','data'=>$fetchResult->charge], 200); 
       } else {
            return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);   
       }
       
     } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          } 
         
    }
    
    public function walletBalance(Request $request)
    {
        $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
        $check = DB::table('users')->where('id',$request->user_id)->first();
        if($check->login_token == $request->header('auth-token'))
        {
            $fetchResult = DB::table('users')->where('id',$request->user_id)->first();    
           if($fetchResult)
           {
              
              
               return response()->json(['status'=>'1','response'=>'Details fetched successfully.','data'=>$fetchResult->balance], 200); 
           } else {
                return response()->json(['status'=>'0','response'=>'User not exists!'], 400);   
           }
           
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          } 
         
    }
    
    public function userDetails(Request $request)
    {
        $validator=Validator::make($request->all(), [
                    'user_id' => 'required'
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        //dd($request->header('auth-token'));
        $fetchResult = DB::table('users')->where('id',$request->user_id)->first();    
       if($fetchResult)
       {
          if($fetchResult->login_token == $request->header('auth-token'))
          {
            return response()->json(['status'=>'1','response'=>'Details fetched successfully.','data'=>$fetchResult], 200); 
          } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }
       } else {
            return response()->json(['status'=>'0','response'=>'User not exists!'], 400);   
       }
         
    }
    
    public function checkRegisteredUser(Request $request)
    {
        $validator=Validator::make($request->all(), [
                    'calling_code' => 'required',
                    'phone' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        
        $fetchResult = DB::table('users')->where(['phone'=>$request->phone,'prefix'=>$request->calling_code])->first();    
       if(!$fetchResult)
       {
           
          
           return response()->json(['status'=>'1','response'=>'User available!.','data'=>$fetchResult], 200); 
       } else {
            return response()->json(['status'=>'0','response'=>'User exists!'], 400);   
       }
         
    }
    
    public function banners(Request $request)
    {
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
            
        $check = DB::table('users')->where('login_token',$request->header('auth-token'))->first();
        if(!empty($check))
        {
        
            $fetchResult = DB::table('banners')->where(['status'=>1])->get();    
           if($fetchResult)
           {
             /* foreach($fetchResult as $value)
              {
                  $fetchResult['image_url'] = url('asset/banners');
                   
              }
              */
               return response()->json(['status'=>'1','response'=>'Banner available!.','data'=>$fetchResult,'Image_URL'=>url('asset/banners')], 200); 
           } else {
                return response()->json(['status'=>'0','response'=>'No banner exists!'], 400);   
           }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }
         
    }
    
    public function notification(Request $request)
    {
         $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
        $user = User::find($request->user_id);    
        if($user->login_token == $request->header('auth-token'))
        {     
        $payment_notification = DB::table('notification')->where(['sender_id'=>$request->user_id,'notify_type'=>'payment'])->orderBy('id','DESC')->get(); 
        
        $general_notification = DB::table('notification')->where(['sender_id'=>$request->user_id,'notify_type'=>'general'])->orderBy('id','DESC')->get();    

       if($payment_notification && $general_notification)
       {
         /* foreach($fetchResult as $value)
          {
              $fetchResult['image_url'] = url('asset/banners');
               
          }
          */
           return response()->json(['status'=>'1','response'=>'Notification available!.','payment_notification'=>$payment_notification,'general_notification'=>$general_notification], 200); 
       } else {
            return response()->json(['status'=>'0','response'=>'No notification found!'], 400);   
       }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          } 
    }
    
    public function notification_update(Request $request)
    {
         $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                    'notification_id' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        $payment_notification = DB::table('notification')->where(['sender_id'=>$request->user_id,'id'=>$request->notification_id])->update(['read_status_for_sender'=>$request->seen_status,'updated_at'=>date('Y-m-d h:i:s')]); 
        
        //$general_notification = DB::table('notification')->where(['sender_id'=>$request->user_id,'notify_type'=>'general'])->orderBy('id','DESC')->get();    

       if($payment_notification)
       {
         /* foreach($fetchResult as $value)
          {
              $fetchResult['image_url'] = url('asset/banners');
               
          }
          */
           return response()->json(['status'=>'1','response'=>'Notification updated successfully!.'], 200); 
       } else {
            return response()->json(['status'=>'0','response'=>'No notification found!'], 400);   
       }
         
    }
    
    public function settings(Request $request)
    {
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
        $check = DB::table('users')->where('login_token',$request->header('auth-token'))->first();
        if(!empty($check))
        {    
        $fetchResult = DB::table('settings')->get();    
       if($fetchResult)
       {
         /* foreach($fetchResult as $value)
          {
              $fetchResult['image_url'] = url('asset/banners');
               
          }
          */
          $gateways = DB::table('gateways')->get(); 
           return response()->json(['status'=>'1','response'=>'Fetched successfully','Settings'=>$fetchResult,'Gateway_credentials'=>$gateways], 200); 
       } else {
            return response()->json(['status'=>'0','response'=>'No banner exists!'], 400);   
       }
     } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }  
    }
    
    public function multiLanguage(Request $request)
     {
         $validator=Validator::make($request->all(), [
                    'language_id' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
       
        
         //$language_id  =  $this->input->get('language_id');
        //die($request->language_id);
         if($request->language_id == 1)
            {
                 $query = DB::table('app_language')->select('id','string','english')->get();//$this->db->select("lang_id,string,burmish")->get('app_language')->result();
                 foreach($query as $queryes)
                 {
                     $sting[] = $queryes->string;
                     $value[] = $queryes->english;
                 }
                $final=  array_combine($sting,$value);
                return response()->json(['status'=>'1','response'=>'Fetch successfully','Data'=>$final], 200);
               // $responsearr = array( 'status' =>200,'result' =>$final,);
             }
             elseif($request->language_id == 2)
            {
                 $query = DB::table('app_language')->select('id','string','french')->get();//$this->db->select("lang_id,string,burmish")->get('app_language')->result();
                 foreach($query as $queryes)
                 {
                     $sting[] = $queryes->string;
                     $value[] = $queryes->french;
                 }
                $final=  array_combine($sting,$value);
                return response()->json(['status'=>'1','response'=>'Fetch successfully','Data'=>$final], 200);
               // $responsearr = array( 'status' =>200,'result' =>$final,);
             }
             elseif($request->language_id == 3)
            {
                 $query = DB::table('app_language')->select('id','string','spanish')->get();//$this->db->select("lang_id,string,burmish")->get('app_language')->result();
                 foreach($query as $queryes)
                 {
                     $sting[] = $queryes->string;
                     $value[] = $queryes->spanish;
                 }
                $final=  array_combine($sting,$value);
                return response()->json(['status'=>'1','response'=>'Fetch successfully','Data'=>$final], 200);
               // $responsearr = array( 'status' =>200,'result' =>$final,);
             }
             else 
             {
                return response()->json(['status'=>'0','response'=>'Sorry, Language id not found!'], 400); 
             }
             
       
       
     // echo json_encode($responsearr, JSON_UNESCAPED_UNICODE);  
        
    } 
}
