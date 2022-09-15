<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Admin;
use App\Models\Settings;
use App\Models\Logo;
use App\Models\Branch;
use App\Models\Bank;
use App\Models\Currency;
use App\Models\Transfer;
use App\Models\Adminbank;
use App\Models\Gateway;
use App\Models\Deposits;
use App\Models\Banktransfer;
use App\Models\Withdraw;
use App\Models\Withdrawm;
use App\Models\Merchant;
use App\Models\Social;
use App\Models\About;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Charges;
use App\Models\Exttransfer;
use App\Models\Requests;
use App\Models\Transactions;
use App\Models\Donations;
use App\Models\Paymentlink;
use App\Models\Plans;
use App\Models\Subscribers;
use App\Models\Audit;
use App\Models\Staff;
use Carbon\Carbon;
use Image;
use App\Models\ShipmentCourier;
use App\Models\SeoDetail;



class AdminController extends Controller
{

        
    public function __construct()
    {		
        $this->middleware('auth');
        $set=Settings::first();
        $this->site_name = $set->site_name;
        $this->site_address = $set->address;
    }

    public function Destroyuser($id)
    {
        $check=User::whereid($id)->first();
        $transfer = Transfer::where('Receiver_id', $id)->orWhere('Temp', $check->email)->delete();
        $bank_transfer = Banktransfer::whereUser_id($id)->delete();
        $deposit = Deposits::whereUser_id($id)->delete();
        $ticket = Ticket::whereUser_id($id)->delete();
        $withdraw = Withdraw::whereUser_id($id)->delete();
        $bank = Bank::whereUser_id($id)->delete();
        $exttransfer = Exttransfer::whereUser_id($id)->delete();
        $merchant = Merchant::whereUser_id($id)->delete();
        $product = Product::whereUser_id($id)->delete();
        $orders = Order::whereUser_id($id)->delete();
        $invoices = Invoice::whereUser_id($id)->delete();
        $charges = Charges::whereUser_id($id)->delete();
        $donations = Donations::whereUser_id($id)->delete();
        $paymentlink = Paymentlink::whereUser_id($id)->delete();
        $plans = Plans::whereUser_id($id)->delete();
        $requests = Requests::whereUser_id($id)->delete();
        $sub = Subscribers::whereUser_id($id)->delete();
        $trans = Transactions::where('Receiver_id', $id)->orWhere('Sender_id', $id)->delete();
        $user = User::whereId($id)->delete();
        return back()->with('success', 'User was successfully deleted');
    }     
    
    public function Destroystaff($id)
    {
        $staff = Admin::whereId($id)->delete();
        return back()->with('success', 'Staff was successfully deleted');
    }  
        
    public function dashboard()
    {
        $data['title']='Dashboard';
        $data['received']=Charges::sum('amount');
        $data['wd']=Withdraw::whereStatus(1)->sum('amount');
        $data['wdc']=Withdraw::whereStatus(1)->sum('charge');
        $data['mer']=Exttransfer::whereStatus(1)->sum('amount');
        $data['merc']=Exttransfer::whereStatus(1)->sum('charge');        
        $data['in']=Invoice::whereStatus(1)->sum('amount');
        $data['inc']=Invoice::whereStatus(1)->sum('charge');        
        $data['req']=Requests::whereStatus(1)->sum('amount');
        $data['reqc']=Requests::whereStatus(1)->sum('charge');        
        $data['tran']=Transfer::whereStatus(1)->sum('amount');
        $data['tranc']=Transfer::whereStatus(1)->sum('charge');        
        $data['sin']=Transactions::whereStatus(1)->wheretype(1)->sum('amount');
        $data['sinc']=Transactions::whereStatus(1)->wheretype(1)->sum('charge');        
        $data['do']=Transactions::whereStatus(1)->wheretype(2)->sum('amount');
        $data['doc']=Transactions::whereStatus(1)->wheretype(2)->sum('charge');        
        $data['or']=Order::whereStatus(1)->sum('total');
        $data['orc']=Order::whereStatus(1)->sum('charge');        
        $data['de']=Deposits::whereStatus(1)->sum('amount');
        $data['dec']=Deposits::whereStatus(1)->sum('charge');
        $data['totalusers']=User::count();
        $data['blockedusers']=User::whereStatus(1)->count();
        $data['activeusers']=User::whereStatus(0)->count();
        $data['Allactive'] = DB::table('virtual_cards')->where('card_state','OPEN')->get();
        $data['Allinactive'] = DB::table('virtual_cards')->where('card_state','PAUSED')->get();
        return view('admin.dashboard.index', $data);
    }    
    
    public function Users()
    {
		$data['title']='Clients';
		$data['users']=User::latest()->get();//DB::table('users')->where('status','!=','2')->orderBy('id','DESC')->get();//
        return view('admin.user.index', $data);
    } 
    
    public function enterprisePending()
    {
		$data['title']='Enterprise Pending';
		$data['users']=User::where(['send_for_verification'=>1,'kyc_status'=>4])->latest()->get();//DB::table('users')->where('status','!=','2')->orderBy('id','DESC')->get();//
        return view('admin.user.enterprise', $data);
    } 
    
    public function Staffs()
    {
		$data['title']='Staffs';
		$data['users']=Admin::where('id', '!=', 1)->latest()->get();
        return view('admin.user.staff', $data);
    }       

    public function Messages()
    {
		$data['title']='Messages';
		$data['message']=Contact::latest()->get();
        return view('admin.user.message', $data);
    }     

    public function Newstaff()
    {
		$data['title']='New Staff';
        return view('admin.user.new-staff', $data);
    }    
    
    public function Ticket()
    {
		$data['title']='Ticket system';
		$data['ticket']=Ticket::latest()->get();
        return view('admin.user.ticket', $data);
    }   
    
    public function Email($id,$name)
    {
		$data['title']='Send email';
		$data['email']=$id;
		$data['name']=$name;
        return view('admin.user.email', $data);
    }    
    
    public function Promo()
    {
		$data['title']='Send email';
        $data['client']=$user=User::all();
        return view('admin.user.promo', $data);
    } 
    
    public function Sendemail(Request $request)
    {        	
        $set=Settings::first();
        send_email($request->to, $request->name, $request->subject, $request->message);  
        return back()->with('success', 'Mail Sent Successfuly!');
    }
    
    public function Sendpromo(Request $request)
    {   if($request->email_type == 'all')
        {
            $set=Settings::first();
            $user=User::all();
            foreach ($user as $val) {
                $x=User::whereEmail($val->email)->first();
                if($set->email_notify==1){
                    send_email($x->email, $x->username, $request->subject, $request->message);
                }
            }      
            return back()->with('success', 'Mail Sent Successfuly!');
        } else {
            $set=Settings::first();
            foreach($request->user_id as $user_id)
            {
                $user=DB::table('users')->where('id',$user_id)->get();
                
                foreach ($user as $val) {
                    $x=User::whereEmail($val->email)->first();
                    if($set->email_notify==1){
                        send_email($x->email, $x->username, $request->subject, $request->message);
                    }
                }      
                
            }
            return back()->with('success', 'Mail Sent Successfuly!');
        }    
    }     
    
    public function Replyticket(Request $request)
    {        
        $data['ticket_id'] = $request->ticket_id;
        $data['reply'] = $request->reply;
        $data['status'] = 0;
        $data['staff_id'] = $request->staff_id;
        $res = Reply::create($data);  
        $set=Settings::first();   
        $ticket=Ticket::whereticket_id($request->ticket_id)->first();
        //$ticket->updated_at = date('Y-m-d h:i:s');
        //$ticket->save();
        $user=User::find($ticket->user_id);
        //NOTIFICATION
        //SENDER USER
         $notificationData = array(
             'notify_type'=>'payment',
             'type'=>'Reply Ticket',
             'sender_id'=>$ticket->user_id,
             'title'=>'New Reply',
             'link'=>'user/ticket',
             'desription'=>"You have received a new reply on your support ticket ID".$ticket->ticket_id,
             'created_at'=>date('Y-m-d H:i:s')
             );
         DB::table('notification')->insert($notificationData);
        //END NOTIFICATION
        if($set['email_notify']==1){
            send_email($user->email, $user->username, 'New Reply - '.$request->ticket_id, $request->reply);
        } 
        if ($res) {
            return back();
        } else {
            return back()->with('alert', 'An error occured');
        }
    }    
    
    public function Createstaff(Request $request)
    {        
        $check=Admin::whereusername($request->username)->get();
        if(count($check)<1){
            $data['username'] = $request->username;
            $data['last_name'] = $request->last_name;
            $data['first_name'] = $request->first_name;
            $data['password'] = Hash::make($request->password);
            $data['profile'] = $request->profile;
            $data['support'] = $request->support;
            $data['promo'] = $request->promo;
            $data['message'] = $request->message;
            $data['deposit'] = $request->deposit;
            $data['settlement'] = $request->settlement;
            $data['transfer'] = $request->transfer;
            $data['request_money'] = $request->request_money;
            $data['donation'] = $request->donation;
            $data['single_charge'] = $request->single_charge;
            $data['subscription'] = $request->subscription;
            $data['merchant'] = $request->merchant;
            $data['invoice'] = $request->invoice;
            $data['charges'] = $request->charges;
            $data['store'] = $request->store;
            $data['blog'] = $request->blog;
            $res = Admin::create($data);  
            return redirect('admin.staffs')->with('success', 'Staff was successfully created');
        }else{
            return back()->with('alert', 'username already taken');
        }
    }       
     
    
    public function Destroymessage($id)
    {
        $data = Contact::findOrFail($id);
        $res =  $data->delete();
        if ($res) {
            return back()->with('success', 'Request was Successfully deleted!');
        } else {
            return back()->with('alert', 'Problem With Deleting Request');
        }
    }     
    
    public function Destroyticket($id)
    {
        $data = Ticket::findOrFail($id);
        $res =  $data->delete();
        if ($res) {
            return back()->with('success', 'Request was Successfully deleted!');
        } else {
            return back()->with('alert', 'Problem With Deleting Request');
        }
    } 

    public function Manageuser($id)
    {
        $user_token=User::find($id);
        
        $api_url = config('app.PRIVACY_API_URL');
        $api_key = config('app.PRIVACY_API_KEY');
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/account?account_token='.$user_token->account_token);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
           "Content-Type: application/json",
           "Authorization: api-key ".$api_key
        ]);
        
        $response = curl_exec($ch);
        
        curl_close($ch);
        
        
    
        // 26-11-2020
        
        //     if(isset($_SERVER['HTTP_REFERER'])) {
        //       echo $_SERVER['HTTP_REFERER'];
        //   }
        $userseen=User::find($id);
        $userseen->seen=1;
        $userseen->save();
        // 26-11-2020
        $data['client']=$user=User::find($id);
        
        $get_token = json_decode($response);
        
        //dd($get_token);
       
        
        //dd($result->data[0]->spend_limit);
        
        $data['title']=$user->business_name;
        $data['deposit']=Deposits::whereUser_id($user->id)->orderBy('id', 'DESC')->get();
        $data['transfer']=Transfer::wheresender_id($user->id)->orderBy('id', 'DESC')->get();
        $data['withdraw']=Withdraw::whereUser_id($user->id)->orderBy('id', 'DESC')->get();
        $data['ticket']=Ticket::whereUser_id($user->id)->orderBy('id', 'DESC')->get();
        $data['audit']=Audit::whereUser_id($user->id)->orderBy('created_at', 'DESC')->get();
        
        if(!empty($get_token)){
            $data['get_token']=$get_token;
        }
        
        if(!empty(Auth::id()) && !empty($_GET['n']))
            {
                $notify_id = $_GET['n'];
                $update = DB::table('notification')->where('id',$notify_id)->update(['read_status_for_receiver'=>1]);
            } 
        
        return view('admin.user.edit', $data);
    } 
    
    public function multiUserUpdate(Request $request)
    {
        dd($request->all());
    }
    
    public function Managestaff($id)
    {
        $data['staff']=$user=Admin::find($id);
        $data['title']=$user->username;
        return view('admin.user.edit-staff', $data);
    }    

    public function staffPassword(Request $request)
    {
        $user = Admin::whereid($request->id)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Password Changed Successfully.');

    }
    
    public function Manageticket($id)
    {
        $data['ticket']=$ticket=Ticket::find($id);
        $data['title']='#'.$ticket->ticket_id;
        $data['client']=User::whereId($ticket->user_id)->first();
        $data['reply']=Reply::whereTicket_id($ticket->ticket_id)->get();
        if(!empty(Auth::id()) && !empty($_GET['n']))
        {
            $notify_id = $_GET['n'];
            $update = DB::table('notification')->where('id',$notify_id)->update(['read_status_for_receiver'=>1]);
        }
        return view('admin.user.edit-ticket', $data);
    }    
    
    public function Closeticket($id)
    {
        $ticket=Ticket::find($id);
        $ticket->status=1;
        $ticket->save();
        //SENDER USER
         $notificationData = array(
             'notify_type'=>'support',
             'type'=>'Resolved Ticket',
             'sender_id'=>$ticket->user_id,
             'title'=>'Resolved Ticket',
             'link'=>'user/ticket',
             'desription'=>"Your support ticket ID ".$ticket->ticket_id." has been resolved and closed.",
             'created_at'=>date('Y-m-d H:i:s')
             );
         DB::table('notification')->insert($notificationData);
        //END NOTIFICATION
        //NOTIFICATION
         $notificationData = array(
             'notify_type'=>'payment',
             'type'=>'card',
             'receiver_id'=>1,
             'title'=>'Resolved Ticket',
             'link'=>'admin/ticket',
             'receiver_description'=>'Support ticket ID '.$ticket->ticket_id.' has been resolved and closed.',
             'created_at'=>date('Y-m-d H:i:s')
             );
         DB::table('notification')->insert($notificationData);
        //END NOTIFICATION
        return back()->with('success', 'Ticket has been closed.');
    }     
    
    public function Blockuser($id)
    {
        $user=User::find($id);
        $user->status=1;
        $user->save();
        return back()->with('success', 'User has been suspended.');
    } 

    public function Unblockuser($id)
    {
        $user=User::find($id);
        $user->status=0;
        $user->save();
        return back()->with('success', 'User was successfully unblocked.');
    }    
    
    public function Blockstaff($id)
    {
        $user=Admin::find($id);
        $user->status=1;
        $user->save();
        return back()->with('success', 'Staff has been suspended.');
    } 

    public function Unblockstaff($id)
    {
        $user=Admin::find($id);
        $user->status=0;
        $user->save();
        return back()->with('success', 'Staff was successfully unblocked.');
    }

    public function Approvekyc($id)
    {
        $user=User::find($id);
        $user->kyc_status=1;
        // 26-11-2020
        $user->user_seen=0;
        $user->user_type=2;
        // 26-11-2020
        $user->estore_activation=1;
        //$user->transfer_activation=1;
        $user->request_activation=1;
        $user->invoice_activation=1;
        $user->payment_link_activation=1;
        $user->save();
        
        if ($user) {
            $login_url = url('/login');
            $text = "Welcome to ".$this->site_name.", ".$user->first_name."<br>
                    Your Business Account has been approved and ready to use. We're excited to be working with you.<br><br>
                    Here are a few things you can do to get started: <br>
                    fund your account, <br>
                    issue yourself a Virtual Card, <br>
                    or invite your team.<br><br>
                    <center><a href=".$login_url." class='btn btn-primary' style='border-radius: 45px;'>View Account</a></center>
                    <br><br>
                    If you have any questions, just reply to this email.<br><br>
                    Thanks,<br>
                    The ".$this->site_name." Team<br>
                    <p style='color:gray;font-size:13px;'>Sent with care from<br>
                    ".$this->site_name.", Inc.<br>
                    ".$this->site_address."</p>";
            send_email2($user->email,$user->business_name,"Your ".$this->site_name." Enterprise account is verified now and ready to use.",$text);
            //$text = "Your Account is successfully verified.";
           // send_email($user->email, $user->business_name, 'Hello '.$user->business_name, $text);
            
            //send_email($user->email, $user->business_name, 'Your Business Account is approved', 'Now you can login as Business here dashboard.<a href='.$login_url.'>Click Here..</a>');
        }
        //NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'KYC',
                     'sender_id'=>$user->id,
                     'title'=>'KYC Approved',
                     'link'=>'/user/doc-verification',
                     'desription'=>"Your enterprise account has been approved successfully.",
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION  
        return back()->with('success', 'Kyc has been approved.');
    }    

    public function Rejectkyc(Request $request,$id)
    {
        $user=User::find($id);
        //$this->sendDocLinkEmail($user->email);
       
        // $user->kyc_status='';
        $user->kyc_status=2;
        // 26-11-2020
        $user->user_seen=0;
        $user->seen = 0;
        // 26-11-2020
        $user->comment=$request->comment;
        $user->user_type=1;
        
        $user->kyc_link= NULL;
        $user->save();
        
        if ($user) {
            $text = "Your Account is rejected.";
            send_email($user->email, $user->business_name, 'Hello '.$user->business_name, $text);
            send_email($user->email, $user->business_name, 'Welcome to CuminUp Go-Cashless', 'Your Account is rejected becaause' .$request->comment);
            $this->sendDocLinkEmail($user->email);
        }
        //NOTIFICATION
                 $notificationData = array(
                     'notify_type'=>'payment',
                     'type'=>'KYC',
                     'sender_id'=>$user->id,
                     'title'=>'KYC Rejected',
                     'link'=>'user/doc-verification',
                     'desription'=>"Your enterprise account has been rejected successfully.",
                     'created_at'=>date('Y-m-d H:i:s')
                     );
                 DB::table('notification')->insert($notificationData);
                //END NOTIFICATION  
        return back()->with('success', 'Kyc was successfully rejected.');
    }
    
    public function requestPassword(Request $request,$id)
    {
        $validator=Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator)->withInput();
            return back()->with('alert', 'Password not changed.');
        }
        else{
            $user=User::find($id);
            $user->password=Hash::make($request->password);
            $user->save();
            
            return back()->with('success', 'Password Changed Successfully.');
        }
    }

    public function Profileupdate(Request $request)
    {
        $data = User::findOrFail($request->id);
        $data->business_name=$request->business_name;
        $data->first_name=$request->first_name;
        $data->last_name=$request->last_name;
        $data->phone=$request->mobile;
        $data->office_address=$request->address;
        $data->balance=$request->balance;
        $data->website_link=$request->website;
        if($request->virtual_card_activation == 'on')
        {
            $data->virtual_card_activation = 1;
        } else {
            $data->virtual_card_activation = 0;
        }
         if($request->estore_activation == 'on')
        {
            $data->estore_activation = 1;
        } else {
            $data->estore_activation = 0;
        }
        
        if($request->transfer_activation == 'on')
        {
            $data->transfer_activation = 1;
        } else {
            $data->transfer_activation = 0;
        }
        
        if($request->request_activation == 'on')
        {
            $data->request_activation = 1;
        } else {
            $data->request_activation = 0;
        }
        
        if($request->invoice_activation == 'on')
        {
            $data->invoice_activation = 1;
        } else {
            $data->invoice_activation = 0;
        }
        
        if($request->payment_link_activation == 'on')
        {
            $data->payment_link_activation = 1;
        } else {
            $data->payment_link_activation = 0;
        }
        if(empty($request->email_verify)){
            $data->email_verify=0;	
        }else{
            $data->email_verify=$request->email_verify;
        }             
        if(empty($request->fa_status)){
            $data->fa_status=0;	
        }else{
            $data->fa_status=$request->fa_status;
        }         
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }    
    public function Staffupdate(Request $request)
    {
        $data = Admin::whereid($request->id)->first();
        $data->username=$request->username;
        $data->first_name=$request->first_name;
        $data->last_name=$request->last_name;
        if(empty($request->profile)){
            $data->profile=0;	
        }else{
            $data->profile=$request->profile;
        }  

        if(empty($request->support)){
            $data->support=0;	
        }else{
            $data->support=$request->support;
        }    

        if(empty($request->promo)){
            $data->promo=0;	
        }else{
            $data->promo=$request->promo;
        }     

        if(empty($request->message)){
            $data->message=0;	
        }else{
            $data->message=$request->message;
        }     

        if(empty($request->deposit)){
            $data->deposit=0;	
        }else{
            $data->deposit=$request->deposit;
        }     

        if(empty($request->settlement)){
            $data->settlement=0;	
        }else{
            $data->settlement=$request->settlement;
        }     

        if(empty($request->transfer)){
            $data->transfer=0;	
        }else{
            $data->transfer=$request->transfer;
        }     

        if(empty($request->request_money)){
            $data->request_money=0;	
        }else{
            $data->request_money=$request->request_money;
        }               
        
        if(empty($request->donation)){
            $data->donation=0;	
        }else{
            $data->donation=$request->donation;
        }          
        
        if(empty($request->single_charge)){
            $data->single_charge=0;	
        }else{
            $data->single_charge=$request->single_charge;
        }          
        
        if(empty($request->subscription)){
            $data->subscription=0;	
        }else{
            $data->subscription=$request->subscription;
        }          
        
        if(empty($request->merchant)){
            $data->merchant=0;	
        }else{
            $data->merchant=$request->merchant;
        }          
        
        if(empty($request->invoice)){
            $data->invoice=0;	
        }else{
            $data->invoice=$request->invoice;
        }          
        
        if(empty($request->charges)){
            $data->charges=0;	
        }else{
            $data->charges=$request->charges;
        }     

        if(empty($request->store)){
            $data->store=0;	
        }else{
            $data->store=$request->store;
        }   

        if(empty($request->blog)){
            $data->blog=0;	
        }else{
            $data->blog=$request->blog;
        }  

        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->flash('message', 'Just Logged Out!');
        return redirect('/admin');
    }
    
    
    public function carriers(Request $request)
    {       
        require_once("/home/getvirtualcardco/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        \EasyPost\EasyPost::setApiKey("EZAK4389aea5296f4f149758fee56d5c6256yrwo6IY5Mh096aW6ynLiMg");
        
        $carrier_types = \EasyPost\CarrierAccount::types();
        
        //dd($carrier_types);
        
        foreach ($carrier_types as $carrier) {
            $all_carriers[] = array ( 
                $rs = ShipmentCourier::updateOrCreate([
                    'object' => $carrier->object, 
                    'type' => $carrier->type, 
                    'readable' => $carrier->readable, 
                    'logo' => $carrier->logo,
                    'access_key_id' => $carrier->fields['credentials']['access_key_id'],
                    'secret_key' => $carrier->fields['credentials']['secret_key'],
                    'merchant_id' => $carrier->fields['credentials']['merchant_id'],
                ])
            );
        }
        
        $carriers = ShipmentCourier::orderBy('id', 'desc')->get();
        
       // dd($carriers);
       
        if($rs)
        {
           return view('admin.shipment.carrier')->with(['title'=>'Delivery Partners List', 'carriers'=>$carriers]);
        }   
    }
    
    public function carriersEdit(Request $request, $courierId)
    {       
        $courierData = ShipmentCourier::where('id', $courierId)->get();
        
        if($courierData)
        {
           return view('admin.shipment._editcarrier')->with(['title'=>'Edit Delivery Partners', 'courierData'=>$courierData]);
        }
    }
    
    public function carriersUpdate(Request $request, $courierId)
    {       
        
        $data = [
           'status' => $request->input('status'),
        ];
       
        $rs = ShipmentCourier::where(['id'=> $courierId])->update($data);
       
        if($rs){
        //   return back()->with('success', trans('Courier Partner updated Successfully.'));
           return back()->with('success', 'Update was Successful!');
        }
    }
    
    public function virtualCards()
    {
       $data['title'] = "Virtual Card";
        $data['virtualCardsList'] = DB::table('virtual_cards')
                                    ->select('virtual_cards.*','virtual_cards_funding_accounts.account_name as FundingAccount','virtual_cards_funding_accounts.last_four as FundingLastFour','users.first_name as FirstName','users.last_name as LastName','users.email')
                                    ->join('virtual_cards_funding_accounts','virtual_cards_funding_accounts.id','=','virtual_cards.funding_account_id')
                                    ->join('users','users.id','=','virtual_cards.user_id')
                                    ->where('virtual_cards.is_deleted',0)
                                    ->orderBy('virtual_cards.id', 'DESC')
                                    ->get();
        foreach($data['virtualCardsList'] as $k=>$cardDetails)
        {
             //= count($this->getTransactionsList($cardDetails->token));
             $totalAmount = 0;
            
           foreach(app('App\Http\Controllers\VirtualCardController')->getTransactionsList($cardDetails->token) as $cardTransactionDetails)
           {
                $totalAmount =  $totalAmount + $cardTransactionDetails->amount;
           }
           $data['virtualCardsList'][$k]->restAmount = $totalAmount;
        }                            
        
        if(!empty(Auth::id()) && !empty($_GET['n']))
        {
            $notify_id = $_GET['n'];
            $update = DB::table('notification')->where('id',$notify_id)->update(['read_status_for_receiver'=>1]);
        }
        
        return view('admin.user.virtualcard',$data);
         
    } 
    
    
    
    public function pausedVirtualCard(Request $request)
    {  
       $validator=Validator::make($request->all(), [
            'user_id'=>['required'],
            'card_token'=>['required']
        ]);
        if ($validator->fails()) {
            return back()->with('alert',$validator->errors());
        }
        
        $postData = array(
            "card_token"=>$request->card_token,
            "state"=>'PAUSED',
        );
         
        $api_url = config('app.PRIVACY_API_URL');
        $api_key = config('app.PRIVACY_API_KEY');

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url.'/card',
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
            
            $updateCard = array(
                'host_name'=>$CreatedResponse->memo,
                'memo'=>$CreatedResponse->memo,
                'spend_limit'=>$CreatedResponse->spend_limit,
                'spend_limit_duration'=>$CreatedResponse->spend_limit_duration,
                'card_state'=>$CreatedResponse->state,
                'is_paused_by_admin'=>1,
                'type'=>$CreatedResponse->type,
               
            );
                
           $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->update($updateCard);
           if($cardUpdated)
           {
                 $cardDetails = DB::table('virtual_cards')->where(['token'=>$request->card_token])->first();
                
                //last_four_digit
                //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$request->user_id,
                         'title'=>'Virtual Card',
                         'link'=>'user/virtualcard',
                         'desription'=>"Your virtual card ending with last four digit XXXX".$cardDetails->last_four_digit." has been deactivated successfully.",
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION 
               return back()->with('success','Virtual Card updated successfully.');
           } else {
               return back()->with('success','Virtual Card updated successfully.');
           }
        }
        
        curl_close($curl);
   }
   
    public function openVirtualCard(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'user_id'=>['required'],
            'card_token'=>['required']
        ]);
        if ($validator->fails()) {
            return back()->with('alert',$validator->errors());
        }
        
        $postData = array(
            "card_token"=>$request->card_token,
            "state"=>'OPEN',
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
            return back()->with('alert',$CreatedResponse->message);
        } else {
            $updateCard = array(
                'host_name'=>$CreatedResponse->memo,
                'memo'=>$CreatedResponse->memo,
                'spend_limit'=>$CreatedResponse->spend_limit,
                'spend_limit_duration'=>$CreatedResponse->spend_limit_duration,
                'card_state'=>$CreatedResponse->state,
                'type'=>$CreatedResponse->type,
               
                );
                
           $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->update($updateCard);
           if($cardUpdated)
           {
                 $cardDetails = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->first();
               //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$request->user_id,
                         'title'=>'Virtual Card',
                          'link'=>'user/virtualcard',
                         'desription'=>"Your virtual card ending with last four digit XXXX".$cardDetails->last_four_digit." has been activated successfully.",
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION 
               return back()->with('success','Virtual Card updated successfully.');
           } else {
               return back()->with('success','Virtual Card updated successfully.');
           }
        }
        
        curl_close($curl);
   }
   
   public function closeVirtualCard(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'user_id'=>['required'],
                'card_token'=>['required']
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
            }
        
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
            return back()->with('alert',$CreatedResponse->message);
        } else {
            $updateCard = array(
                'host_name'=>$CreatedResponse->memo,
                'memo'=>$CreatedResponse->memo,
                'spend_limit'=>$CreatedResponse->spend_limit,
                'spend_limit_duration'=>$CreatedResponse->spend_limit_duration,
                'card_state'=>$CreatedResponse->state,
                'type'=>$CreatedResponse->type,
               'updated_at'=>date('Y-m-d H:i:s')
                );
                 
           $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->update($updateCard);
           if($cardUpdated)
           {
               $cardDetails = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->first();
               //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$request->user_id,
                         'title'=>'Virtual Card',
                          'link'=>'user/virtualcard',
                         'desription'=>"Your virtual card ending with last four digit XXXX".$cardDetails->last_four_digit." has been closed successfully.",
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION 
               return back()->with('success','Virtual Card updated successfully.');
           } else {
               return back()->with('success','Virtual Card updated successfully.');
           }
        }
        
        curl_close($curl);
   }
   
   public function deleteVirtualCard($id)
   {
       
       $updateStatus = DB::table('virtual_cards')->where('id',$id)->update(['is_deleted'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
       if($updateStatus)
           {
               $cardDetails = DB::table('virtual_cards')->where(['id'=>$id])->first();
               //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$cardDetails->user_id,
                         'title'=>'Virtual Card',
                          'link'=>'user/virtualcard',
                         'desription'=>"Your virtual card ending with last four digit XXXX".$cardDetails->last_four_digit." has been closed successfully.",
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION 
               return back()->with('success','Virtual Card deleted successfully.');
           } else {
               return back()->with('success','Virtual Card deleted successfully.');
           }
   }
   
   public function virtualtransactions($card_token='')
    {  //dd($id);
       $data['title'] = "Card Transaction History";
       $data['card_last_four_by_url'] = $card_token;
        $data['AllTransactionsList'] = app('App\Http\Controllers\VirtualCardController')->getTransactionsList($card_token);
       return view('admin.user.virtualcardsTransactions',$data);
         
    }
    
    public function virtualPhysical()
    {  //dd($id);
       $data['title'] = "All Physical Card Users";
       //$data['card_last_four_by_url'] = $card_token;
        $data['AllphysicalCardList'] = DB::table('virtual_card_physical_address')->get();//app('App\Http\Controllers\VirtualCardController')->getTransactionsList($card_token);
       return view('admin.user.physical_virtualcards',$data);
         
    }
    
    public function editVirtualCard(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'user_id'=>['required'],
            'card_token'=>['required'],
            'pan'=>['required'],
            'exp_month'=>['required'],
            'exp_year'=>['required'],
            'cvv'=>['required']
        ]);
        if ($validator->fails()) {
            return back()->with('alert',$validator->errors());
        }
      
        $lithic_params = [
            "memo"=>$request->memo,
            "spend_limit"=>(int)$request->spend_limit,
            "spend_limit_duration"=>$request->spend_limit_duration,
            "card_token"=>$request->card_token,
            "state"=>'OPEN',
        ];
        
        $api_url = config('app.PRIVACY_API_URL');
        $api_key = config('app.PRIVACY_API_KEY');
        
        //dd($api_url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/card');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
           "Content-Type: application/json",
           "Authorization: api-key ".$api_key
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($lithic_params));
        
        $result = curl_exec($ch);
        $response = json_decode($result, true);
        
        //dd($response);
        
        $updateCard = array(
            'pan'=>$request->pan,
            'exp_month'=>$request->exp_month,
            'exp_year'=>$request->exp_year,
            'cvv'=>$request->cvv,
            'card_state'=>'OPEN',
            'is_paused_by_admin'=>0
        );
                
           $cardUpdated = DB::table('virtual_cards')->where(['user_id'=>$request->user_id,'token'=>$request->card_token])->update($updateCard);
           if($cardUpdated)
           {
               $userDetails = DB::table('users')->where('id',$request->user_id)->first();
               //NOTIFY USER
                $text = "Dear ".$userDetails->business_name.",

                Congratulation! Your Virtual card ending with last four digit XXXX".$request->last_four_digit." has been activated successfully and ready to use anywhere for online payment.
                To check the card details : <a href='".url('user/virtualcard')."' target='_blank'>Get Card Details.</a>";
                send_email($userDetails->email, $userDetails->business_name, 'Virtual Card Activation', $text);
                   //NOTIFICATION
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'card',
                         'sender_id'=>$userDetails->id,
                         'title'=>'Virtual Card',
                          'link'=>'user/virtualcard',
                         'desription'=>"Your virtual card ending with last four digit XXXX".$request->last_four_digit." has been activated successfully.",
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION    
               return back()->with('success','Virtual Card updated successfully.');
           } else {
               return back()->with('alert','Something went wrong!');
           }
        
   }
   
   public function virtualCardSubscriptionList()
    {
       $data['title'] = "Subscription Plans";
        $data['virtualCardsPlan'] = DB::table('virtual_cards_plan')
                                    ->WhereIn('status',array(0,1))
                                    ->orderBy('id','DESC')
                                    ->get();
                                 
        return view('admin.user.vcard_subscription',$data);
         
    }
    
    public function addVirtualCardSubsription(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'plan_name'=>['required'],
                'plan_expedited_fee'=>['required'],
                'plan_quantity'=>['required'],
                'plan_price'=>['required'],
                'plan_features'=>['required'],
               
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
            }
       
        $addPlan = array(
           'plan_name'=>$request->plan_name,
            'plan_quantity'=>$request->plan_quantity,
            'plan_price'=>$request->plan_price,
            'plan_features'=>$request->plan_features,
           'created_at'=>date('Y-m-d H:i:s')
            );
            if(!empty($request->plan_expedited_fee))
            {
                $addPlan['plan_expedited_fee'] = $request->plan_expedited_fee;
            }
                
           $planAdded_id = DB::table('virtual_cards_plan')->insertGetId($addPlan);
           if($planAdded_id)
           {
               $total_amount = $request->plan_expedited_fee+$request->plan_price;
               $PaymentLinkCreate_id = app('App\Http\Controllers\TransferController')->autoCreatePaymentLinkForVcardPlans($request->plan_name,$total_amount);
               if($PaymentLinkCreate_id)
               {
                   $paymentLinkDetails = DB::table('admin_payment_link')->where('id',$PaymentLinkCreate_id)->first();
                   $payment_link = url('vcard-single-charge').'/'.$paymentLinkDetails->ref_id;
                   //dd($payment_link);
                    DB::table('virtual_cards_plan')->where('id',$planAdded_id)->update(['payment_link'=>$payment_link,'payment_link_ref_id'=>$paymentLinkDetails->ref_id]);
                   return back()->with('success','Plan added successfully.');
               } else {
                    return back()->with('success','Plan added successfully but Paymentlink not created.');
               }
           } else {
               return back()->with('alert','Something went wrong!');
           }
        
   }
   
   public function editVirtualCardSubsription(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'plan_name'=>['required'],
                'plan_expedited_fee'=>['required'],
                'plan_quantity'=>['required'],
                'plan_price'=>['required'],
                'plan_features'=>['required'],
                'plan_id'=>['required']
               
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
            }
       
        $addPlan = array(
           'plan_name'=>$request->plan_name,
            'plan_expedited_fee'=>$request->plan_expedited_fee,
            'plan_quantity'=>$request->plan_quantity,
            'plan_price'=>$request->plan_price,
            'plan_features'=>$request->plan_features,
            'status'=>$request->status,
           'updated_at'=>date('Y-m-d H:i:s')
            );
                
           $planAdded = DB::table('virtual_cards_plan')->where('id',$request->plan_id)->update($addPlan);
           if($planAdded)
           {
               return back()->with('success','Plan updated successfully.');
           } else {
               return back()->with('alert','Something went wrong!');
           }
        
   }
   
   public function deleteVirtualCardPlan($id)
   {
       
       $updateStatus = DB::table('virtual_cards_plan')->where('id',$id)->update(['status'=>2,'updated_at'=>date('Y-m-d H:i:s')]);
       if($updateStatus)
           {
               
               return back()->with('success','Plan deleted successfully.');
           } else {
               return back()->with('success','Virtual Card deleted successfully.');
           }
   }
   
   public function cardTypeList()
    {
       $data['title'] = "Card Type List";
        $data['virtualCardsType'] = DB::table('virtual_cards_product_type')
                                    ->WhereIn('status',array(0,1))
                                    ->get();
                                 
        return view('admin.user.vcard_type',$data);
         
    }
    
    public function addVirtualCardType(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'type_name'=>['required'],
                'description'=>['required'],
                
               
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
            }
       
        $addType = array(
           'name'=>$request->type_name,
            'description'=>$request->description,
           'created_at'=>date('Y-m-d H:i:s')
            );
                
           $typeAdded = DB::table('virtual_cards_product_type')->insert($addType);
           if($typeAdded)
           {
               return back()->with('success','Card type added successfully.');
           } else {
               return back()->with('alert','Something went wrong!');
           }
        
   }
   
   public function editVirtualCardType(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'type_name'=>['required'],
                'description'=>['required'],
                'type_id'=>['required']
               
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
            }
       
        $addPlan = array(
           'name'=>$request->type_name,
            'status'=>$request->status,
            'description'=>$request->description,
           'updated_at'=>date('Y-m-d H:i:s')
            );
                
           $planAdded = DB::table('virtual_cards_product_type')->where('id',$request->type_id)->update($addPlan);
           if($planAdded)
           {
               return back()->with('success','Card type updated successfully.');
           } else {
               return back()->with('alert','Something went wrong!');
           }
        
   }
   
   public function deleteVirtualCardType($id)
   {
       
       $updateStatus = DB::table('virtual_cards_product_type')->where('id',$id)->update(['status'=>2,'updated_at'=>date('Y-m-d H:i:s')]);
       if($updateStatus)
           {
               
               return back()->with('success','Card type deleted successfully.');
           } else {
               return back()->with('alert','Something went wrong!.');
           }
   }
   
   public function cardDesignList()
    {
       $data['title'] = "Card Type List";
        $data['virtualCardsDesign'] = DB::table('virtual_cards_design')
                                    ->WhereIn('status',array(0,1))
                                    ->get();
                                 
        return view('admin.user.vcard_design',$data);
         
    }
    
    public function addVirtualCardDesign(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'design_name'=>['required'],
                'description'=>['required'],
                
               
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
            }
       
        $addType = array(
           'design_name'=>$request->design_name,
            'description'=>$request->description,
           'created_at'=>date('Y-m-d H:i:s')
            );
                
           $typeAdded = DB::table('virtual_cards_design')->insert($addType);
           if($typeAdded)
           {
               return back()->with('success','Card design added successfully.');
           } else {
               return back()->with('alert','Something went wrong!');
           }
        
   }
   
   public function editVirtualCardDesign(Request $request)
    {
           $validator=Validator::make($request->all(), [
                'design_name'=>['required'],
                'description'=>['required'],
                'status'=>['required'],
                'design_id'=>['required']
               
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
            }
       
        $addPlan = array(
           'design_name'=>$request->design_name,
            'status'=>$request->status,
            'description'=>$request->description,
           'updated_at'=>date('Y-m-d H:i:s')
            );
                
           $planAdded = DB::table('virtual_cards_design')->where('id',$request->design_id)->update($addPlan);
           if($planAdded)
           {
               return back()->with('success','Card design updated successfully.');
           } else {
               return back()->with('alert','Something went wrong!');
           }
        
   }
   
   public function deleteVirtualCardDesign($id)
   {
       
       $updateStatus = DB::table('virtual_cards_design')->where('id',$id)->update(['status'=>2,'updated_at'=>date('Y-m-d H:i:s')]);
       if($updateStatus)
           {
               
               return back()->with('success','Card design deleted successfully.');
           } else {
               return back()->with('alert','Something went wrong!.');
           }
   }
   
   public function vCardOrders()
    {  
       $data['title'] = "List of Orders";
       
       $data['virtualCardsOrders'] = DB::table('virtual_cards_orders')
                                    //->where('id',$design_id)
                                    ->select('virtual_cards_orders.*','users.first_name','users.last_name','virtual_cards_plan.plan_name','virtual_cards_plan.plan_quantity')
                                    ->join('users','users.id','=','virtual_cards_orders.user_id')
                                     ->leftJoin('virtual_cards_plan','virtual_cards_plan.id','=','virtual_cards_orders.plan_id')
                                    //->where('user_id',Auth::id())
                                    ->WhereIn('virtual_cards_orders.status',array(1))
                                    ->orderBy('virtual_cards_orders.id','DESC')
                                    ->get();
         
       //dd($data['virtualCardsOrders']);
       if(!empty(Auth::id()) && !empty($_GET['n']))
        {
            $notify_id = $_GET['n'];
            $update = DB::table('notification')->where('id',$notify_id)->update(['read_status_for_receiver'=>1]);
        }
        return view('admin.user.vcard_orders',$data);
         
    }
    
    public function sendDocLinkEmail($email)
    {
       
            $user = User::whereEmail($email)->first();
            
            $to =$user->email;
            $name = $user->name;
            $subject = 'Reupload National ID';
            $code = str_random(30);
            $link = url('/user-doc/').'/reupload/'.$code;
           /* $message = "Hey ".$user->first_name.
",<span style='text-align:left;'><br>The photo of your ID didn’t go through last time. Please upload a new one following this guide:

<br>
<b>A. An ideal ID picture<br>
B. All corners of the ID are visible against the backdrop.<br>
C. All ID data is legible.<br>
D. The photo is in color.</b>
</span><br><br>
Upload ID: <br>";
            $message .= "<a href='$link'>".$link."</a>";
            DB::table('custom_doc_link_generate')->insert(
                ['email' => $to, 'token' => $code,  'created_at' => date("Y-m-d h:i:s")]
            );
            send_email($to,  $name, $subject,$message);
            */
            $text = "Hi ".$user->first_name.",<br><br>

Thanks for signing up for ".$this->site_name.". We're processing your application now and noticed your ID upload doesn't quite meet our requirements:<br><br>

<ul><li>Your's document is too tightly cropped for us to accept. Please make sure that both open pages are included, and that all four corners and edges are clearly visible against the backdrop.</li><br>
<li>We need to see both the top and bottom pages of Your's open document. Please upload a new picture where all four corners and edges of both pages are clearly visible against the backdrop.</li><ul>
You can upload a new copy of Your's ID directly to your application here:<br>
".$link."<br><br>

Let us know if you have any questions.<br><br>

Thanks,<br>
The ".$this->site_name." Team<br><br>
<p style='color:gray;font-size:13px;'>Sent with care from<br>

".$this->site_name.", Inc.<br>
The ".$this->site_name." Team<br>
            
            ".$this->site_address."</p>";
        send_email2($user->email,$user->first_name." ".$user->last_name,"Your ".$this->site_name." account needs some attention",$text); 
       
            return back()->with('success', 'Reupload Doc Link Send User E-mail.');
        
    }
    
    public function Verificationkyc($id)
    { 
		$data['title']='KYC Verification';
		$data['send_for_verification'] = DB::table('users')->where('id',$id)->first();
	    $data['companyDetails'] = DB::table('users')->where('id',$id)->first();
        $data['additionalDocs'] = DB::table('business_docs')->where('user_id',$id)->get();
        $data['representativeDirectors'] = DB::table('business_representatives')->where(['user_id'=>$id,'representative_type'=>'Director'])->orderBy('id','DESC')->get();
        $data['shareHolders'] = DB::table('business_representatives')->where(['user_id'=>$id,'representative_type'=>'Share_Holder'])->orderBy('id','DESC')->get();
        $data['beneficiary'] = DB::table('business_representatives')->where(['user_id'=>$id,'representative_type'=>'Beneficiary'])->orderBy('id','DESC')->get();
        $data['project_info'] = DB::table('merchants')->where(['user_id'=>$id])->orderBy('id','DESC')->get();
        if(!empty(Auth::id()) && !empty($_GET['n']))
        {
            $notify_id = $_GET['n'];
            $update = DB::table('notification')->where('id',$notify_id)->update(['read_status_for_receiver'=>1]);
        }
        return view('admin.user.verification', $data);
    }    
    
    public function VerificationkycStaus(Request $request)
    { 
		$validator=Validator::make($request->all(), [
                'user_id'=>['required'],
                'status_type'=>['required'],
                'status'=>['required'],
                
               
            ]);
            if ($validator->fails()) {
                return back()->with('alert',$validator->errors());
            }

          if($request->status_type == 'business_info_status')
          {
                $updateStatus = array(
                    'business_info_status'=>$request->status,
                   'business_info_updated_at'=>date('Y-m-d H:i:s')
                    );
                        
                   $updateResult= DB::table('users')->where('id',$request->user_id)->update($updateStatus);
                   if($updateResult)
                   {
                       $userDetails =  DB::table('users')->where('id',$request->user_id)->first();
                       if($userDetails->business_info_status == 1 && $userDetails->business_docs_status == 1 && $userDetails->additional_docs_status == 1 && $userDetails->representative_director_status == 1 && $userDetails->share_holder_status == 1 && $userDetails->beneficiary_status == 1 && $userDetails->project_status == 1)
                       {
                           $this->Approvekyc($request->user_id);
                       }
                       return back()->with('success','Status updated successfully.');
                   } else {
                       return back()->with('alert','Something went wrong!');
                   }
          } 
          
          if($request->status_type == 'business_docs_status')
          {
                $updateStatus = array(
                    'business_docs_status'=>$request->status,
                   'business_docs_updated_at'=>date('Y-m-d H:i:s')
                    );
                        
                   $updateResult= DB::table('users')->where('id',$request->user_id)->update($updateStatus);
                   if($updateResult)
                   {
                       $userDetails =  DB::table('users')->where('id',$request->user_id)->first();
                       if($userDetails->business_info_status == 1 && $userDetails->business_docs_status == 1 && $userDetails->additional_docs_status == 1 && $userDetails->representative_director_status == 1 && $userDetails->share_holder_status == 1 && $userDetails->beneficiary_status == 1 && $userDetails->project_status == 1)
                       {
                           $this->Approvekyc($request->user_id);
                       }
                       return back()->with('success','Status updated successfully.');
                   } else {
                       return back()->with('alert','Something went wrong!');
                   }
          } 
          
          if($request->status_type == 'additional_docs_status')
          {
                $updateStatus = array(
                    'additional_docs_status'=>$request->status,
                   'additional_docs_updated_at'=>date('Y-m-d H:i:s')
                    );
                        
                   $updateResult= DB::table('users')->where('id',$request->user_id)->update($updateStatus);
                   if($updateResult)
                   {
                       $userDetails =  DB::table('users')->where('id',$request->user_id)->first();
                       if($userDetails->business_info_status == 1 && $userDetails->business_docs_status == 1 && $userDetails->additional_docs_status == 1 && $userDetails->representative_director_status == 1 && $userDetails->share_holder_status == 1 && $userDetails->beneficiary_status == 1 && $userDetails->project_status == 1)
                       {
                           $this->Approvekyc($request->user_id);
                       }
                       return back()->with('success','Status updated successfully.');
                   } else {
                       return back()->with('alert','Something went wrong!');
                   }
          }
          
          if($request->status_type == 'representative_director_status')
          {
                $updateStatus = array(
                    'representative_director_status'=>$request->status,
                   'representative_director_updated_at'=>date('Y-m-d H:i:s')
                    );
                        
                   $updateResult= DB::table('users')->where('id',$request->user_id)->update($updateStatus);
                   if($updateResult)
                   {
                       $userDetails =  DB::table('users')->where('id',$request->user_id)->first();
                       if($userDetails->business_info_status == 1 && $userDetails->business_docs_status == 1 && $userDetails->additional_docs_status == 1 && $userDetails->representative_director_status == 1 && $userDetails->share_holder_status == 1 && $userDetails->beneficiary_status == 1 && $userDetails->project_status == 1)
                       {
                           $this->Approvekyc($request->user_id);
                       }
                       return back()->with('success','Status updated successfully.');
                   } else {
                       return back()->with('alert','Something went wrong!');
                   }
          }
          
          if($request->status_type == 'share_holder_status')
          {
                $updateStatus = array(
                    'share_holder_status'=>$request->status,
                   'share_holder_updated_at'=>date('Y-m-d H:i:s')
                    );
                        
                   $updateResult= DB::table('users')->where('id',$request->user_id)->update($updateStatus);
                   if($updateResult)
                   {
                       $userDetails =  DB::table('users')->where('id',$request->user_id)->first();
                       if($userDetails->business_info_status == 1 && $userDetails->business_docs_status == 1 && $userDetails->additional_docs_status == 1 && $userDetails->representative_director_status == 1 && $userDetails->share_holder_status == 1 && $userDetails->beneficiary_status == 1 && $userDetails->project_status == 1)
                       {
                           $this->Approvekyc($request->user_id);
                       }
                       return back()->with('success','Status updated successfully.');
                   } else {
                       return back()->with('alert','Something went wrong!');
                   }
          }
          
          if($request->status_type == 'beneficiary_status')
          {
                $updateStatus = array(
                    'beneficiary_status'=>$request->status,
                   'beneficiary_updated_at'=>date('Y-m-d H:i:s')
                    );
                        
                   $updateResult= DB::table('users')->where('id',$request->user_id)->update($updateStatus);
                   if($updateResult)
                   {
                       $userDetails =  DB::table('users')->where('id',$request->user_id)->first();
                       if($userDetails->business_info_status == 1 && $userDetails->business_docs_status == 1 && $userDetails->additional_docs_status == 1 && $userDetails->representative_director_status == 1 && $userDetails->share_holder_status == 1 && $userDetails->beneficiary_status == 1 && $userDetails->project_status == 1)
                       {
                           $this->Approvekyc($request->user_id);
                       }
                       return back()->with('success','Status updated successfully.');
                   } else {
                       return back()->with('alert','Something went wrong!');
                   }
          }
          
          if($request->status_type == 'project_status')
          {
                $updateStatus = array(
                    'project_status'=>$request->status,
                   'project_updated_at'=>date('Y-m-d H:i:s')
                    );
                        
                   $updateResult= DB::table('users')->where('id',$request->user_id)->update($updateStatus);
                   if($updateResult)
                   {
                       $userDetails =  DB::table('users')->where('id',$request->user_id)->first();
                       if($userDetails->business_info_status == 1 && $userDetails->business_docs_status == 1 && $userDetails->additional_docs_status == 1 && $userDetails->representative_director_status == 1 && $userDetails->share_holder_status == 1 && $userDetails->beneficiary_status == 1 && $userDetails->project_status == 1)
                       {
                           $this->Approvekyc($request->user_id);
                       }
                       return back()->with('success','Status updated successfully.');
                   } else {
                       return back()->with('alert','Something went wrong!');
                   }
          }
    }
    
    public function seoindex()
    { 
        $data['title']='Seo';
        $data['seo_details'] = SeoDetail::orderby('id', 'DESC')->get();
        
        return view('admin.seo.index', $data);  
    }
   
    public function seocreate(Request $request)
    { 
        $data['title']='Seo';
        $data['seo_details'] = SeoDetail::Create([
            'page' => $request->page, 
            'title' => $request->title, 
            'key_words' => $request->key_words, 
            'content' => $request->content, 
            'status' => $request->status,
        ]);
         
        return back()->with('success', 'SEO created successfully');
    }
    
    public function seoUpdate(Request $request, $seoId)
    { 
        $data['title']='Seo';
        
        $rs = [
            'page' => $request->page, 
            'title' => $request->title, 
            'key_words' => $request->key_words, 
            'content' => $request->content, 
            'status' => $request->status,
        ];
       
        $data['seo_details'] = SeoDetail::where(['id'=> $seoId])->update($rs);
         
        return back()->with('success', 'SEO Updated successfully');
    }
    
    public function Destroyseo($id)
    {
        $check = SeoDetail::whereId($id)->delete();
        return back()->with('success', 'Seo was successfully deleted');
    }
   
   public function sendPushNotification()
   {  //$message, $id
        $url = 'https://fcm.googleapis.com/fcm/send';
    
        $fields = array (
                'registration_ids' => array (
                        'fDEV50Ms1QY:APA91bH2m5HODtdKSjRC5UpEHIwwvd-HgvNcigu1Su12-_NuCW8ToSeVuqhiYTxiOYT_vvp0T8I4H89I7q99xGQ7a64KR_6XdBlERrK8fq8Ij6oqgBymttWUCXbO8LjYUYh4y8hWxEm5'
                ),
                'data' => array (
                        "message" => 'Testing'
                )
        );
        $fields = json_encode ( $fields );
    
        $headers = array (
                'Authorization: key=' . "AAAATuPpY6I:APA91bG_FjjHPFzJUhsBapsSGPPvqW60rJIM-LyQ6g4Co3vnbgZkYMw8KfP1BoF1GLNOUrcws-SV_FWrLgjnTyUC9arPr2Jc_bE745hwidaHAK5n8Cp1xR81xDxd-47AtEFNUHTyVKyT",
                'Content-Type: application/json'
        );
    
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
    
        $result = curl_exec ( $ch );
        dd($result);
        curl_close ( $ch );

   }
   
   public function Updatelimit(Request $request, $id){
       $users = User::where('id', $id)->first();
       $lithic_params = [
            'account_token' => $users->account_token,
            'daily_spend_limit' => (int)$request->daily_limit,
            'monthly_spend_limit' => (int)$request->monthly_limit,
            'lifetime_spend_limit' => (int)$request->lifetime_limit,
        ];
        
        //dd(json_encode($lithic_params));
        
        $api_url = config('app.PRIVACY_API_URL');
        $api_key = config('app.PRIVACY_API_KEY');
        
        //dd($api_key);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/account/limit');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
           "Content-Type: application/json",
           "Authorization: api-key ".$api_key
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($lithic_params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $response = json_decode($result, true);
        //dd($response['data'][0]['state']);
        if($response['data'][0]['state'] == 'ACTIVE'){
            $user=User::whereId($id)->first();
               
            $user->daily_limit=$request->daily_limit;
            $user->monthly_limit=$request->monthly_limit;
            $user->lifetime_limit=$request->lifetime_limit;
            $user->save();
            
            return back()->with('success', 'Limits updated successfully.');
        }elseif($response['data'][0]['state'] == 'PAUSED'){
            return back()->with('alert', 'Account is deactivated!');
        }else{
            return back()->with('alert', 'Something went wrong!');
        }
    }
   
    public function Activatelithics($id){
        $users = User::where('id', $id)->first();
        $lithic_params = [
            'account_token' => $users->account_token,
            'state' => 'ACTIVE',
        ];
        
        //dd(json_encode($lithic_params));
        
        $api_url = config('app.PRIVACY_API_URL');
        $api_key = config('app.PRIVACY_API_KEY');
        
        //dd($api_key);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/account/state');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
           "Content-Type: application/json",
           "Authorization: api-key ".$api_key
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($lithic_params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $response = json_decode($result, true);
        //dd($response);
        if($response['data'][0]['state'] == 'ACTIVE'){
            $user=User::whereId($id)->first();
               
            $user->lithic_status=$response['data'][0]['state'];
            $user->save();
            
            return back()->with('success', 'Lithics account activated successfully.');
        }else{
            return back()->with('alert', 'Something went wrong!');
        }
    }
    
    public function Deactivatelithics($id){
        $users = User::where('id', $id)->first();
        $lithic_params = [
            'account_token' => $users->account_token,
            'state' => 'PAUSED',
        ];
        
        //dd(json_encode($lithic_params));
        
        $api_url = config('app.PRIVACY_API_URL');
        $api_key = config('app.PRIVACY_API_KEY');
        
        //dd($api_key);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/account/state');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
           "Content-Type: application/json",
           "Authorization: api-key ".$api_key
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($lithic_params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $response = json_decode($result, true);
        //dd($response);
        if($response['data'][0]['state'] == 'PAUSED'){
            $user=User::whereId($id)->first();
               
            $user->lithic_status=$response['data'][0]['state'];
            $user->save();
            
            return back()->with('success', 'Lithics account deactivated successfully.');
        }else{
            return back()->with('alert', 'Something went wrong!');
        }
    }
}
