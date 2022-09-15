<?php

namespace App\Http\Controllers\Auth;

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
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
class RegisterController extends Controller
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
        $this->middleware('guest');
        $this->middleware('guest:user');
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
        //dd($request->all());
        $set=Settings::first();
        if($set->recaptcha==1){
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                //'business_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                 'phone' => 'required|unique:users',
                'password' => 'required|string|min:6',
                'g-recaptcha-response' => 'required|captcha'
            ]);        
        }else{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                //'business_name' => 'required|string|max:255',
                'phone' => 'required|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
        }
        if ($validator->fails()) {
            // adding an extra field 'error'...
            $data['title']='Register';
            $data['errors']=$validator->errors();
            session()->flashInput($request->input());
            return view('/auth/register', $data);
        }

        $basic = Settings::first();
        
        if($request->account_type == 'standard'){
            $lastfourssn = substr($request->ssn, -4);
        }else{
            $lastfourssn = substr($request->EIN, -4);
        }
        
        $btok_params = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'street1' => $request->street_address,
            'zipcode' => $request->postalcode,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'ssn_last_four' => $lastfourssn,
            'kyc_type' => 'BASIC',
        ];
        
        $api_url = config('app.PRIVACY_API_URL');
        $api_key = config('app.PRIVACY_API_KEY');
        
        //dd($api_key);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/enroll/consumer');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
           "Content-Type: application/json",
           "Authorization: api-key ".$api_key
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($btok_params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $data = json_decode($result, true);
        //dd($data['message']);
        
        if(empty($data['message']))
        {
            //die('123');
    
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
           
            if(!empty($request->business_name))
            {
             $user->business_name = $request->business_name;
            }
            $user->email = $request->email;
            $user->email_verify = $email_verify;
            $user->image = 'person.jpg';
            $user->verification_code = $verification_code;
            $user->email_time = $email_time;
            $user->balance = $basic->balance_reg;
            $user->ip_address = user_ip();
            $user->signup_ip = user_ip();
            $user->account_type = $request->account_type;
            $user->password = Hash::make($request->password);
            
            $user->user_type = $request->user_type;
            $user->account_token = $data['data']['account_token'];
            
            if($request->prefix)
            {
                $getdtls = DB::table('countries')->where('id',$request->prefix)->first();
            }
            $user->prefix = $getdtls->calling_code;
            $user->phone_iso = $getdtls->iso_code;
            $user->phone = $request->phone;
            $user['phone_with_prefix'] = $getdtls->calling_code.$request->phone;
            
            $user->street = $request->street_address;
            $user->city = $request->city;
            $user->country = $request->u_country;
            $user->state = $request->state;
            $user->zip_code = $request->postalcode;
            $user->business_type = $request->btype;
            $user->zip_code = $request->postalcode;
            $user->verify_ssn = $request->ssn;
            $user->verify_ein = $request->EIN;
            $user->dob = $request->dob;
            
            $user->save();
                
            if ($basic->email_verification == 1) {
                $text = "Before you can start accepting payments, you need to confirm your email address. Your email verification code is <b>".$user->verification_code."</b><br><br><br>";
                send_email2($user->email, $user->first_name, "Email Verification Code from Cuminup", $text);
                //send_email($user->email, $user->business_name, 'Welcome to '.$basic->site_name, 'We are excited to have you on board!, It’s our duty to make your experience smooth and convenient.');
            }
    
            if (Auth::guard('user')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                
                //NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'New Signup',
                     'receiver_id'=>1,
                     'title'=>'New User Registered Successfully',
                     'link'=>'admin/manage-user/'.Auth::guard('user')->user()->id,
                     //'desription'=>"You have successfully load fund to your wallet with amount ".$currency->symbol.$amt,
                     'receiver_description'=>'A new user named '.$request->first_name.' '.$request->last_name.' registered successfully with email '.$request->email.' and phone number +'.$getdtls->calling_code.$request->phone,
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION
                return redirect()->route('user.profile');
            }
            
        } else {
            //dd($data['message']);
            return back()->with('alert',$data['message']);
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
        {   
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
}
