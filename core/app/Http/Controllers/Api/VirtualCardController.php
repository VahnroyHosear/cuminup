<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Models\User;
use App\Models\Settings;
use App\Models\Logo;
use App\Models\Bank;
use App\Models\Currency;
use App\Models\Transfer;
use App\Models\Adminbank;
use App\Models\Gateway;
use App\Models\Deposits;
use App\Models\Banktransfer;
use App\Models\Withdraw;
use App\Models\Exttransfer;
use App\Models\Merchant;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\Invoice;
use App\Models\Virtualcard;
use App\Models\Product;
use App\Models\Productimage;
use App\Models\Order;
use App\Models\Audit;
use App\Models\Requests;
use App\Models\Paymentlink;
use App\Models\Transactions;
use App\Models\Charges;
use App\Models\Donations;
use App\Models\Plans;
use App\Models\Subscribers;
use Carbon\Carbon;
use Session;
use Image;
use Redirect;
use App\Lib\coinPayments;
use App\Lib\CoinPaymentHosted;


use DB;
use PDF;
use App\Models\Customer;

class VirtualCardController extends Controller
{

        
    public function __construct()
    {		
        
    }
    
    public function virtualcard()
    { 
       $data['title'] = "Virtual Card";
        $data['virtualCardsList'] = DB::table('virtual_cards')
                                    ->select('virtual_cards.*','virtual_cards_funding_accounts.account_name as FundingAccount','virtual_cards_funding_accounts.last_four as FundingLastFour')
                                    ->join('virtual_cards_funding_accounts','virtual_cards_funding_accounts.id','=','virtual_cards.funding_account_id')
                                    ->where('user_id',Auth::id())
                                    ->orderBy('virtual_cards.id', 'DESC')
                                    ->get();
        $OrdataCheck = array('OPEN','PAUSED','CLOSED');                            
        $data['create_limit_checked'] = DB::table('virtual_cards')
                                        ->where('user_id',Auth::id())
                                        ->WhereIn('card_state',$OrdataCheck)
                                        ->get();
        $data['created_vcards_limit'] = DB::table('users')
                                        ->where('id',Auth::id())
                                        ->first();
        $arr = [];
        foreach($data['virtualCardsList'] as $k=>$cardDetails)
        {
             //= count($this->getTransactionsList($cardDetails->token));
             $totalAmount = 0;
           foreach($this->getTransactionsList($cardDetails->token) as $cardTransactionDetails)
           {
                $totalAmount =  $totalAmount + $cardTransactionDetails->amount;
           }
           $data['virtualCardsList'][$k]->restAmount = $totalAmount;
        }
         
       $data['AllvCardDesigns'] = DB::table('virtual_cards_design')->where('status',1)->get();
        return view('user.virtualcard.index',$data);
         
    } 

    public function newdashboard()
        {
           $data['title'] = "Dashboard";
           $data['estore_received']=Order::whereStatus(1)->whereseller_id(Auth::guard('user')->user()->id)->sum('total');
            $data['estore_total']=Order::whereseller_id(Auth::guard('user')->user()->id)->sum('total');
            
            $data['settlements_received']=Withdraw::whereStatus(1)->whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['settlements_pending']=Withdraw::whereStatus(0)->whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['settlements_total']=Withdraw::whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            
            $data['request_sent']=Requests::whereStatus(1)->whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['request_pending']=Requests::whereStatus(0)->whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['request_total']=Requests::whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            
            $data['sendMoney_sent']=Transfer::whereStatus(1)->whereSender_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['sendMoney_pending']=Transfer::whereStatus(0)->wheresender_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['sendMoney_rebursed']=Transfer::whereStatus(2)->wheresender_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['sendMoney_total']=Transfer::wheresender_id(Auth::guard('user')->user()->id)->sum('amount');
            
            $data['invoice_received']=Invoice::whereStatus(1)->whereuser_id(Auth::guard('user')->user()->id)->sum('total');
            $data['invoice_pending']=Invoice::whereStatus(0)->whereuser_id(Auth::guard('user')->user()->id)->sum('total');
            $data['invoice_total']=Invoice::whereuser_id(Auth::guard('user')->user()->id)->sum('total');
           $data['virtualCardsList'] = DB::table('virtual_cards')
                                    ->select('virtual_cards.*','virtual_cards_funding_accounts.account_name as FundingAccount','virtual_cards_funding_accounts.last_four as FundingLastFour')
                                    ->join('virtual_cards_funding_accounts','virtual_cards_funding_accounts.id','=','virtual_cards.funding_account_id')
                                    ->where('virtual_cards.user_id',Auth::id())
                                     ->where('virtual_cards.card_state','OPEN')
                                    ->get();
         foreach($data['virtualCardsList'] as $k=>$cardDetails)
        {
             //= count($this->getTransactionsList($cardDetails->token));
             $totalAmount = 0;
           foreach($this->getTransactionsList($cardDetails->token) as $cardTransactionDetails)
           {
                $totalAmount =  $totalAmount + $cardTransactionDetails->amount;
           }
           $data['virtualCardsList'][$k]->restAmount = $totalAmount;
        }
         
       $data['AllvCardDesigns'] = DB::table('virtual_cards_design')->where('status',1)->get();                        
            return view('user.newdashboard.index',$data);
             
        } 
    
    public function createCard(Request $request)
    {  
           $validator=Validator::make($request->all(), [
                'user_id'=>'required',
                'name_on_card' => ['required', 'max:255', 'string'],
                'card_limit' => ['required'],
               
                'spend_limit_duration'=> ['required']
            ]);
            if ($validator->fails()) {
                return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
         
        //$memo = 'Jhon Deo';
        //$type = 'UNLOCKED';
        //$funding_token = '46e9a102-1d8e-489c-a19e-b314ccc219ac';
        $pin = base64_decode(1234);
        //$spend_limit = 100;
        //$spend_limit_duration = 'FOREVER';
        //$state = 'OPEN';
        //$shipping_address = NULL;
        //$product_id = NULL;
        
       
       //$calling_code_by_ip = str_replace('+',' ',file_get_contents("https://ipapi.co/$ip/country"));
        //dd($calling_code_by_ip);
        if(empty($request->card_type))
        {
            $card_type = 'MERCHANT_LOCKED';//'MERCHANT_LOCKED';
        } else {
            $card_type = $request->card_type;
        }
        
        $checkPlan = DB::table('virtual_cards_orders')
                    ->where('user_id',$request->user_id)
                    ->where('remain_qty','!=','0')
                    ->orderBy('id','ASC')
                    ->get();
       
         $userDetails = DB::table('users')->where('id',$request->user_id)->first();
         if(empty($userDetails))
         {
            return response()->json(['status'=>'0','response'=>'User id not exist!'], 400); 
         }
         if($userDetails->login_token == $request->header('auth-token'))
          { 
        /* 
         $ip = $_SERVER['REMOTE_ADDR'];
        $createdCardDetails = DB::table('virtual_cards')->where(['user_id'=>Auth::id(),'id_address'=>$_SERVER['REMOTE_ADDR']])->get();
        if(count($createdCardDetails) == 2)
        {
           $text = "Sorry your account was just created more than two virtual card from an IP address ".$ip." If this was you, please you can ignore this message or reset your account password.";
           send_email($userDetails->email, $userDetails->first_name .$userDetails->last_name, 'Suspicious Card Creation Attempt', $text); 
        }
       */
        
            /*if($userDetails->verify_ssn != NULL && $userDetails->verify_ein != NULL)
            { */
                
            if($userDetails->balance >= $request->amount)
            {   
                if(count($checkPlan) > 0)
                { 
                $postData = array(
                    "type"=>'MERCHANT_LOCKED',//$card_type,
                    "memo" =>$request->name_on_card,
                    "spend_limit"=>(int)$request->card_limit*100,
                    "spend_limit_duration" =>$request->spend_limit_duration,
                    );
         
                  
                $api_key = config('app.PRIVACY_API_KEY');
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => config('app.PRIVACY_API_URL').'/card',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($postData),
                CURLOPT_HTTPHEADER => array(
                        "accept-language: en-US,en;q=0.8",
                        "content-type: application/json",
                        "Authorization: api-key $api_key",
                    ),
                ));
                $CreatedResponse = json_decode(curl_exec($curl));
               
                if(!empty($CreatedResponse->debugging_request_id))
                {
                    return back()->with('alert',$CreatedResponse->message);
                } else {
                    //dd($CreatedResponse);
                    $insertCard = array(
                        'user_id'=>$request->user_id,
                        //'id_address'=>$_SERVER['REMOTE_ADDR'],
                        'host_name'=>$CreatedResponse->memo,
                        'memo'=>$CreatedResponse->memo,
                        'last_four_digit'=>$CreatedResponse->last_four,
                        //'exp_month'=>$CreatedResponse->exp_month,
                        //'exp_year'=>$CreatedResponse->exp_year,
                        //'cvv'=>$CreatedResponse->cvv,
                        //'pan'=>$CreatedResponse->pan,
                        'spend_limit'=>$CreatedResponse->spend_limit/100,
                        'spend_limit_duration'=>$CreatedResponse->spend_limit_duration,
                        //'card_state'=>'PAUSED',//$CreatedResponse->state,
                        'is_paused_by_admin'=>1,
                        'token'=>$CreatedResponse->token,
                        'type'=>$CreatedResponse->type,
                       'design_id'=>$checkPlan[0]->design_id
                        );
                        
                   $cardInserted = DB::table('virtual_cards')->insertGetId($insertCard);
                   if($cardInserted)
                   {
                       $insertFunding = array(
                        'virtual_cards_id'=>$cardInserted,
                        'account_name'=>$CreatedResponse->funding->account_name,
                        'last_four'=>$CreatedResponse->funding->last_four,
                        'nickname'=>$CreatedResponse->funding->nickname,
                        'account_state'=>$CreatedResponse->funding->state,
                        'token'=>$CreatedResponse->funding->token,
                        'type'=>$CreatedResponse->funding->type,
                        );
                        $fundingInserted = DB::table('virtual_cards_funding_accounts')->insertGetId($insertFunding);    
                       DB::table('virtual_cards')->where('id',$cardInserted)->update(['funding_account_id'=>$fundingInserted]);
                       $vcardLimitCheck = DB::table('users')->where('id',$request->user_id)->first();
                       $adminDetails = DB::table('settings')->first();
                       //NOTIFY ADMIN
                       $text = $vcardLimitCheck->business_name ." has been apply for the virtual card with the username ".$CreatedResponse->memo." ending with last four digit XXXX".$CreatedResponse->last_four;
                       send_email($adminDetails->support_email, 'GetVirtualCard Admin', 'New Virtual Card Applied', $text);
                       
                       DB::table('users')->where('id',$request->user_id)->update(['cvard_limit'=>number_format($vcardLimitCheck->cvard_limit-1),'updated_at'=>date('Y-m-d H:i:s')]);
                       DB::table('virtual_cards_orders')->where('id',$checkPlan[0]->id)->update(['remain_qty'=>number_format($checkPlan[0]->remain_qty-1),'created_qty'=>number_format($checkPlan[0]->created_qty+1),'updated_at'=>date('Y-m-d H:i:s')]);
                     //NOTIFY USER
                    $text = "You have successfully applied for virtual card ending with last four digit XXXX".$CreatedResponse->funding->last_four;
                    send_email($vcardLimitCheck->email, $vcardLimitCheck->first_name .$vcardLimitCheck->last_name, 'Virtual Card Successfully Created', $text);
                    DB::table('users')->where('id',$request->user_id)->update(['balance'=>($vcardLimitCheck->balance-$request->card_limit),'updated_at'=>date('Y-m-d H:i:s')]);
                    $sav['ref_id']=str_random(16);
                    $sav['type']=4;
                    $sav['amount']=$request->card_limit;
                    $sav['email']=$vcardLimitCheck->email;
                    $sav['first_name']=$vcardLimitCheck->first_name;
                    $sav['last_name']=$vcardLimitCheck->last_name;
                    //$sav['card_number']=$request->cardNumber;
                    $sav['transaction_type'] = 'dr';
                    //$sav['ip_address']=user_ip();
                    $sav['receiver_id']=$vcardLimitCheck->id;//$link->user_id;
                   // $sav['payment_link']= $link->id;
                    $sav['payment_type']='card_limit';
                    Transactions::create($sav);
                   // return back()->with('success','Virtual Card created successfully.');
                    //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$request->user_id,
                         'title'=>'Virtual Card',
                         'desription'=>"You have successfully created virtual card ending with last four digit XXXX".$CreatedResponse->last_four,
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION 
                    return response()->json(['status'=>'1','response'=>'Virtual Card created successfully.'], 200);
                   } else {
                        return response()->json(['status'=>'0','response'=>'Virtual Card created successfully but value is not inserted in DB!'], 400);
                   }
                }
            } else { 
                return response()->json(['status'=>'0','response'=>'Sorry you have no active plan yet!'], 400);
            }
        } else {
             return response()->json(['status'=>'0','response'=>'Insufficient balance in your wallet!'], 400);
        }
       
       /* } else {
             return redirect('user/profile')->with('alert','Sorry, your SSN and EIN is incomplete!');
        } */
        
       
        
        } else {
                  return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
              }
        //curl_close($curl);
   }
   
   public function updateVirtualCard(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'user_id'=>    ['required'],
                'name_on_card' => ['required', 'max:255', 'string'],
                'card_limit' => ['required'],
                'card_token'=>['required']
            ]);
            if ($validator->fails()) {
               return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }    
        $userDetails = DB::table('users')->where('id',$request->user_id)->first(); 
        if($userDetails->login_token == $request->header('auth-token'))
        {      
        $oldCardDetails = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->first();
        $newBalance = ($request->card_limit-$oldCardDetails->spend_limit);
         
       // print_r(($request->card_limit-$oldCardDetails->spend_limit));die;
        if($userDetails->balance >= $newBalance)
        { 
            $postData = array(
                //"state"=>'OPEN',
                "card_token"=>$request->card_token,
                //"type"=>$request->card_type,
                "memo" =>$request->name_on_card,
                "spend_limit"=>(int)$request->card_limit*100,
                "spend_limit_duration" =>'FOREVER'//$request->spend_limit_duration,
                );
            //if(!empty($request->name_on_card))    
           // dd($postData);    
            $api_key = config('app.PRIVACY_API_KEY');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.PRIVACY_API_URL').'/card',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => array(
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                    "Authorization: api-key $api_key",
                ),
            ));
           
            $CreatedResponse = json_decode(curl_exec($curl));
            if(!empty($CreatedResponse->debugging_request_id))
            {
                return back()->with('alert',$CreatedResponse->message);
            } else {
                //dd($CreatedResponse);
                $updateCard = array(
                    //'user_id'=>Auth::id(),
                    'host_name'=>$CreatedResponse->memo,
                    'memo'=>$CreatedResponse->memo,
                    //'last_four_digit'=>$CreatedResponse->last_four,
                    //'exp_month'=>$CreatedResponse->exp_month,
                    //'exp_year'=>$CreatedResponse->exp_year,
                    //'cvv'=>$CreatedResponse->cvv,
                    //'pan'=>$CreatedResponse->pan,
                    'spend_limit'=>$CreatedResponse->spend_limit/100,
                    'spend_limit_duration'=>$CreatedResponse->spend_limit_duration,
                    //'card_state'=>$CreatedResponse->state,
                    //'token'=>$CreatedResponse->token,
                    'type'=>$CreatedResponse->type,
                    'updated_at'=>date('Y-m-d h:i:s')
                    );
                    
               $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->update($updateCard);
               //dd($cardUpdated);
               if($cardUpdated)
               {
                   $nowBalance = $userDetails->balance-$newBalance;
                   DB::table('users')->where('id',$request->user_id)->update(['balance'=>$nowBalance,'updated_at'=>date('Y-m-d H:i:s')]);
                   $sav['ref_id']=str_random(16);
                    $sav['type']=4;
                    $sav['amount']=$newBalance;
                    $sav['email']=$userDetails->email;
                    $sav['first_name']=$userDetails->first_name;
                    $sav['last_name']=$userDetails->last_name;
                    //$sav['card_number']=$request->cardNumber;
                    $sav['transaction_type'] = 'dr';
                    //$sav['ip_address']=user_ip();
                    $sav['receiver_id']=$userDetails->id;//$link->user_id;
                   // $sav['payment_link']= $link->id;
                    $sav['payment_type']='card_limit';
                    Transactions::create($sav);
                    //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$request->user_id,
                         'title'=>'Virtual Card',
                         'desription'=>"Your virtual card ending with last four digit XXXX".$CreatedResponse->last_four." has been successfully updated.",
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION 
                   return response()->json(['status'=>'1','response'=>'Virtual Card updated successfully.'], 200);
                   //return back()->with('success','Virtual Card updated successfully.');
               } else {
                   return response()->json(['status'=>'1','response'=>'Virtual Card updated successfully.'], 200);
                   //return back()->with('success','Virtual Card updated successfully.');
                   //return back()->with('alert','Virtual Card updated successfully but value is not updated in DB!');
               }
            }
        } else {
            
            return response()->json(['status'=>'0','response'=>'Sorry, Insufficient balance in your wallet!'], 400);
             //return back()->with('alert','Sorry, Insufficient balance in your wallet!');
        }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          } 
        //curl_close($curl);
   }
   
   public function pausedVirtualCard(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'user_id'=>['required'],
                'card_token'=>['required']
            ]);
            if ($validator->fails()) {
               return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
                //return redirect()->route('transfererror')->withErrors($validator)->withInput();
            }
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }    
        $userDetails = DB::table('users')->where('id',$request->user_id)->first(); 
        if($userDetails->login_token == $request->header('auth-token'))
        {   
        $postData = array(
            //"state"=>'OPEN',
            "card_token"=>$request->card_token,
            "state"=>'PAUSED',
            //"memo" =>$request->name_on_card,
            //"spend_limit"=>(int)$request->card_limit,
            //"spend_limit_duration" =>$request->spend_limit_duration,
            );
        //if(!empty($request->name_on_card))    
       // dd($postData);    
        $api_key = config('app.PRIVACY_API_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.PRIVACY_API_URL').'/card',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Authorization: api-key $api_key",
            ),
        ));
       
        $CreatedResponse = json_decode(curl_exec($curl));
        if(!empty($CreatedResponse->debugging_request_id))
        {
            return response()->json(['status'=>'0','response'=>$CreatedResponse->message], 400);
            //return back()->with('alert',);
        } else {
            //dd($CreatedResponse);
            $updateCard = array(
                //'user_id'=>Auth::id(),
                'host_name'=>$CreatedResponse->memo,
                'memo'=>$CreatedResponse->memo,
                //'last_four_digit'=>$CreatedResponse->last_four,
                //'exp_month'=>$CreatedResponse->exp_month,
                //'exp_year'=>$CreatedResponse->exp_year,
                //'cvv'=>$CreatedResponse->cvv,
                //'pan'=>$CreatedResponse->pan,
                'spend_limit'=>$CreatedResponse->spend_limit/100,
                'spend_limit_duration'=>$CreatedResponse->spend_limit_duration,
                'card_state'=>$CreatedResponse->state,
                //'token'=>$CreatedResponse->token,
                'type'=>$CreatedResponse->type,
                'updated_at'=>date('Y-m-d h:i:s')
                );
                
           $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->update($updateCard);
           //dd($cardUpdated);
           if($cardUpdated)
           {     //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$request->user_id,
                         'title'=>'Virtual Card',
                         'desription'=>"Your virtual card ending with last four digit XXXX".$CreatedResponse->last_four." has been successfully deactived.",
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION 
               return response()->json(['status'=>'1','response'=>'Virtual Card updated successfully'], 200);
              // return back()->with('success','Virtual Card updated successfully.');
           } else {
               return response()->json(['status'=>'1','response'=>'Virtual Card updated successfully'], 200);
               //return back()->with('alert','Virtual Card updated successfully but value is not updated in DB!');
           }
        }
     } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }   
        //curl_close($curl);
   }
   
     public function openVirtualCard(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'user_id'=>['required'],
                'card_token'=>['required']
            ]);
            if ($validator->fails()) {
                 return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
                //return redirect()->route('transfererror')->withErrors($validator)->withInput();
            }
         if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }    
        $userDetails = DB::table('users')->where('id',$request->user_id)->first(); 
        if($userDetails->login_token == $request->header('auth-token'))
        { 
        $postData = array(
            //"state"=>'OPEN',
            "card_token"=>$request->card_token,
            "state"=>'OPEN',
            //"memo" =>$request->name_on_card,
            //"spend_limit"=>(int)$request->card_limit,
            //"spend_limit_duration" =>$request->spend_limit_duration,
            );
        //if(!empty($request->name_on_card))    
       // dd($postData);    
        $api_key = config('app.PRIVACY_API_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.PRIVACY_API_URL').'/card',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Authorization: api-key $api_key",
            ),
        ));
       
        $CreatedResponse = json_decode(curl_exec($curl));
        if(!empty($CreatedResponse->debugging_request_id))
        {
            return response()->json(['status'=>'0','response'=>$CreatedResponse->message], 400);
        } else {
            //dd($CreatedResponse);
            $updateCard = array(
                //'user_id'=>Auth::id(),
                'host_name'=>$CreatedResponse->memo,
                'memo'=>$CreatedResponse->memo,
                //'last_four_digit'=>$CreatedResponse->last_four,
                //'exp_month'=>$CreatedResponse->exp_month,
                //'exp_year'=>$CreatedResponse->exp_year,
                //'cvv'=>$CreatedResponse->cvv,
                //'pan'=>$CreatedResponse->pan,
                'spend_limit'=>$CreatedResponse->spend_limit/100,
                'spend_limit_duration'=>$CreatedResponse->spend_limit_duration,
                'card_state'=>$CreatedResponse->state,
                //'token'=>$CreatedResponse->token,
                'type'=>$CreatedResponse->type,
                 'updated_at'=>date('Y-m-d h:i:s')
               
                );
                
           $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->update($updateCard);
           //dd($cardUpdated);
           if($cardUpdated)
           {    //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$request->user_id,
                         'title'=>'Virtual Card',
                         'desription'=>"Your virtual card ending with last four digit XXXX".$CreatedResponse->last_four." has been successfully actived.",
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION 
                return response()->json(['status'=>'1','response'=>'Virtual Card updated successfully'], 200);
           } else {
                return response()->json(['status'=>'1','response'=>'Virtual Card updated successfully'], 200);
               //return back()->with('alert','Virtual Card updated successfully but value is not updated in DB!');
           }
        }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }     
        //curl_close($curl);
   }
   
   public function closeVirtualCard(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'user_id'=>['required'],
                'card_token'=>['required']
            ]);
            if ($validator->fails()) {
                 return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }    
        $userDetails = DB::table('users')->where('id',$request->user_id)->first(); 
        if($userDetails->login_token == $request->header('auth-token'))
        {  
        $postData = array(
            "card_token"=>$request->card_token,
            "state"=>'CLOSED',
            );
       
        $api_key = config('app.PRIVACY_API_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.PRIVACY_API_URL').'/card',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Authorization: api-key $api_key",
            ),
        ));
       
        $CreatedResponse = json_decode(curl_exec($curl));
        if(!empty($CreatedResponse->debugging_request_id))
        {
             return response()->json(['status'=>'0','response'=>$CreatedResponse->message], 400);
        } else {
            //dd($CreatedResponse);
            $updateCard = array(
                //'user_id'=>Auth::id(),
                'host_name'=>$CreatedResponse->memo,
                'memo'=>$CreatedResponse->memo,
                //'last_four_digit'=>$CreatedResponse->last_four,
                //'exp_month'=>$CreatedResponse->exp_month,
                //'exp_year'=>$CreatedResponse->exp_year,
                //'cvv'=>$CreatedResponse->cvv,
                //'pan'=>$CreatedResponse->pan,
                'spend_limit'=>$CreatedResponse->spend_limit/100,
                'spend_limit_duration'=>$CreatedResponse->spend_limit_duration,
                'card_state'=>$CreatedResponse->state,
                //'token'=>$CreatedResponse->token,
                'type'=>$CreatedResponse->type,
                'updated_at'=>date('Y-m-d h:i:s')
                );
                
           $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->update($updateCard);
           //dd($cardUpdated);
           if($cardUpdated)
           {
               //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$request->user_id,
                         'title'=>'Virtual Card',
                         'desription'=>"Your virtual card ending with last four digit XXXX".$CreatedResponse->last_four." has been successfully closed.",
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION 
               return response()->json(['status'=>'1','response'=>'Virtual Card updated successfully'], 200);
           } else {
              return response()->json(['status'=>'1','response'=>'Virtual Card updated successfully'], 200);
               //return back()->with('alert','Virtual Card updated successfully but value is not updated in DB!');
           }
        }
    } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }    
        //curl_close($curl);
   }
   
   public function virtualtransactions($card_token='')
    {
       $data['title'] = "Card Transaction History";
       $data['card_last_four_by_url'] = $card_token;
        $data['AllTransactionsList'] = $this->getTransactionsList($card_token);
       return view('user.virtualtransactions.index',$data);
         
    }
    
    public function getTransactionsList(Request $request)
    {
       $validator = Validator::make($request->all(), [
                'card_token' => 'required|string|max:255',
            ]);
        if ($validator->fails()) {
          
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
        $check = DB::table('users')->where('login_token',$request->header('auth-token'))->first();
        if(!empty($check))
        {
            /*
            $api_key = config('app.PRIVACY_API_KEY');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.PRIVACY_API_URL').'/transaction?card_token='.$request->card_token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            //CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => array(
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                    "Authorization: api-key $api_key",
                ),
            ));
           
            $TransactionsResponse = json_decode(curl_exec($curl));
            
            //dd($TransactionsResponse);
            if(!empty($TransactionsResponse->debugging_request_id))
            {
                return response()->json(['status'=>'0','response'=>$TransactionsResponse->message], 400);
                //return back()->with('alert',$TransactionsResponse->message);
            } else {
                return response()->json(['status'=>'1','response'=>'Fetched successfully','Data'=>$TransactionsResponse->data], 200);
                //return $TransactionsResponse->data;
                //return back()->with('success','Transactions get successfully.');
               
            } 
            */
            
           $data =  DB::table('transactions')->where('card_token',$request->card_token)->get();
           if(count($data) > 0)
           {
                return response()->json(['status'=>'1','response'=>'Fetched Successfully','Data'=>$data], 200);
           } else {
                return response()->json(['status'=>'0','response'=>'No data fund!'], 400);
           }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }
    }

    public function getCardsList($card_token ='')
    {
        //dd($card_token);
      /*   $postData = array(
        "card_token"=>$request->card_token,
        "memo" =>$request->name_on_card,
        "spend_limit"=>(int)$request->card_limit,
        "spend_limit_duration" =>$request->spend_limit_duration,
        ); */
        //if(!empty($request->name_on_card))    
       // dd($postData);    
        $api_key = config('app.PRIVACY_API_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.PRIVACY_API_URL').'/card?card_token='.$card_token,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        //CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Authorization: api-key $api_key",
            ),
        ));
       
        $TransactionsResponse = json_decode(curl_exec($curl));
        //dd($TransactionsResponse);
        if(!empty($TransactionsResponse->debugging_request_id))
        {
            return back()->with('alert',$TransactionsResponse->message);
        } else {
            return $TransactionsResponse->data;
            //return back()->with('success','Transactions get successfully.');
           
        } 
    }


    public function getVirtualCardsList()
    {
      /*   $postData = array(
        "card_token"=>$request->card_token,
        "memo" =>$request->name_on_card,
        "spend_limit"=>(int)$request->card_limit,
        "spend_limit_duration" =>$request->spend_limit_duration,
        ); */
        //if(!empty($request->name_on_card))    
       // dd($postData);    
        $api_key = config('app.PRIVACY_API_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.PRIVACY_API_URL').'/card?card_token=7913',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        //CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Authorization: api-key $api_key",
            ),
        ));
       
        $TransactionsResponse = json_decode(curl_exec($curl));
        dd($TransactionsResponse->data);
        if(!empty($TransactionsResponse->debugging_request_id))
        {
            return back()->with('alert',$TransactionsResponse->message);
        } else {
            return $TransactionsResponse->data;
            //return back()->with('success','Transactions get successfully.');
           
        } 
    }
    
    public function instantIssue()
    {
        if(Auth::user()->kyc_status == 1)
        {
            $data['title'] = "Instant Issue Card";
            $data['virtualCardsProductType'] = DB::table('virtual_cards_product_type')
                                        ->WhereIn('status',array(1))
                                        ->get();
            return view('user.instantissue.index',$data);
        } else {
            return redirect('user/upgrade')->with('alert','Sorry, your KYC in incomplete, please upload it first!');
        }
         
    }
    
    public function instantIssueDesigns($product_type_id)
    { 
       $data['title'] = "Select Design";
       $data['product_type_id'] = $product_type_id;
       $data['virtualCardsProductDesigns'] = DB::table('virtual_cards_design')
                                    ->WhereIn('status',array(1))
                                    ->get();
         
       
        return view('user.instantissue.products_design',$data);
         
    }
    
    public function selectVcardPlan($product_type_id,$design_id)
    {  
       $data['title'] = "Select Card Plan";
       $data['product_type_id'] = $product_type_id;
       $data['design_id'] = $design_id;
       $data['virtualCardsProductDesigns'] = DB::table('virtual_cards_design')
                                    ->where('id',$design_id)
                                    ->WhereIn('status',array(1))
                                    ->first();
         
       $data['allplans'] = DB::table('virtual_cards_plan')
                            ->WhereIn('status',array(1))
                            ->orderBy('plan_quantity','ASC')
                            ->get();
        return view('user.instantissue.product_quantity',$data);
         
    }
    
    public function completeOrder($product_type_id,$design_id,$plan_id)
    {  
       $data['title'] = "Complete Order";
       
      $planDetails =  DB::table('virtual_cards_plan')->where('id',$plan_id)->first();
      if($plan_id == 0)
      { 
          return back()->with('success','Coming soon!.');
      } elseif($plan_id == '-1'){
          
         return back()->with('success','Coming soon!.');
      } else {
          $url_link = $planDetails->payment_link;
          //dd($url_link);
          Session::put('product_type_id',$product_type_id);
          Session::put('design_id',$design_id);
          Session::put('plan_id',$plan_id);
          Session::put('vcard_user_id',Auth::id());
          //Session::put('product_type_id',$product_type_id);
          //Session::put('product_type_id',$product_type_id);
          
          return Redirect::to($url_link);

        // header('Location:'.$url_link);//->back()->with('success','');
      }
       
         
    }
    
    public function vCardOrders()
    {  
       $data['title'] = "List of Orders";
       
       $data['virtualCardsOrders'] = DB::table('virtual_cards_orders')
                                    //->where('id',$design_id)
                                    ->select('virtual_cards_orders.*')
                                    ->join('users','users.id','=','virtual_cards_orders.user_id')
                                    ->where('user_id',Auth::id())
                                    ->WhereIn('virtual_cards_orders.status',array(1))
                                    ->orderBy('virtual_cards_orders.id','DESC')
                                    ->get();
         
       //dd($data['virtualCardsOrders']);
        return view('user.instantissue.vcard_orders',$data);
         
    }
   
   public function checkWalletBalance(Request $request)
   {
      $validator=Validator::make($request->all(), [
                'amount' => ['required'],
                
            ]);
            if ($validator->fails()) {
               // return back()->with('alert',$validator->errors());
                 return response()->json(['result'=>'0','response'=>$validator->messages()], 400);
                
            }
        $userDetails = DB::table('users')->where('id',Auth::id())->first();   
        if($userDetails->balance >= $request->amount)
        {
            return response()->json(['result'=>'1','response'=>'Great!, You are eligible for this limit.'], 200);
        } else {
            return response()->json(['result'=>'0','response'=>'Sorry, Insufficient balance in your wallet!'], 400);
        }
   }
   
   public function webHook_forPrivacy(Request $request)
   {    echo "Working";
       
   }
   
   public function webHook_forPrivacy2()
   {
        Session::put('name','subodh222');
        //dd(Session::get('name'));
       print_r(Session::get('testing_webhookData'));echo "<br>Next";
       print_r(Session::get('testing_webhookData2'));
       dd(Session::get('testing_webhookData3'));
       
       //DB::table('virtual_card_events')->insert(['result'=>$request->all()]);
   }
   
    public function getCardLimits(Request $request)
    {
       $validator = Validator::make($request->all(), [
                'card_token' => 'required|string|max:255',
            ]);
        if ($validator->fails()) {
          
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }   
       if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
        }
        $check = DB::table('users')->where('login_token',$request->header('auth-token'))->first();
        if(!empty($check))
        {
        $api_key = config('app.PRIVACY_API_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.PRIVACY_API_URL').'/card?card_token='.$request->card_token,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        //CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Authorization: api-key $api_key",
            ),
        ));
       
        $TransactionsResponse = json_decode(curl_exec($curl));
        //dd($TransactionsResponse);
        if(!empty($TransactionsResponse->debugging_request_id))
        {
            return response()->json(['status'=>'0','response'=>$TransactionsResponse->message], 400);
            //return back()->with('alert',$TransactionsResponse->message);
        } else {
            return response()->json(['status'=>'1','response'=>'Fetched successfully','Data'=>$TransactionsResponse], 200);
            //return $TransactionsResponse->data;
            //return back()->with('success','Transactions get successfully.');
           
        } 
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          } 
    }
    
     public function getTransactionsList2($card_token ='')
    {
        //dd($card_token);
      /*   $postData = array(
        "card_token"=>$request->card_token,
        "memo" =>$request->name_on_card,
        "spend_limit"=>(int)$request->card_limit,
        "spend_limit_duration" =>$request->spend_limit_duration,
        ); */
        //if(!empty($request->name_on_card))    
       // dd($postData);    
        $api_key = config('app.PRIVACY_API_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.PRIVACY_API_URL').'/transaction?card_token='.$card_token,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        //CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Authorization: api-key $api_key",
            ),
        ));
       
        $TransactionsResponse = json_decode(curl_exec($curl));
        //dd($TransactionsResponse);
        if(!empty($TransactionsResponse->debugging_request_id))
        {
            return back()->with('alert',$TransactionsResponse->message);
        } else {
            return $TransactionsResponse->data;
            //return back()->with('success','Transactions get successfully.');
           
        } 
    }
}