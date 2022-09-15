<?php

namespace App\Http\Controllers;

require_once('/home/cuminup/public_html/asset/vendor_phpseclib/autoload.php');

use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\RSA;

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
use App\Models\ReissueCard;

class VirtualCardController extends Controller
{

        
    public function __construct()
    {		
        $set=Settings::first();
        $this->site_name = $set->site_name;
        $this->site_address = $set->address;
    }
    
    public function virtualcard()
    { 
        $data['title'] = "Virtual Card";
        $data['virtualCardsList'] = DB::table('virtual_cards')
                                    ->select('virtual_cards.*','virtual_cards_funding_accounts.account_name as FundingAccount','virtual_cards_funding_accounts.last_four as FundingLastFour')
                                    ->join('virtual_cards_funding_accounts','virtual_cards_funding_accounts.id','=','virtual_cards.funding_account_id')
                                    ->where('user_id',Auth::id())
                                    ->where('plastic_card', 'No')
                                    ->orderBy('virtual_cards.id', 'DESC')
                                    ->get();
        $OrdataCheck = array('OPEN','PAUSED','CLOSED','PENDING_FULFILLMENT');                            
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
       
       $data['AllvCardPlanOrders'] = DB::table('virtual_cards_orders')
                                        ->select('virtual_cards_orders.*','virtual_cards_plan.plan_name')
                                       ->join('virtual_cards_plan','virtual_cards_plan.id','=','virtual_cards_orders.plan_id')
                                       ->where(['user_id'=>Auth::id()])->where('remain_qty','>',0)
                                       ->get();
        if(!empty(Auth::id()) && !empty($_GET['n']))
        {
            $notify_id = $_GET['n'];
            $update = DB::table('notification')->where('id',$notify_id)->update(['read_status_for_sender'=>1]);
        }
        return view('user.virtualcard.index',$data);
         
    } 

    public function newdashboard()
        { 
            //DB::table('users')->where('id',Auth::id())->update(['fa_expiring'=>Carbon::now()->addMinutes(30)]);
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
                                     ->orderBy('virtual_cards.id','DESC')
                                    ->get();
                    $alltrx = [];                
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
        $data['AlltrxList']  = DB::table('virtual_card_events')->where(['user_id'=>Auth::id()])->orderBy('id','DESC')->get();
           
       
       $data['AllvCardDesigns'] = DB::table('virtual_cards_design')->where('status',1)->get(); 
       
       $data['transactions']=Transactions::wherereceiver_id(Auth::guard('user')->user()->id)->latest()->get();
            $data['transfers']=Transfer::whereSender_id(Auth::guard('user')->user()->id)->orderby('id', 'desc')->get();//Transfer::wherereceiver_id(Auth::guard('user')->user()->id)->latest()->get();
            $user=Auth::guard('user')->user()->id ?? '0';
            //$data['ext']=Exttransfer::whereuser_id($user)->orWhere('receiver_id', $user)->latest()->get();
            
            //$data['plan']=$plan=Plans::whereref_id($id)->first();
        $data['subscribers']=Subscribers::whereuser_id(Auth::guard('user')->user()->id)->latest()->get();
        return view('user.newdashboard.index',$data);
             
        } 
    
    public function createCard(Request $request)
    { 
        $validator=Validator::make($request->all(), [
            'name_on_card' => ['required', 'max:255', 'string'],
            'card_limit' => ['required'],
            'spend_limit_duration'=> ['required']
        ]);
        
        if ($validator->fails()) {
            return back()->with('alert',$validator->errors());
        }
        
        $pin = base64_decode(1234);
       
        if(empty($request->card_type) || $request->card_type == 'PHYSICAL')
        {
            $card_type = 'PHYSICAL';
            if($request->card_type == 'PHYSICAL')
            {
                $plastic_card = 'Yes';
            } else {
                $plastic_card = 'No';
            }
        } else {
            $card_type = $request->card_type;
            $plastic_card = 'No';
        }
        
        $checkPlan = DB::table('virtual_cards_orders')->where('user_id',Auth::id())->where('remain_qty','!=','0')->orderBy('id','ASC')->get();
       
        $userDetails = DB::table('users')->where('id',Auth::id())->first();
        
        $adminDetails = DB::table('settings')->first();
        
        if($request->card_type == 'PHYSICAL'){
            $new_amount = $request->card_limit + $adminDetails->physical_card;
            $shipping_charge = $adminDetails->physical_card;
        }else{
            $new_amount = $request->card_limit;
            $shipping_charge = '0';
        }
      
        if($userDetails->balance >= $new_amount)
        {   
            if(count($checkPlan) > 0)
            { 
                $iso3_country = DB::table('countries_iso3')->where('code', $request->postal_country)->first();
                //dd($iso3_country->iso3);
                
                $shipingData = array(
                    "first_name" => $request->first_name,
                    "last_name" => $request->last_name,
                    "address1" => $request->postal_address,
                    "city" => $request->postal_city,
                    "state" => $request->postal_state,
                    "zipcode" => $request->postal_zip_code,
                    "country" => $iso3_country->iso3,
                );
                
                //dd($shipingData);
                    
                $postData = array(
                    "type"=>$card_type,
                    "state"=>'PAUSED',
                    "memo" =>$request->name_on_card,
                    "spend_limit"=>(int)$request->card_limit*100,
                    "spend_limit_duration" =>$request->spend_limit_duration,
                    "shipping_address" => $shipingData
                );
                
                //dd($postData);
          
                $api_url = config('app.PRIVACY_API_URL');
                $api_key = config('app.PRIVACY_API_KEY');
                
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $api_url.'/card?account_token='.$userDetails->account_token,
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
                
                //dd($CreatedResponse);
               
                if(!empty($CreatedResponse->debugging_request_id))
                {
                    return back()->with('alert',$CreatedResponse->message);
                } else {
                    $insertCard = array(
                        'user_id'=>Auth::id(),
                        'host_name'=>$CreatedResponse->memo,
                        'memo'=>$CreatedResponse->memo,
                        'last_four_digit'=>$CreatedResponse->last_four,
                        'spend_limit'=>$CreatedResponse->spend_limit/100,
                        'spend_limit_duration'=>$CreatedResponse->spend_limit_duration,
                        'is_paused_by_admin'=>1,
                        'token'=>$CreatedResponse->token,
                        'type'=>$CreatedResponse->type,
                        'design_id'=>$checkPlan[0]->design_id,
                        'plastic_card'=>$plastic_card,
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
                        
                        $vcardLimitCheck = DB::table('users')->where('id',Auth::id())->first();
                        
                       
                       //POSTAL ADDRESS
                       $postalAdd = array();
                       if(!empty($request->first_name))
                       {
                            $postalAdd['first_name'] = $request->first_name;
                       }
                       if(!empty($request->last_name))
                       {
                            $postalAdd['last_name'] = $request->last_name;
                       }
                       if(!empty($request->postal_address))
                       {
                            $postalAdd['postal_address'] = $request->postal_address;
                       }
                       if(!empty($request->postal_city))
                       {
                            $postalAdd['postal_city']=$request->postal_city;
                       }
                       if(!empty($request->postal_state))
                       {
                            $postalAdd['postal_state']=$request->postal_state;
                       }
                       if(!empty($request->postal_country))
                       {
                            $postalAdd['postal_country']=$request->postal_country;
                       }
                       if(!empty($request->postal_zip_code))
                       {
                            $postalAdd[ 'postal_zip_code']=$request->postal_zip_code;
                       }
                        if($request->card_type == 'PHYSICAL')
                        {
                            $postalAdd['user_id'] = Auth::id();
                            $postalAdd['vcard_id'] = $cardInserted;
                            $postalAdd['shipping_charge'] = $shipping_charge;
                            DB::table('virtual_card_physical_address')->insert($postalAdd); 
                        }
                        if($plastic_card == 'Yes')
                        {
                            $cardType = "Physical Card";
                        } else {
                            $cardType = "Virtual Card";
                        }
                        
                        //NOTIFY ADMIN
                        $text = $vcardLimitCheck->business_name ." has been apply for the ".$cardType." with the username ".$CreatedResponse->memo." ending with last four digit XXXX".$CreatedResponse->last_four;
                        send_email($adminDetails->email, $this->site_name.' Admin', "New ".$cardType." Applied", $text);
                       
                        DB::table('users')->where('id',Auth::id())->update(['cvard_limit'=>number_format($vcardLimitCheck->cvard_limit-1),'updated_at'=>date('Y-m-d H:i:s')]);
                        
                        $sav['ref_id']=str_random(16);
                        $sav['type']=4;
                        $sav['amount']=$new_amount;
                        $sav['email']=$userDetails->email;
                        $sav['first_name']=$userDetails->first_name;
                        $sav['last_name']=$userDetails->last_name;
                        $sav['charge']=$shipping_charge;
                        $sav['transaction_type'] = 'dr';
                        //$sav['ip_address']=user_ip();
                        $sav['receiver_id']=$userDetails->id;//$link->user_id;
                        $sav['status']= 1;
                        $sav['payment_type']='card_limit';
                        Transactions::create($sav);
                        
                        DB::table('virtual_cards_orders')->where('id',$checkPlan[0]->id)->update(['remain_qty'=>number_format($checkPlan[0]->remain_qty-1),'created_qty'=>number_format($checkPlan[0]->created_qty+1),'updated_at'=>date('Y-m-d H:i:s')]);
                        //NOTIFY USER
                        $card_login_url = url('user/virtualcard');
                        
                        if($plastic_card == 'Yes')
                        {
                            $text = "Hi ".$vcardLimitCheck->first_name.",<br><br>
        
                            Thank you for applying for Physical Card.<br>
                            Your card's on its way!<br>
                            Your card has been submitted for activation.<br>
                            We will notify you once card is ready for dispatch.<br>
                            You can activate it in the app as soon as it arrives.<br><br>
                            For more details about your card, click on the link below: <br>
                            ".$card_login_url."<br><br>

Until then, why not set up your virtual card?<br><br>


1.	It's a digital debit card, saved in your Monese app<br>
2.	It has its own card number, giving you extra protection for spending online<br>
3.	Link it to your Apple Pay and Google pay to spend right from your phone<br>
4.	Lock your physical card if you lose it, and pay with your virtual card instead<br>
5.	Top up straight away using another one of your debit cards.<br>

Ready to get spending?<br>

<a href=".$card_login_url.">Creat Virtual Card</a> <br><br><br>
                            If you have any questions, just reply to this email.<br><br>
                            Thanks,<br>
                            The ".$this->site_name." Team<br><br>
                            <p style='color:gray;font-size:13px;'>Sent with care from<br>
                            
                            ".$this->site_name.", Inc.<br>
                            The ".$this->site_name." Team<br>
                    
                            ".$this->site_address."</p>";
                        } else {
                            $text = "Hi ".$vcardLimitCheck->first_name.",<br><br>
        
                            A new virtual card has just been created in your account. It will be activated soon.<br>
                            You can view your card status here: <br>
                            ".$card_login_url."<br><br>
                            
                            If you have any questions, just reply to this email.<br><br>
                            Thanks,<br>
                            The ".$this->site_name." Team<br><br>
                            <p style='color:gray;font-size:13px;'>Sent with care from<br>
                            
                            ".$this->site_name.", Inc.<br>
                            The ".$this->site_name." Team<br>
                    
                            ".$this->site_address."</p>";
                        }
                    
                        send_email2($vcardLimitCheck->email,$vcardLimitCheck->first_name." ".$vcardLimitCheck->last_name,"Your ".$this->site_name." ".$cardType." has been issued and will be activated soon.",$text); 
                        DB::table('users')->where('id',Auth::id())->update(['balance'=>($vcardLimitCheck->balance-$request->card_limit-$shipping_charge),'updated_at'=>date('Y-m-d H:i:s')]);
                        
                        if($plastic_card == 'Yes')
                        {
                            //NOTIFICATION
                            $notificationData = array(
                                'notify_type'=>'payment',
                                'type'=>'card',
                                'sender_id'=>Auth::id(),
                                'title'=>'Virtual Card',
                                'link'=>'user/virtualcard',
                                'desription'=>"Your physical card ending with last four digit XXXX".$CreatedResponse->last_four." has been created successfully.",
                                'created_at'=>date('Y-m-d H:i:s')
                            );
                            DB::table('notification')->insert($notificationData);
                            //END NOTIFICATION
                            
                            //ADMIN NOTIFICATION
                            $notificationData = array(
                                'notify_type'=>'payment',
                                'type'=>'card',
                                'receiver_id'=>1,
                                'title'=>'Create Physical Card',
                                'link'=>'admin/virtual_cards',
                                'receiver_description'=>'A user named '.$vcardLimitCheck->first_name.' '.$vcardLimitCheck->last_name.' has created physical card ending with last four digit XXXX'.$CreatedResponse->last_four.'.',
                                'created_at'=>date('Y-m-d H:i:s')
                            );
                            DB::table('notification')->insert($notificationData);
                            //END NOTIFICATION 
                            
                            $audit['user_id']=Auth::guard('user')->user()->id;
                            $audit['trx']=str_random(16);
                            $audit['log']="Created physical card ending with last four digit XXXX".$CreatedResponse->last_four." has been created successfully.";
                            Audit::create($audit);
                            return back()->with('success','You have successfully applied for Physical Card.');
                             
                        } else {
                            //NOTIFICATION
                            $notificationData = array(
                                'notify_type'=>'payment',
                                'type'=>'card',
                                'sender_id'=>Auth::id(),
                                'title'=>'Virtual Card',
                                'link'=>'user/virtualcard',
                                'desription'=>"Your virtual card ending with last four digit XXXX".$CreatedResponse->last_four." has been created successfully.",
                                'created_at'=>date('Y-m-d H:i:s')
                            );
                            DB::table('notification')->insert($notificationData);
                            //END NOTIFICATION 
                            
                            //ADMIN NOTIFICATION
                            $notificationData = array(
                                'notify_type'=>'payment',
                                'type'=>'card',
                                'receiver_id'=>1,
                                'title'=>'Create Virtual Card',
                                'link'=>'admin/virtual_cards',
                                'receiver_description'=>'A user named '.$vcardLimitCheck->first_name.' '.$vcardLimitCheck->last_name.' has created virtual card ending with last four digit XXXX'.$CreatedResponse->last_four.'.',
                                'created_at'=>date('Y-m-d H:i:s')
                                 );
                            DB::table('notification')->insert($notificationData);
                            //END NOTIFICATION 
                            
                            $audit['user_id']=Auth::guard('user')->user()->id;
                            $audit['trx']=str_random(16);
                            $audit['log']="Created virtual card ending with last four digit XXXX".$CreatedResponse->last_four." has been created successfully.";
                            Audit::create($audit);
                            return back()->with('success','Virtual Card created successfully.');
                        }
                   } else {
                       return back()->with('alert','Virtual Card created successfully but value is not inserted in DB!');
                   }
                }
            } else { 
                 return back()->with('alert','Sorry you have no active plan yet!');
            }
        } else {
             return back()->with('alert','Sorry, Insufficient balance in your wallet!');
        }
   }
   
   public function updateVirtualCard(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'name_on_card' => ['required', 'max:255', 'string'],
                'card_limit' => ['required'],
               
                
                'card_token'=>['required']
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
                //return redirect()->route('transfererror')->withErrors($validator)->withInput();
            }
         //dd($request->card_token);
        //$memo = 'Jhon Deo';
        //$type = 'UNLOCKED';
        //$funding_token = '46e9a102-1d8e-489c-a19e-b314ccc219ac';
        //$pin = base64_decode(1234);
        //$spend_limit = 100;
        //$spend_limit_duration = 'FOREVER';
        //$state = 'OPEN';
        //$shipping_address = NULL;
        //$product_id = NULL;
       
        $oldCardDetails = DB::table('virtual_cards')->where(['user_id'=>Auth::id(),'token'=>$request->card_token])->first();
        $newBalance = ($request->card_limit-$oldCardDetails->spend_limit);
        $userDetails = DB::table('users')->where('id',Auth::id())->first();  
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
               // dd($CreatedResponse);
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
                   
                    );
                    
               $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>Auth::id(),'token'=>$request->card_token])->update($updateCard);
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
                $sav['status']= 1;
                $sav['payment_type']='card_limit';
                Transactions::create($sav);
               DB::table('users')->where('id',Auth::id())->update(['balance'=>($userDetails->balance-$newBalance),'updated_at'=>date('Y-m-d H:i:s')]);
               //dd($cardUpdated);
               if($cardUpdated)
               {
                  //NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'card',
                     'sender_id'=>Auth::id(),
                     'title'=>'Virtual Card',
                     'link'=>'user/virtualcard',
                     'desription'=>"Your virtual card ending with last four digit XXXX".$CreatedResponse->last_four." has been updated successfully.",
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION
                //ADMIN NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'card',
                     'receiver_id'=>1,
                     'title'=>'Update Prepaid Card',
                     'link'=>'admin/virtual_cards',
                     'receiver_description'=>'A user named '.$userDetails->first_name.' '.$userDetails->last_name.' has updated prepaid card ending with last four digit XXXX'.$CreatedResponse->last_four.'.',
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION 
                $audit['user_id']=Auth::guard('user')->user()->id;
                $audit['trx']=str_random(16);
                $audit['log']="Prepaid card ending with last four digit XXXX".$CreatedResponse->last_four." has been updated successfully.";
                Audit::create($audit);
                   return back()->with('success','Virtual Card updated successfully.');
               } else {
                   return back()->with('success','Virtual Card updated successfully.');
                   //return back()->with('alert','Virtual Card updated successfully but value is not updated in DB!');
               }
            }
        } else {
             return back()->with('alert','Sorry, Insufficient balance in your wallet!');
        }
        
        //curl_close($curl);
   }
   
   public function pausedVirtualCard(Request $request)
    {
           $validator=Validator::make($request->all(), [
                
                'card_token'=>['required']
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
                //return redirect()->route('transfererror')->withErrors($validator)->withInput();
            }
         
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
                'card_state'=>$CreatedResponse->state,
                //'token'=>$CreatedResponse->token,
                'type'=>$CreatedResponse->type,
               
                );
                
           $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>Auth::id(),'token'=>$request->card_token])->update($updateCard);
           //dd($cardUpdated);
           if($cardUpdated)
           {
                $cardDetails = DB::table('virtual_cards')->where(['user_id'=>Auth::id(),'token'=>$request->card_token])->first();
               //NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'card',
                     'sender_id'=>Auth::id(),
                     'title'=>'Virtual Card',
                     'link'=>'user/virtualcard',
                     'desription'=>"Your virtual card ending with last four digit XXXX".$cardDetails->last_four_digit." has been deactived successfully.",
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION 
              $userDetails = DB::table('users')->where('id',Auth::id())->first();
                //ADMIN NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'card',
                     'receiver_id'=>1,
                     'title'=>'Paused Prepaid Card',
                     'link'=>'admin/virtual_cards',
                     'receiver_description'=>'A user named '.$userDetails->first_name.' '.$userDetails->last_name.' has deactived prepaid card ending with last four digit XXXX'.$cardDetails->last_four_digit.'.',
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION
                $audit['user_id']=Auth::guard('user')->user()->id;
                $audit['trx']=str_random(16);
                $audit['log']="Prepaid card ending with last four digit XXXX".$cardDetails->last_four_digit." has been deactived successfully.";
                Audit::create($audit);
               return back()->with('success','Virtual Card updated successfully.');
           } else {
               return back()->with('success','Virtual Card updated successfully.');
               //return back()->with('alert','Virtual Card updated successfully but value is not updated in DB!');
           }
        }
        
        //curl_close($curl);
   }
   
     public function openVirtualCard(Request $request)
    {
           $validator=Validator::make($request->all(), [
                
                'card_token'=>['required']
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
                //return redirect()->route('transfererror')->withErrors($validator)->withInput();
            }
         //dd($request->card_token);
        //$memo = 'Jhon Deo';
        //$type = 'UNLOCKED';
        //$funding_token = '46e9a102-1d8e-489c-a19e-b314ccc219ac';
        //$pin = base64_decode(1234);
        //$spend_limit = 100;
        //$spend_limit_duration = 'FOREVER';
        //$state = 'OPEN';
        //$shipping_address = NULL;
        //$product_id = NULL;
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
                'card_state'=>$CreatedResponse->state,
                //'token'=>$CreatedResponse->token,
                'type'=>$CreatedResponse->type,
               
                );
                
           $cardUpdated = DB::table('virtual_cards')->where(['token'=>$request->card_token])->update($updateCard);
           //dd($cardUpdated);
           if($cardUpdated)
           {
                $cardDetails = DB::table('virtual_cards')->where(['token'=>$request->card_token])->first();
                //last_four_digit
               //NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'card',
                     'sender_id'=>Auth::id(),
                     'title'=>'Virtual Card',
                     'link'=>'user/virtualcard',
                     'desription'=>"Your virtual card ending with last four digit XXXX".$cardDetails->last_four_digit." has been actived successfully.",
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION 
                $userDetails = DB::table('users')->where('id',Auth::id())->first();
                //ADMIN NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'card',
                     'receiver_id'=>1,
                     'title'=>'Activate Prepaid Card',
                     'link'=>'admin/virtual_cards',
                     'receiver_description'=>'A user named '.$userDetails->first_name.' '.$userDetails->last_name.' has activate prepaid card ending with last four digit XXXX'.$cardDetails->last_four_digit.'.',
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION
                $audit['user_id']=Auth::guard('user')->user()->id;
                $audit['trx']=str_random(16);
                $audit['log']="Prepaid card ending with last four digit XXXX".$cardDetails->last_four_digit." has been actived successfully.";
                Audit::create($audit);
               return back()->with('success','Virtual Card updated successfully.');
           } else {
               return back()->with('success','Virtual Card updated successfully.');
               //return back()->with('alert','Virtual Card updated successfully but value is not updated in DB!');
           }
        }
        
        //curl_close($curl);
   }
   
   public function closeVirtualCard(Request $request)
    {
           $validator=Validator::make($request->all(), [
                
                'card_token'=>['required']
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
                //return redirect()->route('transfererror')->withErrors($validator)->withInput();
            }
         //dd($request->card_token);
        //$memo = 'Jhon Deo';
        //$type = 'UNLOCKED';
        //$funding_token = '46e9a102-1d8e-489c-a19e-b314ccc219ac';
        //$pin = base64_decode(1234);
        //$spend_limit = 100;
        //$spend_limit_duration = 'FOREVER';
        //$state = 'OPEN';
        //$shipping_address = NULL;
        //$product_id = NULL;
        $postData = array(
            //"state"=>'OPEN',
            "card_token"=>$request->card_token,
            "state"=>'CLOSED',
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
                'card_state'=>$CreatedResponse->state,
                //'token'=>$CreatedResponse->token,
                'type'=>$CreatedResponse->type,
               
                );
                
           $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>Auth::id(),'token'=>$request->card_token])->update($updateCard);
           //dd($cardUpdated);
           if($cardUpdated)
           {
               $cardDetails = DB::table('virtual_cards')->where(['token'=>$request->card_token])->first();
                //last_four_digit
               //NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'card',
                     'sender_id'=>Auth::id(),
                     'title'=>'Virtual Card',
                     'link'=>'user/virtualcard',
                     'desription'=>"Your virtual card ending with last four digit XXXX".$cardDetails->last_four_digit." has been closed successfully.",
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION
                 $userDetails = DB::table('users')->where('id',Auth::id())->first();
                //ADMIN NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'card',
                     'receiver_id'=>1,
                     'title'=>'Closed Prepaid Card',
                     'link'=>'admin/virtual_cards',
                     'receiver_description'=>'A user named '.$userDetails->first_name.' '.$userDetails->last_name.' has closed prepaid card ending with last four digit XXXX'.$cardDetails->last_four_digit.'.',
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION
                $audit['user_id']=Auth::guard('user')->user()->id;
                $audit['trx']=str_random(16);
                $audit['log']="Prepaid card ending with last four digit XXXX".$cardDetails->last_four_digit." has been closed successfully.";
                Audit::create($audit);
               return back()->with('success','Virtual Card updated successfully.');
           } else {
               return back()->with('success','Virtual Card updated successfully.');
               //return back()->with('alert','Virtual Card updated successfully but value is not updated in DB!');
           }
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
    
    public function getTransactionsList($card_token ='')
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
            $data['title'] = "Instant Issue Card";
            $data['virtualCardsProductType'] = DB::table('virtual_cards_product_type')
                                        ->WhereIn('status',array(1))
                                        ->get();
            return view('user.instantissue.index',$data);
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
       $data['productType_details'] = DB::table('virtual_cards_product_type')->where('id',$product_type_id)->first();
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
       
       /*$data['virtualCardsOrders'] = DB::table('virtual_cards_orders')
                                    //->where('id',$design_id)
                                    ->select('virtual_cards_orders.*')
                                    ->join('users','users.id','=','virtual_cards_orders.user_id')
                                    ->where('user_id',Auth::id())
                                    ->WhereIn('virtual_cards_orders.status',array(1))
                                    ->orderBy('virtual_cards_orders.id','DESC')
                                    ->get();
                                    */
         $data['virtualCardsOrders'] = DB::table('virtual_cards_orders')
                                    //->where('id',$design_id)
                                    ->select('virtual_cards_orders.*','virtual_cards_plan.plan_name','virtual_cards_plan.plan_quantity')
                                    ->join('users','users.id','=','virtual_cards_orders.user_id')
                                     ->leftjoin('virtual_cards_plan','virtual_cards_plan.id','=','virtual_cards_orders.plan_id')
                                     ->where('virtual_cards_orders.user_id',Auth::id())
                                    ->WhereIn('virtual_cards_orders.status',array(1))
                                    ->orderBy('virtual_cards_orders.id','DESC')
                                    ->get();                            
        if(!empty(Auth::id()) && !empty($_GET['n']))
        {
            $notify_id = $_GET['n'];
            $update = DB::table('notification')->where('id',$notify_id)->update(['read_status_for_sender'=>1]);
        } 
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
   { 
       
    //dd($trxListURL);
    // $request->amount
    //$request->merchant['descriptor']
    //$request->card['last_four']
    // $request->events[0]['type']
        $insertData = array(
           'amount'=>$request->amount,
           'result'=>$request->result,
           'trx_status'=>$request->status,
           'settled_amount'=>$request->settled_amount,
           'trx_created_at'=>$request->created,
           'merchant_descriptor'=>$request->merchant['descriptor'],
          'merchant_city'=>$request->merchant['city'],
           'merchant_state'=>$request->merchant['state'],
           'merchant_country'=>$request->merchant['country'],
           'merchant_acceptor_id'=>$request->merchant['acceptor_id'],
           //'card_amount'=>$request->card['amount'],
         'card_last_four'=>$request->card['last_four'],
           'card_memo'=>$request->card['memo'],
           'card_type'=>$request->card['type'],
           'card_spend_limit'=>$request->card['spend_limit'],
           'card_pan'=>$request->card['pan'],
           'card_token'=>$request->card['token'],
            'events_type'=>$request->events[0]['type'],
           'events_result'=>$request->events[0]['result'],
           );
     
       $insertEventResult = DB::table('virtual_card_events')->insertGetId($insertData); 
       if($insertEventResult)
       {
           $eventData = DB::table('virtual_card_events')->where(['id'=>$insertEventResult])->first();
           if(!empty($eventData))
           {
               $userIndntify =  DB::table('virtual_cards')->where(['last_four_digit'=>$eventData->card_last_four,'pan'=>$eventData->card_pan])->first(); 
               $userData = DB::table('users')->where('id',$userIndntify->user_id)->first();
               $trxListURL =  url('/user/virtualtransactions')."/".$eventData->card_token;
               if($eventData->trx_status == 'VOIDED')
               {
                   $trx_status = 'DECLINE';
               } else {
                   $trx_status = $eventData->trx_status;
               }
               
               //$userDetails = DB::table('users')->where('id',$request->user_id)->first();
                $insertDataTrx = array(
                'email'=>$userData->email,
                'first_name'=>$userData->first_name,
                'last_name'=>$userData->last_name,
                'receiver_id'=>$userData->id,
                'amount'=>$request->amount,
                'charge'=>0,
                'type'=>1,
               'transaction_type'=>'dr',
                'payment_type'=>'card',
                'payment_link'=>1,
                'ref_id'=>str_random(16),//$request->details['id'],
                'status'=>1,
                'card_token'=>$request->card['token'],
                'created_at'=>date('Y-m-d H:i:s')
                );
               $addedTrx = DB::table('transactions')->insert($insertDataTrx);
               //NOTIFY USER
                $text = "<b>$".$eventData->amount."</b> was ".$eventData->events_type." at ".$eventData->merchant_descriptor." on your <b>".$eventData->card_memo."</b> card ending with XXXXXX".$eventData->card_last_four.".<br><br><center><a href='".$trxListURL."' class='btn btn-primary'>View Transactions</a></center><br>
                 <br><br> Let us know if you have any questions.<br><br>

Thanks,<br>
The ".$this->site_name." Team<br><br>
<p style='color:gray;font-size:13px;'>Sent with care from<br>

".$this->site_name.", Inc.<br>
The ".$this->site_name." Team<br>
            
            ".$this->site_address."</p>";
               $emailSent = send_email2($userData->email, $userData->first_name .$userData->last_name, "Transaction Notification for card ending XXXXXX".$eventData->card_last_four.", Status ".$trx_status, $text);
               
               
               
               DB::table('virtual_card_events')->where('id',$insertEventResult)->update(['user_notify'=>1,'updated_at'=>date('Y-m-d h:i:s')]);
              
           }       
           
       }
       return response()->json(['result'=>'1','response'=>'Working','Data'=>json_encode($request->all())], 200);
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
   
   public function selectCountry_byState(Request $request)
   {
      $validator=Validator::make($request->all(), [
                'country_id' => ['required'],
                
            ]);
            if ($validator->fails()) {
               // return back()->with('alert',$validator->errors());
                 return response()->json(['result'=>'0','response'=>$validator->messages()], 400);
                
            }
        //$userDetails = DB::table('users')->where('id',Auth::id())->first();
        $states =DB::table('states')->where('country_id',$request->country_id)->orderby('name','ASC')->get();
        if($states)
        {
            
            return response()->json(['result'=>'1','response'=>'Great!, You are eligible for this limit.','Data'=>$states,$request->country_id], 200);
        } else {
            return response()->json(['result'=>'0','response'=>'Sorry, Insufficient balance in your wallet!'], 400);
        }
   }
   
   public function physicalcard()
   {
        $data['title'] = "Physical Card";
        $data['virtualCardsList'] = DB::table('virtual_cards')
                                    ->select('virtual_cards.*','virtual_cards_funding_accounts.account_name as FundingAccount','virtual_cards_funding_accounts.last_four as FundingLastFour')
                                    ->join('virtual_cards_funding_accounts','virtual_cards_funding_accounts.id','=','virtual_cards.funding_account_id')
                                    ->where('user_id',Auth::id())
                                    ->where('plastic_card', 'Yes')
                                    ->orderBy('virtual_cards.id', 'DESC')
                                    ->get();
        $OrdataCheck = array('OPEN','PAUSED','CLOSED','PENDING_FULFILLMENT');                            
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
       
       $data['AllvCardPlanOrders'] = DB::table('virtual_cards_orders')
                                        ->select('virtual_cards_orders.*','virtual_cards_plan.plan_name')
                                       ->join('virtual_cards_plan','virtual_cards_plan.id','=','virtual_cards_orders.plan_id')
                                       ->where(['user_id'=>Auth::id()])->where('remain_qty','>',0)
                                       ->get();
        if(!empty(Auth::id()) && !empty($_GET['n']))
        {
            $notify_id = $_GET['n'];
            $update = DB::table('notification')->where('id',$notify_id)->update(['read_status_for_sender'=>1]);
        }
        
        return view('user.physicalcard.index',$data);
   }
   
    public function createpin(Request $request)
    { 
        $validator=Validator::make($request->all(), [
            'secret_pin' => ['required', 'max:12', 'min:4'],
        ]);
        
        if ($validator->fails()) {
            return back()->with('alert',$validator->errors());
        }
        
        $card_token = $request->card_token;
        $secret_pin = $request->secret_pin;
        $nonce = random_int(100000000, 1000000000000);
        
        $lithic_params = [
            'nonce' => $nonce,
            'pin' => $secret_pin,
        ];

        $j_blob = json_encode($lithic_params);
        
        
        $assets_url = config('app.url');
        $path= $assets_url.'asset/key/api.lithic.com.pub.pem'; 
        
        $key = PublicKeyLoader::load(file_get_contents($path), $password = false);
        
        $key = $key->withPadding(RSA::ENCRYPTION_PKCS1);
        
        $new_secret = base64_encode($key->encrypt($j_blob));

        //dd($new_secret);
        
        
        //$pin = base64_decode(1234);
        
        if($new_secret)
        {
            DB::table('virtual_cards')->where('token',$card_token)->update(['pin_generate'=>'1']);
            return back()->with('success','Pin generated successfully.');
        } else {
            return back()->with('alert','Something went wrong!');
        } 
    }
    
    public function reissueCard(Request $request)
    { 
        $validator=Validator::make($request->all(), [
            'card_token' => ['required'],
        ]);
        
        if ($validator->fails()) {
            return back()->with('alert',$validator->errors());
        }
        
        $card_token = $request->card_token;
        $plastic_card = 'Yes';
        
        $checkPlan = DB::table('virtual_cards_orders')->where('user_id',Auth::id())->where('remain_qty','!=','0')->orderBy('id','ASC')->get();
        
        $userDetails = DB::table('users')->where('id',Auth::id())->first();
      
        if($card_token)
        { 
            $postData = array(
                "card_token"=>$card_token,
            );
                
            $api_url = config('app.PRIVACY_API_URL');
            $api_key = config('app.PRIVACY_API_KEY');
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url.'/card/reissue',
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
                
            //dd($CreatedResponse);
            
            if(!empty($CreatedResponse->debugging_request_id))
            {
                return back()->with('alert',$CreatedResponse->message);
            } else {
                
                $check_card = DB::table('reissue_cards')->where('card_token', $card_token)->orderBy('id','DESC')->first();
                if($check_card){
                    DB::table('reissue_cards')->where('card_token',$card_token)->update(['status'=>'0']);
                }
                
                $insertCard = array(
                    'user_id'=>Auth::id(),
                    'card_token'=>$card_token,
                    'status'=>'1',
                );
                    
                $cardInserted = DB::table('reissue_cards')->insertGetId($insertCard);
               
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
                    $vcardLimitCheck = DB::table('users')->where('id',Auth::id())->first();
                    $adminDetails = DB::table('settings')->first();
                   
                   //POSTAL ADDRESS
                  
                    if($plastic_card == 'Yes')
                    {
                        $cardType = "Physical Card";
                    } else {
                        $cardType = "Virtual Card";
                    }
                    
                    //NOTIFY ADMIN
                    $text = $vcardLimitCheck->business_name ." has been apply for the ".$cardType." with the username ".$CreatedResponse->memo." ending with last four digit XXXX".$CreatedResponse->last_four;
                    send_email($adminDetails->email, $this->site_name.' Admin', "New ".$cardType." Applied", $text);
                   
                    DB::table('users')->where('id',Auth::id())->update(['cvard_limit'=>number_format($vcardLimitCheck->cvard_limit-1),'updated_at'=>date('Y-m-d H:i:s')]);
                    $sav['ref_id']=str_random(16);
                    $sav['type']=4;
                    $sav['amount']='0';
                    $sav['email']=$userDetails->email;
                    $sav['first_name']=$userDetails->first_name;
                    $sav['last_name']=$userDetails->last_name;
                    $sav['charge']=$adminDetails->physical_card;
                    $sav['transaction_type'] = 'dr';
                    //$sav['ip_address']=user_ip();
                    $sav['receiver_id']=$userDetails->id;//$link->user_id;
                    $sav['status']= 1;
                    $sav['payment_type']='card_limit';
                    Transactions::create($sav);
                    
                    DB::table('virtual_cards_orders')->where('id',$checkPlan[0]->id)->update(['remain_qty'=>number_format($checkPlan[0]->remain_qty-1),'created_qty'=>number_format($checkPlan[0]->created_qty+1),'updated_at'=>date('Y-m-d H:i:s')]);
                    //NOTIFY USER
                    $card_login_url = url('user/virtualcard');
                    
                    if($plastic_card == 'Yes')
                    {
                        $text = "Hi ".$vcardLimitCheck->first_name.",<br><br>
    
                        Thank you for applying for Physical Card. Your card has been submitted for activation. We will notify you once card is ready for dispatch. For more details about your card, click on the link below: <br>
                        ".$card_login_url."<br><br>
                        
                        If you have any questions, just reply to this email.<br><br>
                        Thanks,<br>
                        The ".$this->site_name." Team<br><br>
                        <p style='color:gray;font-size:13px;'>Sent with care from<br>
                        
                        ".$this->site_name.", Inc.<br>
                        The ".$this->site_name." Team<br>
                
                        ".$this->site_address."</p>";
                    } else {
                        $text = "Hi ".$vcardLimitCheck->first_name.",<br><br>
    
                         A new virtual card has just been created in your account. It will be activated soon.<br>
                            You can view your card status here: <br> <br>
                        ".$card_login_url."<br><br>
                        
                        If you have any questions, just reply to this email.<br><br>
                        Thanks,<br>
                        The ".$this->site_name." Team<br><br>
                        <p style='color:gray;font-size:13px;'>Sent with care from<br>
                        
                        ".$this->site_name.", Inc.<br>
                        The ".$this->site_name." Team<br>
                
                        ".$this->site_address."</p>";
                    }
                
                    send_email2($vcardLimitCheck->email,$vcardLimitCheck->first_name." ".$vcardLimitCheck->last_name,"Your ".$this->site_name." ".$cardType." has been issued and will be activated soon.",$text); 
                    DB::table('users')->where('id',Auth::id())->update(['balance'=>($vcardLimitCheck->balance-$request->card_limit-$adminDetails->physical_card),'updated_at'=>date('Y-m-d H:i:s')]);
                    
                    if($plastic_card == 'Yes')
                    {
                        //NOTIFICATION
                        $notificationData = array(
                            'notify_type'=>'payment',
                            'type'=>'card',
                            'sender_id'=>Auth::id(),
                            'title'=>'Virtual Card',
                            'link'=>'user/virtualcard',
                            'desription'=>"Your physical card ending with last four digit XXXX".$CreatedResponse->last_four." has been created successfully.",
                            'created_at'=>date('Y-m-d H:i:s')
                        );
                        DB::table('notification')->insert($notificationData);
                        //END NOTIFICATION
                        
                        //ADMIN NOTIFICATION
                        $notificationData = array(
                            'notify_type'=>'payment',
                            'type'=>'card',
                            'receiver_id'=>1,
                            'title'=>'Create Physical Card',
                            'link'=>'admin/virtual_cards',
                            'receiver_description'=>'A user named '.$vcardLimitCheck->first_name.' '.$vcardLimitCheck->last_name.' has created physical card ending with last four digit XXXX'.$CreatedResponse->last_four.'.',
                            'created_at'=>date('Y-m-d H:i:s')
                        );
                        DB::table('notification')->insert($notificationData);
                        //END NOTIFICATION 
                        
                        $audit['user_id']=Auth::guard('user')->user()->id;
                        $audit['trx']=str_random(16);
                        $audit['log']="Created physical card ending with last four digit XXXX".$CreatedResponse->last_four." has been created successfully.";
                        Audit::create($audit);
                        return back()->with('success','You have successfully applied for Physical Card.');
                         
                    } else {
                        //NOTIFICATION
                        $notificationData = array(
                            'notify_type'=>'payment',
                            'type'=>'card',
                            'sender_id'=>Auth::id(),
                            'title'=>'Virtual Card',
                            'link'=>'user/virtualcard',
                            'desription'=>"Your virtual card ending with last four digit XXXX".$CreatedResponse->last_four." has been created successfully.",
                            'created_at'=>date('Y-m-d H:i:s')
                        );
                        DB::table('notification')->insert($notificationData);
                        //END NOTIFICATION 
                        
                        //ADMIN NOTIFICATION
                        $notificationData = array(
                            'notify_type'=>'payment',
                            'type'=>'card',
                            'receiver_id'=>1,
                            'title'=>'Create Virtual Card',
                            'link'=>'admin/virtual_cards',
                            'receiver_description'=>'A user named '.$vcardLimitCheck->first_name.' '.$vcardLimitCheck->last_name.' has created virtual card ending with last four digit XXXX'.$CreatedResponse->last_four.'.',
                            'created_at'=>date('Y-m-d H:i:s')
                             );
                        DB::table('notification')->insert($notificationData);
                        //END NOTIFICATION 
                        
                        $audit['user_id']=Auth::guard('user')->user()->id;
                        $audit['trx']=str_random(16);
                        $audit['log']="Created virtual card ending with last four digit XXXX".$CreatedResponse->last_four." has been created successfully.";
                        Audit::create($audit);
                        return back()->with('success','Virtual Card created successfully.');
                    }
               } else {
                   return back()->with('alert','Virtual Card created successfully but value is not inserted in DB!');
               }
            }
                
        } else {
             return back()->with('alert','Sorry, Something went wrong!');
        }
   }
}