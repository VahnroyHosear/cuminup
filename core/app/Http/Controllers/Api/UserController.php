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

class UserController extends Controller
{

        
    public function __construct()
    {		
        
    }
    //Dashboard
        public function dashboard()
        {
            $data['title']='Dashboard';
            return view('user.dashboard.index', $data);
        }
    //End of Dashboard

    //Delete account
        public function delaccount(Request $request)
        {
            $id = Auth::guard('user')->user()->id;
            $user = User::whereId($id)->delete();
            $transfer = Transfer::where('Receiver_id', $id)->orWhere('Temp', Auth::guard('user')->user()->email)->delete();
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
            $audit['user_id']=Auth::guard('user')->user()->id;
            $audit['trx']=str_random(16);
            $audit['log']='Logged out - '.user_ip();
            Audit::create($audit);
            Auth::guard('user')->logout();
            session()->flash('message', 'Just Logged Out!');
            return redirect()->route('login')->with('success', 'Account was successfully deleted');
        } 
        
    //End of Delete account

    //Audit log
        public function audit()
        {
            $data['title']='Audit Logs';
            $data['audit']=Audit::whereUser_id(Auth::guard('user')->user()->id)->orderBy('created_at', 'DESC')->get();
            return view('user.profile.audit', $data);
        }
    //End of Audit Log

    //Support ticket
        public function ticket()
        {
            $data['title']='Tickets';
            $data['ticket']=Ticket::whereUser_id(Auth::guard('user')->user()->id)->latest()->paginate(4);
            return view('user.support.index', $data);
        }        
        public function openticket()
        {
            $data['title']='New Ticket';
            return view('user.support.new', $data);
        } 
        public function Replyticket($id)
        {
            $data['ticket']=$ticket=Ticket::whereid($id)->first();
            $data['title']='#'.$ticket->ticket_id;
            $data['reply']=Reply::whereTicket_id($ticket->ticket_id)->get();
            return view('user.support.reply', $data);
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
        
        public function submitticket(Request $request)
        {  
            $validator=Validator::make($request->all(), [
                        'user_id' => 'required',
                        'subject' => 'required',
                        'priority' => 'required',
                        'type' => 'required',
                        'message' => 'required',
                        'image' => 'required'
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
               
                if(!empty($request->image))
                {
                     $location = 'asset/profile/';
                     $uploadResponse = $this->createImageFromBase64($request->image,$location);
                    if ($uploadResponse) {
                        $data[] = $uploadResponse;  
                        $sav['files'] = json_encode($data);
                        
                    }else{
                        return response()->json(['status'=>'0','response'=>'An error occured, try again.'], 400);
                    }
                }
                
                $set=Settings::first();
                $user=$data['user']=User::find($request->user_id);
                $sav['user_id']=$request->user_id;
                $sav['subject']=$request->subject;
                $sav['priority']=$request->priority;
                $sav['type']=$request->type;
                $sav['message']=$request->message;
                $sav['ref_no']=$request->ref_no;
                $sav['ticket_id']=$token=rand(1000,9999);
                $sav['status']=0;
                Ticket::create($sav);
                if($set['email_notify']==1){
                    send_email($user->email, $user->username, 'New Ticket - '.$request->subject, "Thank you for contacting us, we will get back to you shortly, your Ticket ID is ".$token);
                    send_email($set->support_email, $set->site_name, 'New Ticket:'. $token, "New ticket request");
                }
                //$img_url = url('asset/profile/');
                return response()->json(['status'=>'1','response'=>'Ticket Submitted Successfully.'], 200);
                //return redirect()->route('user.ticket')->with('success', 'Ticket Submitted Successfully.');
                
            } else {
                  return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
              } 
        }     
        public function submitreply(Request $request)
        {
            $validator=Validator::make($request->all(), [
                        'user_id' => 'required',
                        'ticket_id' => 'required',
                        'reply_msg' => 'required',
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
                $data=Ticket::whereTicket_id($request->ticket_id)->first();
                if(!empty($data))
                {
                $set=Settings::first();
                $sav['reply']=$request->reply_msg;
                $sav['ticket_id']=$request->ticket_id;
                $sav['status']=1;
                Reply::create($sav);
                if($set['email_notify']==1){
                    send_email($set->email, $set->site_name, 'Ticket Reply:'. $request->ticket_id, "New ticket reply request");
                }
                $data=Ticket::whereTicket_id($request->ticket_id)->first();
                $data->status=0;
                //$data->staff_id=1;
                $data->save();
                
                return response()->json(['status'=>'1','response'=>'Reply Submitted Successfully.'], 200); 
               // return back()->with('success', 'Message sent!.');
                } else {
                    return response()->json(['status'=>'0','response'=>'Ticket id not found!'], 400); 
                }
            
            } else {
                  return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
              } 
        }
        
        public function ticketListing(Request $request)
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
                $data=Ticket::whereUser_id($request->user_id)->orderBy('id','desc')->get();
                if(!empty($data))
                {
                return response()->json(['status'=>'1','response'=>'Data Fetched Successfully.','data'=>$data], 200); 
               // return back()->with('success', 'Message sent!.');
                } else {
                    return response()->json(['status'=>'0','response'=>'Ticket not found!'], 400); 
                }
            
            } else {
                  return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
              } 
        }  
        
        public function ticketReplyListing(Request $request)
        {
            $validator=Validator::make($request->all(), [
                        'user_id' => 'required',
                        'ticket_id'=> 'required'
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
                $data=Reply::whereTicket_id($request->ticket_id)->orderBy('id','desc')->get();//Ticket::whereUser_id($request->user_id)->orderBy('id','desc')->get();
                if(!empty($data))
                {
                return response()->json(['status'=>'1','response'=>'Data Fetched Successfully.','reply_user_check'=>'if 1 then user and 0 for admin','data'=>$data], 200); 
               // return back()->with('success', 'Message sent!.');
                } else {
                    return response()->json(['status'=>'0','response'=>'Ticket not found!'], 400); 
                }
            
            } else {
                  return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
              } 
        }   
    //End Support ticket

    //Store
        public function product()
        {
            
            if(Session::get('id'))
            {
                $data['productdetails']=$product=Product::find(Session::get('id'));
                $data['images']=Productimage::whereproduct_id(Session::get('id'))->get();
            };
            
            $data['title']='Products';
            $data['product']=Product::whereUser_id(Auth::guard('user')->user()->id)->orderby('id', 'desc')->paginate(4);
            $data['received']=Order::whereStatus(1)->whereseller_id(Auth::guard('user')->user()->id)->sum('total');
            $data['total']=Order::whereseller_id(Auth::guard('user')->user()->id)->sum('total');      
            
            
            
            return view('user.product.index', $data);
        } 
        public function Destroyproduct($id)
        {
            $data = Product::findOrFail($id);
            $image = Productimage::whereproduct_id($id)->get();
            $order = Order::whereproduct_id($id)->get();
            if(count($image)>0){
                foreach($image as $val){
                    $val->delete();
                }
            }            
            if(count($order)>0){
                foreach($order as $val){
                    $val->delete();
                }
            }
            $data->delete();
            return back();
        }
        public function submitproduct(Request $request)
        {
            
          
            $user=$data['user']=User::find(Auth::guard('user')->user()->id);
            $sav['user_id']=Auth::guard('user')->user()->id;
            $sav['ref_id']=$trx=str_random(10);
            $sav['name']=$request->name;
            $sav['quantity']=$request->quantity;
            $sav['amount']=$request->amount;
            $sav['new']=0;
            $details = Product::create($sav);
            
            if ($request->hasFile('file')) {
             
                $image = $request->file('file');
                $filename = time().'.'.$image->extension();
                $location = 'asset/profile/' . $filename;
                Image::make($image)->save($location);
                $save['image']=$filename;
                $save['product_id']=$details->id;
                Productimage::create($save);
                $ext=Product::whereid($details->id)->first();
                $ext->new=1;
                $ext->save();
                
            }
            
            return redirect()->route('user.product')->with( [ 'id' => $details->id ] )->with('error_code', 6);
            
            // return redirect('user/edit-product/'.$details->id);
        }
        public function Editproduct($id)
        {
            $data['product']=$product=Product::find($id);
            $data['images']=Productimage::whereproduct_id($id)->get();
            $data['title']=$product->name;
            return view('user.product.edit', $data);
        }         
        
        public function Orders($id)
        {
            $data['product']=$product=Product::find($id);
            $data['orders']=Order::whereproduct_id($id)->latest()->get();
            $data['title']=$product->name;
            return view('user.product.orders', $data);
        }         
        
        public function list()
        {
            $data['orders']=Order::whereuser_id(Auth::guard('user')->user()->id)->latest()->get();
            $data['title']='Product Orders';
            return view('user.product.list', $data);
        } 
        public function Descriptionupdate(Request $request)
        {
            $data=Product::whereId($request->id)->first();
            $in = Input::except('_token');
            $data->fill($in)->save();
            return back()->with('success', 'Successfully updated');
        }        
        public function Featureupdate(Request $request)
        {
            $data=Product::whereId($request->id)->first();
            $in = Input::except('_token');
            $data->fill($in)->save();
            if(empty($request->status)){
                $data->status=0;	
            }else{
                $data->status=$request->status;
            }               
            if(empty($request->shipping_status)){
                $data->shipping_status=0;	
            }else{
                $data->shipping_status=$request->shipping_status;
            } 
            $data->length=$request->length;
            $data->width=$request->width;
            $data->height=$request->height;
            $data->weight=$request->weight;
            $data->save();
            return back()->with('success', 'Successfully updated');
        }
        public function submitproductimage(Request $request)
        {
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $filename = time().'.'.$image->extension();
                $location = 'asset/profile/' . $filename;
                Image::make($image)->save($location);
                $sav['image']=$filename;
                $sav['product_id']=$request->id;
                Productimage::create($sav);
                $ext=Product::whereid($request->id)->first();
                $ext->new=1;
                $ext->save();
                return back()->with('success', 'Successfully uploaded');
            }else{
                return back()->with('alert', 'An error occured, please try again later');
            }
        }
        public function deleteproductimage($id)
        {
            $data = Productimage::findOrFail($id);
            $path = './asset/profile/';
            File::delete($path.$data->image);
            $res =  $data->delete();
            $ext=Productimage::whereproduct_id($data->product_id)->get();
            if(count($ext)<1){
                $dext=Product::whereid($data->product_id)->first();
                $dext->new=0;
                $dext->save();
            }
            if ($res) {
                return back()->with('success', 'Image Deleted Successfully!');
            } else {
                return back()->with('alert', 'Problem With Deleting Image');
            }
        }
        public function buyproduct(Request $request, $id)
        {
            $check=Product::whereref_id($id)->get();
            if(count($check)>0){
                $product = $data['product']=Product::whereref_id($id)->first();
                if($product->user->status==0){
                    if($product->active==1){
                        $data['merchant']=$merchant=User::whereid($product->user_id)->first();
                        $data['image']=Productimage::whereproduct_id($product->id)->get();
                        $data['first']=Productimage::whereproduct_id($product->id)->first();
                        $data['title'] = $product->name;
                       
                        $data['logo_product_img'] = '/profile/'.Productimage::whereproduct_id($product->id)->first()['image'];//https://cuminup.com/asset/profile/1617100923.jpg
                        $data['product_desc'] = $product->description;
                        //dd($data['logo_product_img']);
                        // $data['ref'] = str_random(16);
                        
                        $data['ref'] = 'OD'.date('m').rand(11111,99999);
                        
                        $data['subtotal']=$subtotal= $product->amount*1;
                        $data['total']= $subtotal+$product->shipping_fee;
                        $data['ship_fee']= $product->shipping_fee;
                        
                        //dd($product->user_id);
                        
                         if ($request->input('city')) {
                        
                            $users = DB::table('users')->where('id', $product->user_id)->orderBy('id', 'desc')->get();
                            $enuser = json_decode(json_encode($users),true);
                            //dd($enuser[0]['first_name']);
                            
                            require_once("/home/cards/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
                            $privateKey = env('EASYPOST_API_KEY');
                            \EasyPost\EasyPost::setApiKey($privateKey);
                            $fromAddress = \EasyPost\Address::create(array(
                              'verify'  => array("delivery"),
                              'company' => $enuser[0]['business_name'],
                              'street1' => $enuser[0]['address1'] . ' '. $enuser[0]['address2'],
                              'street2' => $enuser[0]['address2'],
                              'city' => $enuser[0]['city'],
                              'state' => $enuser[0]['state'],
                              'zip' => $enuser[0]['zip_code'],
                              'phone' => $enuser[0]['phone'],
                            ));
                            
                            //dd($fromAddress);
                            
                            if($fromAddress->verifications['delivery']['success'] == true)
                            {
                                $success = [
                                    'status' => $fromAddress->verifications['delivery']['success'],
                                    'latitude' => $fromAddress->verifications['delivery']['details']['latitude'],
                                    'longitude' => $fromAddress->verifications['delivery']['details']['longitude'],
                                    'time_zone' => $fromAddress->verifications['delivery']['details']['time_zone'],
                                ];
                            }else{
                                $success = [
                                    'status' => $fromAddress->verifications['delivery']['success'],
                                    'code' => $fromAddress->verifications['delivery']['errors'][0]['code'],
                                    'field' => $fromAddress->verifications['delivery']['errors'][0]['field'],
                                    'message' => $fromAddress->verifications['delivery']['errors'][0]['message'],
                                    'suggestion' => $fromAddress->verifications['delivery']['errors'][0]['suggestion']
                                ];
                            } 
                            
                            require_once("/home/cards/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
                            $privateKey = env('EASYPOST_API_KEY');
                            \EasyPost\EasyPost::setApiKey($privateKey);
                            
                            $toAddress = \EasyPost\Address::create(array(
                              'verify'  => array("delivery"),
                              'name' => $request->input('name'),
                              'company' => $request->input('company'),
                              'street1' => $request->input('address1'). ' ' .$request->input('address2'),
                              'street2' => $request->input('address2'),
                              'city' => $request->input('city'),
                              'state' => $request->input('state'),
                              'zip' => $request->input('zip_code'),
                              'phone' => $request->input('phone'),
                            ));
                            
                            //dd($toAddress);
                            
                            if($toAddress->verifications['delivery']['success'] == true)
                            {
                                $success = [
                                    'status' => $toAddress->verifications['delivery']['success'],
                                    'latitude' => $toAddress->verifications['delivery']['details']['latitude'],
                                    'longitude' => $toAddress->verifications['delivery']['details']['longitude'],
                                    'time_zone' => $toAddress->verifications['delivery']['details']['time_zone'],
                                ];
                            }else{
                                $success = [
                                    'status' => $toAddress->verifications['delivery']['success'],
                                    'code' => $toAddress->verifications['delivery']['errors'][0]['code'],
                                    'field' => $toAddress->verifications['delivery']['errors'][0]['field'],
                                    'message' => $toAddress->verifications['delivery']['errors'][0]['message'],
                                    'suggestion' => $toAddress->verifications['delivery']['errors'][0]['suggestion']
                                ];
                            } 
                            
                            //dd($toAddress->id);
                            
                            //$toaddress = DB::table('customers')->where('product_id', $product->id)->orderBy('id', 'desc')->first();
                            //dd($toaddress->shipment_id);
                            
                            //dd($product);
                            
                            require_once("/home/cards/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
                            $privateKey = env('EASYPOST_API_KEY');
                            \EasyPost\EasyPost::setApiKey($privateKey);
                            $parcel = \EasyPost\Parcel::create(array(
                              "length" => $product->length,
                              "width" => $product->width,
                              "height" => $product->height,
                              "weight" => $product->weight,
                            ));
                            
                            //dd($parcel->id);
                            
                            require_once("/home/cards/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
                            $privateKey = env('EASYPOST_API_KEY');
                            \EasyPost\EasyPost::setApiKey($privateKey);
                            $from_add_id = $fromAddress->id;
                            $to_add_id = $toAddress->id;
                            $parcel_id = $parcel->id;
                            
                            $fromAddress = \EasyPost\Address::retrieve($from_add_id);
                            $toAddress = \EasyPost\Address::retrieve($to_add_id);
                            $parcel = \EasyPost\Parcel::retrieve($parcel_id);
                            
                            $shipment = \EasyPost\Shipment::create(array(
                              "to_address" => $toAddress,
                              "from_address" => $fromAddress,
                              "parcel" => $parcel
                            ));
                        
                            //dd($shipment->id);
                            
                            $new_to = $shipment->id;
                            
                            //dd($new_to);
                            
                            if($toAddress->verifications['delivery']['success'] == true){
                                return redirect()->back()->with(['data' => $data,'new_to' => $new_to]);
                            }else{
                                return redirect()->back()->with(['data' => $data,'message' => 'Address not Found']);
                            }
                        }
                      
                        return view('user.product.buy', $data);
                    }else{
                        $data['title']='Error Occured';
                        return view('user.merchant.error', $data)->withErrors('Product has been suspended');
                    }
                }else{
                    $data['title']='Error Message';
                    return view('user.merchant.error', $data)->withErrors('An Error Occured');
                }
            }else{
                $data['title']='Error Message';
                return view('user.merchant.error', $data)->withErrors('Invalid product link');
            }
        }  
        
        public function custadd(Request $request)
        {
            if ($request->input('email')) {
                
                require_once("/home/cards/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
                $privateKey = env('EASYPOST_API_KEY');
                \EasyPost\EasyPost::setApiKey($privateKey);
                
                $toAddress = \EasyPost\Address::create(array(
                  'verify'  => array("delivery"),
                  'name' => $request->input('name'),
                  'company' => $request->input('company'),
                  'street1' => $request->input('address1'),
                  'street2' => $request->input('address2'),
                  'city' => $request->input('city'),
                  'state' => $request->input('state'),
                  'zip' => $request->input('zip_code'),
                  'phone' => $request->input('phone'),
                ));
                
                //dd($toAddress->id);
                
                if($toAddress->verifications['delivery']['success'] == true)
                {
                    $success = [
                        'status' => $toAddress->verifications['delivery']['success'],
                        'latitude' => $toAddress->verifications['delivery']['details']['latitude'],
                        'longitude' => $toAddress->verifications['delivery']['details']['longitude'],
                        'time_zone' => $toAddress->verifications['delivery']['details']['time_zone'],
                    ];
                }else{
                    $success = [
                        'status' => $toAddress->verifications['delivery']['success'],
                        'code' => $toAddress->verifications['delivery']['errors'][0]['code'],
                        'field' => $toAddress->verifications['delivery']['errors'][0]['field'],
                        'message' => $toAddress->verifications['delivery']['errors'][0]['message'],
                        'suggestion' => $toAddress->verifications['delivery']['errors'][0]['suggestion']
                    ];
                }
                        
                $rs = Customer::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'address1' => $request->input('address1'),
                    'address2' => $request->input('address2'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'country' => $request->input('country'),
                    'zip_code' => $request->input('zip_code'),
                    'product_id' => $request->input('product_id'),
                    'shipment_id' => $toAddress->id,
                ]); 
                //dd($rs);
                return back()->with('success', 'Address updated Successfully');
            }else{
                return back()->with('alert', 'An error occured, please try again later');
            }
        }

        public function acquireproduct(Request $request)
        {
            $total= ($request->quantity*$request->amount)+$request->shipping_fee;
            $currency=Currency::whereStatus(1)->first();
            $set=Settings::first();
            $merchant=Product::whereid($request->product_id)->first();
            $up_mer=User::whereid($merchant->user_id)->first();

            if($request->type=='card'){
                $gate = Gateway::find(103);
                $this->validate($request,
                [
                    'cardNumber' => 'required',
                    'cardM' => 'required',
                    'cardY' => 'required',
                    'cardCVC' => 'required',
                ]);
                $cc = $request->cardNumber;
                $cvc = $request->cardCVC;
                $m = $request->cardM;
                $y = $request->cardY;
                $cnts = $request->amount;

                Stripe::setApiKey($gate->val2);
                try {
                    $token = Token::create(array(
                        "card" => array(
                            "number" => "$cc",
                            "exp_month" => $m,
                            "exp_year" => $y,
                            "cvc" => "$cvc"
                        )
                    ));   
                    try {
                        $charge = Charge::create(array(
                            'card' => $token['id'],
                            'currency' => $currency->name,
                            'amount' => $cnts*100,
                            'description' => $set->site_name.' product buy',
                        ));
        
                        if ($charge['status'] == 'succeeded') {
                            $up_mer->balance=$total+$up_mer->balance-($total*$set->product_charge/100);
                            $up_mer->save();
                            $sav['quantity']=$request->quantity;
                            $sav['seller_id']=$merchant->user_id;
                            $sav['first_name']=$request->first_name;
                            $sav['last_name']=$request->last_name;
                            $sav['email']=$request->email;
                            $sav['phone']=$request->phone;
                            $sav['address']=$request->address;
                            $sav['country']=$request->country;
                            $sav['state']=$request->state;
                            $sav['town']=$request->town;
                            $sav['zip_code']=$request->zip_code;
                            $sav['note']=$request->note;
                            $sav['amount']=$request->amount;
                            $sav['charge']=$charge=($total*$set->product_charge/100);
                            $sav['total']=($request->amount*$request->quantity+$request->shipping_fee)-$charge;
                            $sav['ref_id']=$token=$request->ref_id;
                            $sav['product_id']=$request->product_id;
                            $sav['amount']=$request->amount;
                            $sav['shipping_fee']=$request->shipping_fee;
                            $sav['status']=1;
                            $sav['buy_shipment']=$request->buy_shipment;
                            //dd($sav);
                            Order::create($sav);
                            $product=Product::whereid($request->product_id)->first();
                            if($product->quantity_status==0){
                                $product->quantity=$product->quantity-$request->quantity;
                                $product->save();
                            }
                            //Charges
                            $chargex['user_id']=$up_mer->id;
                            $chargex['ref_id']=str_random(16);
                            $chargex['amount']=$total*$set->product_charge/100;
                            $chargex['log']='Received payment for order #' .$token;
                            Charges::create($chargex);
                            //Audit
                            $audit['user_id']=$up_mer->id;
                            $audit['trx']=str_random(16);
                            $audit['log']='Received payment for order #' .$token;
                            Audit::create($audit);
                            //Notify users
                            if($set->email_notify==1){
                                send_productlinkreceipt($merchant->ref_id, 'card', $token);
                                
                                //dd(send_productlinkreceipt($merchant->ref_id, 'card', $token));
                            } 
                            $email1 =   send_productlinkreceipt($merchant->ref_id, 'card', $token);
                            $d = json_decode(json_encode($email1),'true');
                            //Redirect payment
                            
                             // 3-11-2020
                            if($request->prefix)
                            {
                                $getdtls = DB::table('countries')->where('id',$request->prefix)->first();
                            }
                            $prefix = $getdtls->calling_code;
                            $phone_iso = $getdtls->iso_code;
                            $sendphone = '+'.$prefix.$request->phone;
                            $msg = 'GetVirtualCard%20Your%20Order%20'.$token.'%20is%20placed%20successfully%20';
                          $chk = sendsms($sendphone,$msg);
                            // 3-11-2020
                            
                            //$pdf = PDF::loadView('emails.product.test',compact('d'));
                            //return $pdf->download('invoice.pdf');
                    
                    
                    
                    
                            return back()->with('success', 'Your order '.$token.' has been placed successfully. An Email has sent to '.$request->email.'.');
                        }
                    } catch (\Stripe\Exception\CardException $e) {
                        return back()->with('alert', $e->getMessage());
                    }
        
                } catch (\Stripe\Exception\CardException $e) {
                    return back()->with('alert', $e->getMessage());
                }
            }elseif($request->type=='account'){
                $debit=User::whereId(Auth::guard('user')->user()->id)->first();
                if($total<$debit->balance || $total==$debit->balance){
                    $up_mer->balance=$total+$up_mer->balance-($total*$set->product_charge/100);
                    $up_mer->save();
                    $debit->balance=$debit->balance-($total);
                    $debit->save();
                    $sav['quantity']=$request->quantity;
                    $sav['user_id']=Auth::guard('user')->user()->id;
                    $sav['seller_id']=$merchant->user_id;
                    $sav['first_name']=$request->first_name;
                    $sav['last_name']=$request->last_name;
                    $sav['email']=$request->email;
                    $sav['phone']=$request->phone;
                    $sav['address']=$request->address;
                    $sav['country']=$request->country;
                    $sav['state']=$request->state;
                    $sav['town']=$request->town;
                    $sav['note']=$request->note;
                    $sav['amount']=$request->amount;
                    $sav['charge']=$charge=($total*$set->product_charge/100);
                    $sav['total']=($request->amount*$request->quantity+$request->shipping_fee)-$charge;
                    $sav['ref_id']=$token=$request->ref_id;
                    $sav['product_id']=$request->product_id;
                    $sav['amount']=$request->amount;
                    $sav['shipping_fee']=$request->shipping_fee;
                    $sav['status']=1;
                    Order::create($sav);
                    $product=Product::whereid($request->product_id)->first();
                    if($product->quantity_status==0){
                        $product->quantity=$product->quantity-$request->quantity;
                        $product->save();
                    }
                    //Charges
                    $chargex['user_id']=$up_mer->id;
                    $chargex['ref_id']=str_random(16);
                    $chargex['amount']=$total*$set->product_charge/100;
                    $chargex['log']='Received payment for order #' .$token;
                    Charges::create($chargex);
                    //Audit
                    $audit['user_id']=$up_mer->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Received payment for order #' .$token;
                    Audit::create($audit);
                    if($set->email_notify==1){
                        //send_email($merchant->email, $set->site_name, 'Order Notification', 'Hey you just received'.$currency->symbol.numberformat($ext->total).' from '.$debit->business_name.' via order no #'.$request->ref_id);
                    }
                    
                    // 3-11-2020
                    if($request->prefix)
                    {
                        $getdtls = DB::table('countries')->where('id',$request->prefix)->first();
                    }
                    $prefix = $getdtls->calling_code;
                    $phone_iso = $getdtls->iso_code;
                    $sendphone = '+'.$prefix.$request->phone;
                    $msg = '=GetVirtualCard%20Your%20Order%20'.$token.'%20is%20placed%20successfully%20';
                  $chk = sendsms($sendphone,$msg);
                // 3-11-2020
                    
                    
                    return redirect()->route('user.list')->with('success', 'Product was successfully paid for');
                }else{
                    return back()->with('alert', 'Account balance is insufficient');
                } 
            }

            return redirect()->route('user.product');
        }
    //End of Store


      public function virtualcard()
        {
           $data['title'] = "Virtual Card";
            $data['virtualCardsList'] = DB::table('virtual_cards')->where('user_id',Auth::id())->get();
            return view('user.virtualcard.index',$data);
             
        } 
        
         public function newdashboard()
        {
           $data['title'] = "Dashboard";
           $data['virtualCardsList'] = DB::table('virtual_cards')
                                    ->select('virtual_cards.*','virtual_cards_funding_accounts.account_name as FundingAccount','virtual_cards_funding_accounts.last_four as FundingLastFour')
                                    ->join('virtual_cards_funding_accounts','virtual_cards_funding_accounts.id','=','virtual_cards.funding_account_id')
                                    ->where('virtual_cards.user_id',Auth::id())
                                     ->where('virtual_cards.card_state','OPEN')
                                    ->get();
         
         
       $data['AllvCardDesigns'] = DB::table('virtual_cards_design')->where('status',1)->get();                        
            return view('user.newdashboard.index',$data);
             
        } 

    //Invoice
        public function invoice()
        {
            $data['title']='Invoices';
            $data['invoice']=Invoice::whereUser_id(Auth::guard('user')->user()->id)->latest()->paginate(4);
            $data['paid']=Invoice::whereEmail(Auth::guard('user')->user()->email)->latest()->get();
            $data['received']=Invoice::whereStatus(1)->whereuser_id(Auth::guard('user')->user()->id)->sum('total');
            $data['pending']=Invoice::whereStatus(0)->whereuser_id(Auth::guard('user')->user()->id)->sum('total');
            $data['total']=Invoice::whereuser_id(Auth::guard('user')->user()->id)->sum('total');
            return view('user.invoice.index', $data);
        }          
        public function previewinvoice($id)
        {
            $data['title']='Invoices';
            $data['invoice']=$invoice=Invoice::whereref_id($id)->first();
            $data['merchant']=$merchant=User::whereid($invoice->user_id)->first();
            return view('user.invoice.preview', $data);
        }   
        public function addinvoice()
        {
            $data['title']='Add invoice';
            return view('user.invoice.create', $data);
        } 
        public function submitinvoice(Request $request)
        {
            $user=$data['user']=User::find(Auth::guard('user')->user()->id);
            $token=str_random(16);
            $discount=$request->amount*$request->quantity*$request->discount/100;
            $tax=($request->amount*$request->quantity*$request->tax/100)+($request->amount*$request->quantity);
            $sav['user_id']=Auth::guard('user')->user()->id;
            $sav['ref_id']=$token;
            $sav['email']=$request->email;
            $sav['invoice_no']=$request->invoice_no;
            $sav['due_date']=$request->due_date;
            $sav['tax']=$request->tax;
            $sav['discount']=$request->discount;
            $sav['quantity']=$request->quantity;
            $sav['item']=$request->item_name;
            $sav['notes']=$request->notes;
            $sav['amount']=$request->amount;
            $sav['total']=$tax-$discount;
            Invoice::create($sav);
            return redirect()->route('preview.invoice', ['id' => $token]);
        }        
        public function submitpreview(Request $request)
        {
            $data=Invoice::whereId($request->id)->first();
            $set=Settings::first();
            if($set->email_notify==1){
                $data->sent_date = Carbon::now();
                $data->save();
                send_invoice($data->ref_id);
            }
            return redirect()->route('user.invoice')->with('success', 'Invoice was successfully sent');
        }        
        public function Reminderinvoice($id)
        {
            $data=Invoice::whereId($id)->first();
            $set=Settings::first();
            if($set->email_notify==1){
                send_invoice($data->ref_id);
                return redirect()->route('user.invoice')->with('success', 'Invoice was successfully sent');
            }else{
                return redirect()->route('user.invoice')->with('alert', 'An error occured, Try again later');
            }
        }         
        public function Paidinvoice($id)
        {
            $set=Settings::first();
            $data=Invoice::whereId($id)->first();
            $up_mer=User::whereId($data->user_id)->first();
            $charge=$data->total*$set->invoice_charge/100;
            if($up_mer->balance>$charge || $up_mer->balance==$charge){
                $up_mer->balance=($data->total+($data->total*$set->invoice_charge/100))+$up_mer->balance;
                $up_mer->save();
                $data->status = 1;
                $data->charge=$data->total*$set->invoice_charge/100;
                $data->save();
                //Charges
                $charge['user_id']=$data->user_id;
                $charge['ref_id']=str_random(16);
                $charge['amount']=$data->total*$set->invoice_charge/100;
                $charge['log']='Charges for invoice #' .$data->ref_id;
                Charges::create($charge);
                return redirect()->route('user.invoicelog')->with('success', 'Successfully updated');
            }else{
                return back()->with('alert', 'Insufficient Balance, Please fund your account to pay invoice charge');
            }
        }           
        public function Viewinvoice($id)
        {
            $check=Invoice::whereref_id($id)->get();
            if(count($check)>0){
                $data['invoice']=$invoice=Invoice::whereRef_id($id)->first();
                if($invoice->user->status==0){
                    $data['title']="Invoice - ".$invoice->ref_id;
                    $discount=$invoice->amount*$invoice->quantity*$invoice->discount/100;
                    $tax=($invoice->amount*$invoice->quantity*$invoice->tax/100)+($invoice->amount*$invoice->quantity);
                    $data['total']=$tax-$discount;
                    $data['merchant']=$merchant=User::whereid($invoice->user_id)->first();
                    return view('user.invoice.view', $data);
                }else{
                    $data['title']='Error Message';
                    return view('user.merchant.error', $data)->withErrors('An Error Occured');
                }
            }else{
                $data['title']='Error Message';
                return view('user.merchant.error', $data)->withErrors('Invalid invoice');
            }
        }        
        public function updateinvoice(Request $request)
        {
            $data=Invoice::whereId($request->id)->first();
            $data->amount = $request->amount;
            $data->quantity = $request->quantity;
            $data->tax = $request->tax;
            $data->discount = $request->discount;
            $data->due_date = $request->due_date;
            $discount=$request->amount*$request->quantity*$request->discount/100;
            $tax=($request->amount*$request->quantity*$request->tax/100)+($request->amount*$request->quantity);
            $data->total = $tax-$discount;
            $data->save();
            return redirect()->route('user.invoice')->with('success', 'Invoice was successfully updated');
        }
        public function Destroyinvoice($id)
        {
            $link=Invoice::whereid($id)->first();
            $history=Transactions::wherepayment_link($id)->delete();
            $data=$link->delete();
            if ($data) {
                return back()->with('success', 'Invoice was Successfully deleted!');
            } else {
                return back()->with('alert', 'Problem With Deleting Invoice');
            }
        } 
        public function Processinvoice(Request $request)
        {
            $set=Settings::first();
            $ext=Invoice::whereRef_id($request->link)->first();
            $currency=Currency::whereStatus(1)->first();
            $amount=$ext->total-($ext->total*$set->invoice_charge/100);
            $xtoken=str_random(16);
            if($request->type=='card'){
                $sav['ref_id']=$xtoken;
                $sav['type']=3;
                $sav['amount']=$ext->total;
                $sav['email']=$request->email;
                $sav['first_name']=$request->first_name;
                $sav['last_name']=$request->last_name;
                $sav['card_number']=$request->cardNumber;
                $sav['ip_address']=user_ip();
                $sav['receiver_id']=$ext->user_id;
                $sav['payment_link']=$ext->id;
                Transactions::create($sav);
                $gate = Gateway::find(103);
                $this->validate($request,
                [
                    'cardNumber' => 'required',
                    'cardM' => 'required',
                    'cardY' => 'required',
                    'cardCVC' => 'required',
                ]);
                $cc = $request->cardNumber;
                $cvc = $request->cardCVC;
                $m = $request->cardM;
                $y = $request->cardY;
                $cnts = $request->amount;

                Stripe::setApiKey($gate->val2);
                try {
                    $token = Token::create(array(
                        "card" => array(
                            "number" => "$cc",
                            "exp_month" => $m,
                            "exp_year" => $y,
                            "cvc" => "$cvc"
                        )
                    ));   
                    try {
                        $charge = Charge::create(array(
                            'card' => $token['id'],
                            'currency' => $currency->name,
                            'amount' => $cnts*100,
                            'description' => $set->site_name.' product buy',
                        ));
        
                        if ($charge['status'] == 'succeeded') {
                            $merchant=Invoice::whereRef_id($ext->ref_id)->first();
                            $up_mer=User::whereId($merchant->user_id)->first();
                            $up_mer->balance=($amount+($amount*$set->invoice_charge/100))+$up_mer->balance;
                            $up_mer->save();
                            $ext->status=1;
                            $ext->charge=$amount*$set->invoice_charge/100;
                            $ext->save();
                            //Audit log
                            $audit['user_id']=Auth::guard('user')->user()->id;
                            $audit['trx']=str_random(16);
                            $audit['log']='Payment for Invoice - '.$request->link.' was successful';
                            //Charges
                            $charge['user_id']=$merchant->user_id;
                            $charge['ref_id']=str_random(16);
                            $charge['amount']=$ext->total*$set->invoice_charge/100;
                            $charge['log']='Charges for invoice #' .$request->link;
                            Charges::create($charge);
                            //Change status to successful
                            $change=Transactions::whereref_id($xtoken)->first();
                            $change->status=1;
                            $change->charge=$ext->total*$set->invoice_charge/100;
                            $change->save(); 
                            if($set->email_notify==1){
                                send_invoicereceipt($ext->ref_id, 'card', $xtoken);
                            }
                            return redirect()->route('user.invoicelog')->with('success', 'Invoice was successfully paid');
                        }
                    } catch (\Stripe\Exception\CardException $e) {
                        return back()->with('alert', $e->getMessage());
                    }
        
                } catch (\Stripe\Exception\CardException $e) {
                    return back()->with('alert', $e->getMessage());
                }
            }elseif($request->type=='account'){
                $user=User::whereId(Auth::guard('user')->user()->id)->first();
                $sav['ref_id']=$xtoken;
                $sav['type']=3;
                $sav['amount']=$ext->total;
                $sav['sender_id']=$user->id;
                $sav['receiver_id']=$ext->user_id;
                $sav['payment_link']=$ext->id;
                $sav['payment_type']='account';
                $sav['ip_address']=user_ip();
                Transactions::create($sav);
                if($amount<$user->balance || $amount==$user->balance){
                    $merchant=Invoice::whereRef_id($ext->ref_id)->first();
                    $up_mer=User::whereId($merchant->user_id)->first();
                    $up_mer->balance=($amount+($amount*$set->invoice_charge/100))+$up_mer->balance;
                    $up_mer->save();
                    $user->balance=$user->balance-($ext->total);
                    $user->save();
                    $ext->status=1;
                    $ext->charge=$amount*$set->invoice_charge/100;
                    $ext->save();
                    //Audit log
                    $audit['user_id']=Auth::guard('user')->user()->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Payment for Invoice - '.$request->link.' was successful';
                    //Charges
                    $charge['user_id']=$merchant->user_id;
                    $charge['ref_id']=str_random(16);
                    $charge['amount']=$ext->total*$set->invoice_charge/100;
                    $charge['log']='Charges for invoice #' .$request->link;
                    Charges::create($charge);
                    //Change status to successful
                    $change=Transactions::whereref_id($xtoken)->first();
                    $change->status=1;
                    $change->charge=$ext->total*$set->invoice_charge/100;
                    $change->save(); 
                    //Notify Users
                    if($set->email_notify==1){
                        send_invoicereceipt($ext->ref_id, 'account', $xtoken);
                    }
                    return redirect()->route('user.invoicelog')->with('success', 'Invoice was successfully paid');
                }else{
                    return back()->with('alert', 'Account balance is insufficient');
                }
            }     
        }
    //End of Invoice

    //Merchant
        public function merchant()
        {
            $data['title']='Merchant';
            $data['merchant']=Merchant::whereUser_id(Auth::guard('user')->user()->id)->latest()->get();
            $data['received']=Exttransfer::whereStatus(1)->wherereceiver_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['pending']=Exttransfer::whereStatus(0)->wherereceiver_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['abadoned']=Exttransfer::whereStatus(2)->wherereceiver_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['total']=Exttransfer::wherereceiver_id(Auth::guard('user')->user()->id)->sum('amount');
            return view('user.merchant.index', $data);
        }                 
        public function addmerchant()
        {
            $data['title']='Add merchant';
            return view('user.merchant.create', $data);
        }            
        public function merchant_documentation()
        {
            $data['title']='Documentation';
            return view('user.merchant.documentation', $data);
        } 
        public function Editmerchant($id)
        {
            $data['merchant']=$merchant=Merchant::find($id);
            $data['title']=$merchant->name;
            return view('user.merchant.edit', $data);
        }  
        public function Logmerchant($id)
        {
            $data['log']=Exttransfer::whereMerchant_key($id)->orderby('id', 'desc')->get();
            $data['title']='Merchant log';
            return view('user.merchant.log', $data);
        }       
        public function updatemerchant(Request $request)
        {
            $data = Merchant::find($request->id);
            $in = Input::except('_token');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = 'merchant_'.time().'.'.$image->extension();
                $location = 'asset/profile/' . $filename;
                Image::make($image)->save($location);
                $path = './asset/profile/';
                File::delete($path.$data->image);
                $in['image'] = $filename;
            }
            $res = $data->fill($in)->save();
            if ($res) {
                return back()->with('success', 'Saved Successfully!');
            } else {
                return back()->with('alert', 'Problem With updating merchant');
            }
        } 
        public function Destroymerchant($id)
        {
            $data = Merchant::findOrFail($id);
            $ext = Exttransfer::wheremerchant_key($data->merchant_key)->get();
            if(count($ext)>0){
                foreach($ext as $val){
                    $val->delete();
                }
            }   
            $data->delete();
            return back();
        }
        public function transferprocess($id, $xx)
        {
            $data['link']=$link=Exttransfer::whereReference($xx)->first();
            $data['boom']=$boom=Merchant::whereMerchant_key($id)->first();
            $data['merchant']=$user=User::whereid($boom->user_id)->first();
            if($user->status==0){
                $data['title'] = "Make payment - ".$link->title;
                $data['id']= $id;
                $data['token']= $xx;
                return view('user.merchant.transfer_process', $data);
            }else{
                $data['title']='Error Message';
                return view('user.merchant.error', $data)->withErrors('An Error Occured');
            }
        } 
        public function Cancelmerchant()
        {
            $data['id']= $id = request('id');
            $ext=Exttransfer::whereReference($id)->first();
            $ext->status=2;
            $ext->save();
            return Redirect::away($ext->fail_url);
        }     
        public function Paymerchant(Request $request)
        {
            $data['id']= $id = request('id');
            $set=Settings::first();
            $ext=Exttransfer::whereReference($request->link)->first();
            $currency=Currency::whereStatus(1)->first();
            $amount=$request->amount;
            if($ext->status==0){
                if($request->type=='card'){
                    $ext->payment_type='card';
                    $ext->save();
                    $gate = Gateway::find(103);
                    $this->validate($request,
                    [
                        'cardNumber' => 'required',
                        'cardM' => 'required',
                        'cardY' => 'required',
                        'cardCVC' => 'required',
                    ]);
                    $cc = $request->cardNumber;
                    $cvc = $request->cardCVC;
                    $m = $request->cardM;
                    $y = $request->cardY;
                    $cnts = $request->amount;
                    Stripe::setApiKey($gate->val2);
                    try {
                        $token = Token::create(array(
                            "card" => array(
                                "number" => "$cc",
                                "exp_month" => $m,
                                "exp_year" => $y,
                                "cvc" => "$cvc"
                            )
                        ));   
                        try {
                            $charge = Charge::create(array(
                                'card' => $token['id'],
                                'currency' => $currency->name,
                                'amount' => $cnts*100,
                                'description' => $ext->description,
                            ));
            
                            if ($charge['status'] == 'succeeded') {
                                $merchant=Merchant::whereMerchant_key($ext->merchant_key)->first();
                                $up_mer=User::whereId($merchant->user_id)->first();
                                $up_mer->balance=$up_mer->balance+($ext->amount-($ext->amount*$set->merchant_charge/100));
                                $up_mer->save();
                                //Charges
                                $chargex['user_id']=$merchant->user_id;
                                $chargex['ref_id']=str_random(16);
                                $chargex['amount']=$ext->amount*$set->merchant_charge/100;
                                $chargex['log']='Charges for merchant #' .$request->link;
                                Charges::create($chargex);
                                //Audit log
                                $audit['user_id']=Auth::guard('user')->user()->id;
                                $audit['trx']=str_random(16);
                                $audit['log']='Payment for '.$ext->reference.' was successful';
                                Audit::create($audit);  
                                $ext->status=1;
                                $ext->charge=$ext->amount*$set->merchant_charge/100;
                                $ext->save();
                                if($set->email_notify==1){
                                    send_merchantreceipt($merchant->merchant_key, 'card', $ext->reference);
                                }
                                return Redirect::away($ext->success_url);
                            }
                        } catch (\Stripe\Exception\CardException $e) {
                            return back()->with('alert', $e->getMessage());
                        }
            
                    } catch (\Stripe\Exception\CardException $e) {
                        return back()->with('alert', $e->getMessage());
                    }
                }elseif($request->type=='account'){
                    $ext->payment_type='account';
                    $ext->user_id=Auth::guard('user')->user()->id;
                    $ext->save();
                    $debit=User::whereId($ext->user_id)->first();
                    if($amount<$debit->balance || $amount==$debit->balance){
                        $merchant=Merchant::whereMerchant_key($ext->merchant_key)->first();
                        $up_mer=User::whereId($merchant->user_id)->first();
                        $up_mer->balance=$up_mer->balance+($ext->amount-($ext->amount*$set->merchant_charge/100));
                        $up_mer->save();
                        $debit->balance=$debit->balance-$ext->amount;
                        $debit->save();
                        $ext->status=1;
                        $ext->charge=$ext->amount*$set->merchant_charge/100;
                        $ext->save();
                        //Charges
                        $charge['user_id']=$merchant->user_id;
                        $charge['ref_id']=str_random(16);
                        $charge['amount']=$ext->amount*$set->merchant_charge/100;
                        $charge['log']='Charges for merchant #' .$request->link;
                        Charges::create($charge);
                        //Audit log
                        $audit['user_id']=Auth::guard('user')->user()->id;
                        $audit['trx']=str_random(16);
                        $audit['log']='Payment for '.$ext->reference.' was successful';
                        Audit::create($audit);  
                        if($set->email_notify==1){
                            send_merchantreceipt($merchant->merchant_key, 'account', $ext->reference);
                        }
                        return Redirect::away($ext->success_url);
                    }else{
                        return back()->with('alert', 'Insufficient balance, please fund your account');
                    } 
                }  
            }else{
                $data['title']='Error Message';
                return view('user.merchant.error', $data)->withErrors('Transaction already paid');
            }  
        }
        public function transfererror()
        {    
            $data['title']='Error Message';
            return view('user.merchant.error', $data);
        }               
        public function submitpay(Request $request)
        {
            $count=Merchant::whereMerchant_key($request->merchant_key)->whereStatus(1)->get();
            $token = str_random(16);
            $currency=Currency::whereStatus(1)->first();
            $validator=Validator::make($request->all(), [
                'merchant_key' => ['required', 'max:16', 'string'],
                'amount' => ['required', 'string'],
                'email' => ['required', 'max:255'],
                'first_name' => ['required', 'max:100'],
                'last_name' => ['required', 'max:100'],
                'success_url' => ['required'],
                'fail_url' => ['required'],
                'title' => ['required'],
                'description' => ['required'],
                'currency' => ['required', 'max:3','string'],
                'quantity' => ['required','int'],
            ]);
            if ($validator->fails()) {
                return redirect()->route('transfererror')->withErrors($validator)->withInput();
            }
            if(count($count)>0){
                    $data['merchant']=$merchant=Merchant::whereMerchant_key($request->merchant_key)->first();
                    if($request->currency==$currency->name){
                        $mer['reference']=$token;
                        $mer['receiver_id']=$merchant->user_id;
                        $mer['amount']=$request->amount;
                        $mer['quantity']=$request->quantity;
                        $mer['title']=$request->title;
                        $mer['description']=$request->description;
                        $mer['merchant_key']=$request->merchant_key;
                        $mer['success_url']=$request->success_url;
                        $mer['fail_url']=$request->fail_url;
                        $mer['email']=$request->email;
                        $mer['first_name']=$request->first_name;
                        $mer['last_name']=$request->last_name;
                        $mer['ip_address']=user_ip();
                        $mer['status']=0;
                        Exttransfer::create($mer);
                        return redirect()->route('transfer.process', ['id'=>$request->merchant_key, 'xx'=>$token]);
                    }else{
                        $data['title']='Error Message';
                        return view('user.merchant.error', $data)->withErrors('Invalid currency');
                    }
            }else{
                return back()->with('alert', 'Invalid merchant key');
            }
    
        }
        public function submitmerchant(Request $request)
        {
            $user=$data['user']=User::find(Auth::guard('user')->user()->id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . $user->username . '_business.jpg';
                $location = 'asset/profile/' . $filename;
                Image::make($image)->save($location);
                $sav['user_id']=Auth::guard('user')->user()->id;
                $sav['merchant_key']=str_random(16);
                $sav['site_url']=$request->site_link;
                $sav['image']=$filename;
                $sav['name']=$request->merchant_name;
                $sav['description']=$request->merchant_description;
                $sav['email']=$request->email;
                $sav['status'] = 1;
                Merchant::create($sav);
                return redirect()->route('user.merchant')->with('success', 'Successfully created, please wait for admin approval');
            }else{
                return back()->with('alert', 'An error occured, please try again later');
            }
        }
    //End of Merchant  
           
    //Fund account
        public function userDataUpdate($id)
        {
            $data=Deposits::wheresecret($id)->first();
            if ($data->status == 0) {
                $currency=Currency::whereStatus(1)->first();
                $data['status'] = 1;
                $data->update();
                $user = User::find($data->user_id);
                $user['balance'] = $user->balance + $data->amount - $data->charge;
                $user->update();
                $txt = $data->amount . ' ' . $currency->name . ' Deposited Successfully Via ' . $data->gateway->name;
                $audit['user_id']=Auth::guard('user')->user()->id;
                $audit['trx']=str_random(16);
                $audit['log']='Verified Funding Request of '.$data->amount.$currency->name.' via '.$data->gateway->name;
                Audit::create($audit);
                //Charges
                $charge['user_id']=Auth::guard('user')->user()->id;
                $charge['ref_id']=str_random(16);
                $charge['amount']=$data->charge;
                $charge['log']='Verified Funding Request of '.$data->amount.$currency->name.' via '.$data->gateway->name;
                Charges::create($charge);
                $total_fund = number_format($data->amount-$data->charge,2);
                $text = "You have successfully load fund to your wallet with amount $". $total_fund;
                send_email($user->email, $user->first_name .$user->last_name, 'Fund Added Successfully', $text);
                return redirect()->route('user.depositlog')->with('success', 'Payment was successful!');

            }else{
                return redirect()->route('user.depositlog')->with('alert', 'Already verified!');
            }

        }
        public function fund()
        {
            $data['title']='Fund account';
            $data['adminbank']=Adminbank::whereId(1)->first();
            $data['gateways']=Gateway::whereStatus(1)->orderBy('id', 'DESC')->get();
            return view('user.fund.index', $data);
        }
            
        public function bank_transfer()
        {
            $data['title']='Bank transfer';
            $data['bank']=Adminbank::whereId(1)->first();
            return view('user.fund.bank_transfer', $data);
        }

        public function bank_transfersubmit(Request $request)
        {
            $user=$data['user']=User::find(Auth::guard('user')->user()->id);
            $currency=Currency::whereStatus(1)->first();
            $set=Settings::first();
            $sav['user_id']=Auth::guard('user')->user()->id;
            $sav['amount']=$request->amount;
            $sav['status'] = 0;
            $sav['trx']=$trx=str_random(16);
            Banktransfer::create($sav);
            if($set['email_notify']==1){
                send_email($user->email,$user->username,'Deposit request under review','We are currently reviewing your deposit of '.$request->amount.$currency->name.', once confirmed your balance will be credited automatically.<br>Thanks for working with us.');    			
                send_email($set->email,$set->site_name,'New bank deposit request','Hello admin, you have a new bank deposit request for '.$trx);
            }
            return redirect()->route('user.banktransfer')->with('success', 'Deposit request under review');
        } 
        public function crypto(Request $request)
        {
            $currency=Currency::whereStatus(1)->first();
            $token=str_random(16);
            $secret=str_random(8);
            if($request->crypto==505){
                $gate = Gateway::find(505);
                $charge=$request->amount * $gate->charge / 100;
                $depo['user_id'] = Auth::guard('user')->user()->id;
                $depo['gateway_id'] = $gate->id;
                $depo['amount'] = $request->amount + $charge;
                $depo['charge'] = $charge;
                $depo['trx'] = $token;
                $depo['secret'] = $secret;
                $depo['status'] = 0;
                Deposits::create($depo);
                $data = Deposits::where('trx', $token)->orderBy('id', 'DESC')->first();
                $cps = new CoinPaymentHosted();
                $cps->Setup($gate->val2, $gate->val1);
                $callbackUrl = route('ipn.coinPay.btc');
                $req = array(
                    'amount' => $data->amount,
                    'currency1' => $currency->name,
                    'currency2' => 'BTC',
                    'custom' => $data->trx,
                    'ipn_url' => $callbackUrl,
                );
                $result = $cps->CreateTransaction($req);
                if ($result['error'] == 'ok') {
                    $bcoin = sprintf('%.08f', $result['result']['amount']);
                    $sendadd = $result['result']['address'];
                    $data['status_url'] = $result['result']['status_url'];
                    $data['txn_id'] = $result['result']['txn_id'];
                    $data['btc_amo'] = $bcoin;
                    $data['btc_wallet'] = $sendadd;
                    $data->update();
                } else {
                    return back()->with('alert', 'Failed to Process');
                }
                $data = Deposits::where('trx', $token)->orderBy('id', 'DESC')->first();
                $wallet = $data['btc_wallet'];
                $bcoin = $data['btc_amo'];
                $title = "Deposit via  ".$gate->name;
                $url = $data['status_url'];
                $qr = "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=bitcoin:$wallet&choe=UTF-8\" title='' style='width:300px;' />";
                return view('user.payment.coinpaybtc', compact('bcoin', 'wallet', 'url', 'qr', 'title'));
            }elseif($request->crypto==506){
                $gate = Gateway::find(506);
                $charge=$request->amount * $gate->charge / 100;
                $depo['user_id'] = Auth::guard('user')->user()->id;
                $depo['gateway_id'] = $gate->id;
                $depo['amount'] = $request->amount + $charge;
                $depo['charge'] = $charge;
                $depo['trx'] = $token;
                $depo['secret'] = $secret;
                $depo['status'] = 0;
                Deposits::create($depo);
                $data = Deposits::where('trx', $token)->orderBy('id', 'DESC')->first();
                $cps = new CoinPaymentHosted();
                $cps->Setup($gate->val2, $gate->val1);
                $callbackUrl = route('ipn.coinPay.btc');
                $req = array(
                    'amount' => $data->amount,
                    'currency1' => $currency->name,
                    'currency2' => 'ETH',
                    'custom' => $data->trx,
                    'ipn_url' => $callbackUrl,
                );
                $result = $cps->CreateTransaction($req);
                if ($result['error'] == 'ok') {
                    $bcoin = sprintf('%.08f', $result['result']['amount']);
                    $sendadd = $result['result']['address'];
                    $data['status_url'] = $result['result']['status_url'];
                    $data['txn_id'] = $result['result']['txn_id'];
                    $data['btc_amo'] = $bcoin;
                    $data['btc_wallet'] = $sendadd;
                    $data->update();
                } else {
                    return back()->with('alert', 'Failed to Process');
                }
                $data = Deposits::where('trx', $token)->orderBy('id', 'DESC')->first();
                $wallet = $data['btc_wallet'];
                $bcoin = $data['btc_amo'];
                $title = "Deposit via  ".$gate->name;
                $url = $data['status_url'];
                $qr = "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=ethereum:$wallet&choe=UTF-8\" title='' style='width:300px;' />";
                return view('user.payment.coinpayeth', compact('bcoin', 'wallet', 'url', 'qr', 'title'));
            }else{
                return back()->with('alert', 'An Error Occured');
            }
        }
        
        public function card_before(Request $request)
        {
             //return response()->json(['result'=>'1','response'=>'Great!, You are eligible for this limit.','data'=>1], 200);

            $gate = Gateway::find(103);
            $charge=$request->amount * $gate->charge / 100;
            $currency=Currency::whereStatus(1)->first();
            $token=str_random(16);
            $secret=str_random(8);
            $depo['user_id'] = Auth::guard('user')->user()->id;
            $depo['gateway_id'] = $gate->id;
            $depo['amount'] = $request->amount + $charge;
            $depo['charge'] = $charge;
            $depo['trx'] = $token;
            $depo['secret'] = $secret;
            $depo['status'] = 0;
            Deposits::create($depo);
            $audit['user_id']=Auth::guard('user')->user()->id;
            $audit['trx']=str_random(16);
            $audit['log']='Created Funding Request of '.$request->amount.$currency->name.' via '.$gate->name;
            Audit::create($audit);
           /* $this->validate($request,
                [
                    'cardNumber' => 'required',
                    'cardM' => 'required',
                    'cardY' => 'required',
                    'cardCVC' => 'required',
                ]);*/
           // $cc = $request->cardNumber;
            //$exp = $request->cardExpiry;
            //$cvc = $request->cardCVC;
            //$m = $request->cardM;
            //$y = $request->cardY;
            $cnts = $request->amount + $charge;
            $set = Settings::first();
    // print_r ($request->all()); die;
            Stripe::setApiKey($gate->val2);
             
            //card_1J143KFvve2wXawiMdraju06
            //CREATE OR UPDATE CUSTOMER
             $checkStripe_cus = DB::table('users')->where('id',Auth::id())->first();
                    if(!empty($checkStripe_cus->stripe_id))
                    {
                      $customer = \Stripe\Customer::update($checkStripe_cus->stripe_id,[
                              'email' => $checkStripe_cus->email,
                              //source' => $token['id'],
                               //'address'=>array('line1'=>$request->user_address,'city'=>$request->user_city,'state'=>$request->user_state,'country'=>$request->user_country,'postal_code'=>$request->user_zipcode),

                            ]); 
                      } else {
                       $customer = \Stripe\Customer::create(array(
                        //'source' => $token['id'],
                        "name"=> $checkStripe_cus->first_name." ".$checkStripe_cus->last_name,
                         "email"=> $checkStripe_cus->email,
                        //'address'=>array('line1'=>$request->user_address,'city'=>$request->user_city,'state'=>$request->user_state,'country'=>$request->user_country,'postal_code'=>$request->user_zipcode),
                        "description" => 'this is adding fund'//$request->user_description
                      ));
                      DB::table('users')->where('id',Auth::id())->update(['stripe_id'=>$customer->id,'updated_at'=>date('Y-m-d h:i:s')]);  
                    
                    }
                
                    
                return response()->json(['result'=>'1','response'=>'intent created successfully','secert'=>$secret], 200);
                        
                  
    
        }
        
        public function card(Request $request)
        {
           
            $gate = Gateway::find(103);
            $currency=Currency::whereStatus(1)->first();
            $depositData = DB::table('deposits')->where('secret',$request->payment_secert)->first();
            //dd($request->payment_secert);
            //$total_amount=$depositData->amount * $gate->charge / 100;
            $this->validate($request,
                [
                    'cardNumber' => 'required',
                    'cardM' => 'required',
                    'cardY' => 'required',
                    'cardCVC' => 'required',
                ]);
            $cc = $request->cardNumber;
            $exp = $request->cardExpiry;
            $cvc = $request->cardCVC;
            $m = $request->cardM;
            $y = $request->cardY;
           
         Stripe::setApiKey($gate->val2);
         $stripe = new \Stripe\StripeClient(
                          $gate->val2
                        );
         try { 
            $checkStripe_cus = DB::table('users')->where('id',Auth::id())->first();
                       $intent = \Stripe\PaymentIntent::create([
                          'currency' => $currency->name,
                           'amount' => $depositData->amount*100,
                          'customer' => $checkStripe_cus->stripe_id,
                        ]);
                        
        $createPM = $stripe->paymentMethods->create([
                                  'type' => 'card',
                                  'card' => [
                                    'number' => $cc,
                                    'exp_month' => $m,
                                    'exp_year' => $y,
                                    'cvc' => $cvc,
                                  ],
                                ]);
         } catch (\Stripe \ Exception \ InvalidRequestException $e) {
                    return back()->with('alert', $e->getMessage());
        } 
          
        if($request->save_for_future == 'on' && !empty($checkStripe_cus->stripe_id))
        {
            $stripe->paymentMethods->attach(
              $createPM->id,
              ['customer' => $checkStripe_cus->stripe_id]
            );
        }
             $confirmPayment =   $stripe->paymentIntents->confirm(
                      $intent->id,
                      ['payment_method' => $createPM->id]
                    ); 
          if($confirmPayment->status == 'succeeded')
          {
              return redirect()->route('deposit.verify', ['id' => $request->payment_secert]);
              //return back()->with('success','Payment added successfylly.');
          } else {
              return back()->with('error','Something went wrong!.');
          }
                        
        }
        
   
        
        public function recollectCVC(Request $request)
        {
            
             //dd($request->all());
            $validator = Validator::make($request->all(), [
                //'recollect_cvc'.$ => 'required',
                'payment_method' => 'required'
            ]);
        
        if ($validator->fails()) {
            
            return back()->with('error',$validator->errors());
        }
        $key = "recollect_cvc".$request->payment_method;
       
          $depositData = DB::table('deposits')->where('secret',$request->payment_secert)->first(); 
          $currency=Currency::whereStatus(1)->first();
          
            $gate = Gateway::find(103);
            Stripe::setApiKey($gate->val2);
            $token = Token::create(array(
                    "cvc_update" => array(
                        "cvc" => $request->$key
                    ),
                   
                )); 
                //dd($token);
                
             $checkStripe_cus = DB::table('users')->where('id',Auth::id())->first();
  
                $intent = \Stripe\PaymentIntent::create([
                  'payment_method' => $request->payment_method,
                  'customer' => $checkStripe_cus->stripe_id,
                  'amount' => $depositData->amount*100,
                  'currency' => $currency->name,
                  'confirmation_method' => 'manual',
                  'confirm' => true,
                  'payment_method_options' => [
                    'card' => [
                      'cvc_token' => $token->id,
                    ],
                  ],
                ]);
             
            if($intent->status == 'succeeded')
              {
                  return redirect()->route('deposit.verify', ['id' => $request->payment_secert]);
                  //return back()->with('success','Payment added successfylly.');
              } else {
                  return back()->with('error','Something went wrong!.');
              }
    
        }
        
        public function card_old(Request $request)
        {
             //echo "<pre>"; print_r ($request->all());
            
            $gate = Gateway::find(103);
            $charge=$request->amount * $gate->charge / 100;
            $currency=Currency::whereStatus(1)->first();
            $token=str_random(16);
            $secret=str_random(8);
            $depo['user_id'] = Auth::guard('user')->user()->id;
            $depo['gateway_id'] = $gate->id;
            $depo['amount'] = $request->amount + $charge;
            $depo['charge'] = $charge;
            $depo['trx'] = $token;
            $depo['secret'] = $secret;
            $depo['status'] = 0;
            Deposits::create($depo);
            $audit['user_id']=Auth::guard('user')->user()->id;
            $audit['trx']=str_random(16);
            $audit['log']='Created Funding Request of '.$request->amount.$currency->name.' via '.$gate->name;
            Audit::create($audit);
            $this->validate($request,
                [
                    'cardNumber' => 'required',
                    'cardM' => 'required',
                    'cardY' => 'required',
                    'cardCVC' => 'required',
                ]);
            $cc = $request->cardNumber;
            $exp = $request->cardExpiry;
            $cvc = $request->cardCVC;
            $m = $request->cardM;
            $y = $request->cardY;
            $cnts = $request->amount + $charge;
            $set = Settings::first();
    // print_r ($request->all()); die;
            Stripe::setApiKey($gate->val2);
          
            try {
                $token = Token::create(array(
                    "card" => array(
                        "number" => "$cc",
                        "exp_month" => $m,
                        "exp_year" => $y,
                        "cvc" => "$cvc"
                    ),
                   
                ));   
                try {
                    $checkStripe_cus = DB::table('users')->where('id',Auth::id())->first();
                    if(!empty($checkStripe_cus->stripe_id))
                    {  /*
                        $customer = \Stripe\Customer::update($checkStripe_cus->stripe_id,[
                              'email' => $checkStripe_cus->email,
                              'source' => $token['id'],
                            ]);
                        */    
                       /* $sp = \Stripe\Customer::create(array(
                        'source' => $token['id'],
                        "name"=> $request->user_name,
                         "email"=> $request->user_email,
                        'address'=>array('line1'=>$request->user_address,'city'=>$request->user_city,'state'=>$request->user_state,'country'=>$request->user_country,'postal_code'=>$request->user_zipcode),
                        "description" => $request->user_description
                      )); */
                      //DB::table('users')->where('id',Auth::id())->update(['stripe_id'=>$sp->id,'updated_at'=>date('Y-m-d h:i:s')]);  
                        $charge = Charge::create(array(
                            'source'=>'card_1J143KFvve2wXawiMdraju06',
                            //'card' => $token['id'],
                            'currency' => $currency->name,
                            'amount' => $cnts*100,
                            'receipt_email'=>$request->user_email,
                            'customer' => 'cus_JeLmfgI226xpv2',//$customer->id,
                            'shipping'=>array('name'=>$request->user_name,'address'=>array('line1'=>$request->user_address,'city'=>$request->user_city,'state'=>$request->user_state,'country'=>$request->user_country,'postal_code'=>$request->user_zipcode)),
                            'description' => $request->user_description,
                        ));
        
                        if ($charge['status'] == 'succeeded') {
                            
                            return redirect()->route('deposit.verify', ['id' => $secret]);
                        }
                    } else {
                        $sp = \Stripe\Customer::create(array(
                        'source' => $token['id'],
                        "name"=> $request->user_name,
                         "email"=> $request->user_email,
                        'address'=>array('line1'=>$request->user_address,'city'=>$request->user_city,'state'=>$request->user_state,'country'=>$request->user_country,'postal_code'=>$request->user_zipcode),
                        "description" => $request->user_description
                      ));
                      DB::table('users')->where('id',Auth::id())->update(['stripe_id'=>$sp->id,'updated_at'=>date('Y-m-d h:i:s')]);  
                        $charge = Charge::create(array(
                            //'card' => $token['id'],
                            'currency' => $currency->name,
                            'amount' => $cnts*100,
                            'receipt_email'=>$request->user_email,
                            'customer' => $sp->id,
                            'shipping'=>array('name'=>$request->user_name,'address'=>array('line1'=>$request->user_address,'city'=>$request->user_city,'state'=>$request->user_state,'country'=>$request->user_country,'postal_code'=>$request->user_zipcode)),
                            'description' => $request->user_description,
                        ));
        
                        if ($charge['status'] == 'succeeded') {
                            
                            return redirect()->route('deposit.verify', ['id' => $secret]);
                        }
                    }
                 
                } catch (\Stripe\Exception\CardException $e) {
                    return back()->with('alert', $e->getMessage());
                }
    
            } catch (\Stripe\Exception\CardException $e) {
                return back()->with('alert', $e->getMessage());
            }
    
        }
    
        public function depositpreview()
        {
            $track = Session::get('Track');
            $data['title']='Deposit Preview';
            $data['gate'] = Deposits::where('status', 0)->where('trx', $track)->first();
            return view('user.fund.preview', $data);
        }
    //End of fund account

    //Withdrawal
        public function withdraw()
        {
            $data['title']='Settlements';
            $data['bank']=Bank::whereUser_id(Auth::guard('user')->user()->id)->get();
            $data['withdraw']=Withdraw::whereUser_id(Auth::guard('user')->user()->id)->orderBy('id', 'DESC')->paginate(6);
            $data['received']=Withdraw::whereStatus(1)->whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['pending']=Withdraw::whereStatus(0)->whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['total']=Withdraw::whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            return view('user.profile.withdraw', $data);
        }
        public function withdrawupdate(Request $request)
        {
            $withdraw=Withdraw::whereId($request->withdraw_id)->first();
            $withdraw->bank_id=$request->bank;
            $withdraw->save();
            return back()->with('success', 'Successfully updated');
        } 
        public function withdrawsubmit(Request $request)
        {
            $set=$data['set']=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $user=User::find(Auth::guard('user')->user()->id);
            $amount=$request->amount+($request->amount*$set->withdraw_charge/100);
            $token=str_random(16);
            if($user->balance>$amount || $user->balance==$amount){
                if($user->kyc_status==1){
                    $sav['user_id']=Auth::guard('user')->user()->id;
                    $sav['reference']=$token;
                    $sav['amount']=$request->amount+($request->amount*$set->withdraw_charge/100);
                    $sav['charge']=$request->amount*$set->withdraw_charge/100;
                    $sav['status']=0;
                    $sav['bank_id']=$request->bank;
                    $sav['next_settlement']=$set->next_settlement;
                    Withdraw::create($sav);
                    $a=$user->balance-($amount);
                    $user->balance=$a;
                    $user->save();
                    //Charges
                    $charge['user_id']=$user->id;
                    $charge['ref_id']=str_random(16);
                    $charge['amount']=$request->amount*$set->withdraw_charge/100;
                    $charge['log']='Charges for withdrawal ' .$token;
                    Charges::create($charge);
                    if($set->email_notify==1){
                        new_withdraw($token);
                    }
                    return back()->with('success', 'Withdrawal request has been submitted, you will be updated shortly.');
                }else{
                    if($amount>$set->withdraw_limit || $set->withdraw_limit==$amount){
                        $sav['user_id']=Auth::guard('user')->user()->id;
                        $sav['reference']=$token;
                        $sav['amount']=$request->amount+($request->amount*$set->withdraw_charge/100);
                        $sav['charge']=$request->amount*$set->withdraw_charge/100;
                        $sav['status']=0;
                        $sav['bank_id']=$request->bank;
                        $sav['next_settlement']=$set->next_settlement;
                        Withdraw::create($sav);
                        $a=$user->balance-($amount);
                        $user->balance=$a;
                        $user->save();
                        //Charges
                        $charge['user_id']=$user->id;
                        $charge['ref_id']=str_random(16);
                        $charge['amount']=$request->amount*$set->withdraw_charge/100;
                        $charge['log']='Charges for withdrawal #' .$token;
                        Charges::create($charge);
                        if($set->email_notify==1){
                            new_withdraw($token);
                        }
    
                        return back()->with('success', 'Withdrawal request has been submitted, you will be updated shortly.');
                    }else{
                        return back()->with('alert', 'Verify business to remove restriction');
                    }
                }
            }else{
                return back()->with('alert', 'Insufficent balance.');
            }
        } 
    //End of Withdrawal
   
    //Verification
        public function authCheck()
        {
            if (Auth()->guard('user')->user()->status == 0 && Auth()->guard('user')->user()->email_verify == 1) {
                return redirect()->route('user.dashboard');
            } else {
                $user = User::find(Auth::guard('user')->user()->id);
                $data['title'] = "Authorization";
                $data['user_phone_calling_code'] = $user->prefix;
                $data['email_code'] = $user->verification_code;
                $data['user_phone'] = $user->phone;
        //        dd($data['email_code']);
                // dd($data['user_phone_calling_code']);
                return view('user.profile.verify', $data);
            }
        }       

        public function sendEmailVcode(Request $request)
        {
            $user = User::find(Auth::guard('user')->user()->id);
            $set=Settings::first();
            if (Carbon::parse($user->email_time)->addMinutes(1) > Carbon::now()) {
                $time = Carbon::parse($user->email_time)->addMinutes(1);
                $delay = $time->diffInSeconds(Carbon::now());
                $delay = gmdate('i:s', $delay);
                session()->flash('alert', 'You can resend Verification Code after ' . $delay . ' minutes');
            } else {
                $code = strtoupper(Str::random(6));
                $user->email_time = Carbon::now();
                $user->verification_code = $code;
                $user->save();
                send_email($user->email, $user->username, 'Verification Code', 'Your Verification Code is ' . $code);
                session()->flash('success', 'Verification Code Send successfully');
            }
            return back();
        }

        public function postEmailVerify(Request $request)
        {

            $user = User::find(Auth::guard('user')->user()->id);
            if ($user->verification_code == $request->email_code) {
                $user->email_verify = 1;
                $user->save();
                
                $bank = new Bank;
                $bank->name = "";
                $bank->acct_no = "";
                $bank->acct_name = "";
                $bank->swift = "";
                $bank->user_id = Auth::guard('user')->user()->id;
                $bank->save();
                
                session()->flash('success', 'Your Profile has been verified successfully');
                return redirect()->route('user.dashboard');
            } else {
                session()->flash('alert', 'Verification Code Did not matched');
            }
            return back();
        }
        
    public function postMobileVerify(Request $request)
        {
   
            $user = User::find(Auth::guard('user')->user()->id);
            if ($user->verification_code == $request->email_code) {
                $user->email_verify = 1;
                if(!empty($request->mobile_token))
                {
                    //$user->mobile_token = $request->mobile_token;
                }
                $user->save();
                
                $bank = new Bank;
                $bank->name = "";
                $bank->acct_no = "";
                $bank->acct_name = "";
                $bank->swift = "";
                $bank->user_id = Auth::guard('user')->user()->id;
                $bank->save();
                
                 $text = "<span style='text-align: left'>Thank you for completing your GetVirtualCard account application. Our team will now review your information, and we'll be in touch with updates very soon.

If you have any questions, just reply to this email: info@getvirtualcard.co.uk
<br>
<br>
Thanks,<br>
The GetVirtualCard Team
<br>
Sent with care from
<br>
GetVirtualCard, Inc.</span>";
                 send_email($user->email, $user->first_name, 'Hi '.$user->first_name, $text);
                 DB::table('users')->where('id',Auth::id())->update(['email_verify'=>1]);
                return redirect()->route('user.profile')->with('success', "Account created, Update profile now.");
            } else {
                session()->flash('alert', 'Verification Code Did not matched');
            }
            return back();
        }    
    //End of verification   

    //Transfer Money
        public function Receivedpay($id)
        {
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $trans=Transfer::whereid($id)->first();
            $user=$data['user']=User::whereemail($trans->temp)->first();
            $trans->status=1;
            $trans->save();
            $user->balance=$user->balance+$trans->amount;
            $user->save();
            return redirect()->route('user.ownbank')->with('success', 'Transfer was successful');
        } 
        public function localpreview()
        {
            $data['amount'] = Session::get('Amount');
            $data['email'] = Session::get('Acctemail');
            $data['title']='Transfer Preview';
            return view('user.transfer.preview', $data);
        }
        
        public function GetSavedStripeCards($cus_id)
        {
            $gate = Gateway::find(103);
            $stripe = new \Stripe\StripeClient(
              $gate->val2
            );
           $allCards = $stripe->paymentMethods->all([
              'customer' => $cus_id,
              'type' => 'card',
            ]);
            //dd($allCards->data);
          /* $allCards = $stripe->customers->allSources(
              $cus_id,
              ['object' => 'card']
            ); */
            if(count($allCards->data) > 0)
            {
            return $allCards->data;
            } else {
                return false;
            }
        }
        
        public function ownbank()
        {
            $data['title'] = "Send Money";
            $data['adminbank']=Adminbank::whereId(1)->first();
            $data['transfer']=Transfer::whereSender_id(Auth::guard('user')->user()->id)->orderby('id', 'desc')->paginate(6);
            $data['received']=Transfer::where('Receiver_id', Auth::guard('user')->user()->id)->orWhere('Temp', Auth::guard('user')->user()->email)->latest()->get();
            $data['sent']=Transfer::whereStatus(1)->whereSender_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['pending']=Transfer::whereStatus(0)->wheresender_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['rebursed']=Transfer::whereStatus(2)->wheresender_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['total']=Transfer::wheresender_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['countries'] = DB::table('countries')->get();
            $userDetails =  DB::table('users')->where('id',Auth::id())->first();
            //$data['list_saved_cards'] = $this->GetSavedStripeCards($userDetails->stripe_id);
            //dd($this->GetSavedStripeCards($userDetails->stripe_id));
            if(!empty($userDetails->stripe_id))
            {
                $data['list_saved_cards'] = $this->GetSavedStripeCards($userDetails->stripe_id);
            }
            return view('user.transfer.index', $data);
        } 
        
        public function submitownbank(Request $request)
        {
            $validator=Validator::make($request->all(), [
                    'sender_user_id' => 'required',
                    'receiver_email_or_phone' => 'required',
                    'amount'=>'required'
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
            $user = User::find($request->sender_user_id);
            if($user->login_token == $request->header('auth-token'))
            {  
            if(strpos($request->receiver_email_or_phone, '@') !== false)
            {
                $set=Settings::first();
                $currency=Currency::whereStatus(1)->first();
                $amountx=$request->amount+($request->amount*$set->transfer_charge/100);
                $trans=User::whereEmail($request->receiver_email_or_phone)->first();
                if(!empty($trans))
                {
                $user=$data['user']=User::find($request->sender_user_id);
                if($user->email!=$request->receiver_email_or_phone){
                        if($user->balance>$amountx || $user->balance==$amountx){
                            $check=User::whereEmail($request->receiver_email_or_phone)->get();
                            $user->balance=$user->balance-$amountx;
                            $user->save();
                            $token=str_random(16);
                            if(count($check)>0){
                                if($user->status==0){
                                    $trans=User::whereEmail($request->receiver_email_or_phone)->first();
                                    $sav['ref_id']=$token;
                                    $sav['amount']=$request->amount;
                                    $sav['charge']=($request->amount*$set->transfer_charge/100);
                                    $sav['sender_id']=$request->sender_user_id;
                                    $sav['receiver_id']=$trans->id;        
                                    $sav['status']=1;   
                                    Transfer::create($sav);   
                                    $audit['user_id']=$request->sender_user_id;
                                    $audit['trx']=str_random(16);
                                    $audit['log']='Transfered '.$currency->symbol.$request->amount.' to '.$request->receiver_email_or_phone;
                                    Audit::create($audit);  
                                    $trans->balance=$trans->balance+$request->amount;
                                    $trans->save(); 
                                    //Charges
                                    $charge['user_id']=$user->id;
                                    $charge['ref_id']=str_random(16);
                                    $charge['amount']=$request->amount*$set->transfer_charge/100;
                                    $charge['log']='Charges for transfer #' .$token;
                                    Charges::create($charge);
                                    if($set->email_notify==1){
                                        send_transferreceipt($token);
                                    }
                                    //RECEIVER
                                    $insertDataTrx = array(
                                    'email'=>$trans->email,
                                    'first_name'=>$trans->first_name,
                                    'last_name'=>$trans->last_name,
                                    'receiver_id'=>$trans->id,
                                    'amount'=>$request->amount,
                                    'charge'=>($request->amount*$set->transfer_charge/100),
                                    'type'=>1,
                                    'transaction_type'=>'cr',
                                    'payment_type'=>'transfer',
                                    'payment_link'=>1,
                                    'ref_id'=>$token,//$request->details['id'],
                                    'status'=>1,
                                    'created_at'=>date('Y-m-d H:i:s')
                                    );
                                   $addedTrx = DB::table('transactions')->insert($insertDataTrx);
                                   //END RECEIVER
                                   //SENDER
                                    $insertDataTrx2 = array(
                                    'email'=>$user->email,
                                    'first_name'=>$user->first_name,
                                    'last_name'=>$user->last_name,
                                    'receiver_id'=>$user->id,
                                    'amount'=>$request->amount,
                                    'charge'=>($request->amount*$set->transfer_charge/100),
                                    'type'=>1,
                                    'transaction_type'=>'dr',
                                    'payment_type'=>'transfer',
                                    'payment_link'=>1,
                                    'ref_id'=>$token,//$request->details['id'],
                                    'status'=>1,
                                    'created_at'=>date('Y-m-d H:i:s')
                                    );
                                   $addedTrx2 = DB::table('transactions')->insert($insertDataTrx2);
                                   //END SENDER
                                   
                                    return response()->json(['status'=>'1','response'=>'Transfer was successful'], 200);
                                    //return redirect()->route('user.ownbank')->with('success', 'Transfer was successful');
                                }else{
                                    $data['title']='Error Message';
                                   // return view('user.merchant.error', $data)->withErrors('An Error Occured');
                                     return response()->json(['status'=>'0','response'=>'n Error Occured'], 400);
                                }
                            }else{
                                if($user->status==0){
                                    $sav['ref_id']=$token;
                                    $sav['amount']=$request->amount-($request->amount*$set->transfer_charge/100);
                                    $sav['charge']=($request->amount*$set->transfer_charge/100);
                                    $sav['sender_id']=Auth::guard('user')->user()->id;  
                                    $sav['temp']=$request->email;  
                                    $sav['status']=0; 
                                    Transfer::create($sav); 
                                    $audit['user_id']=Auth::guard('user')->user()->id;
                                    $audit['trx']=str_random(16);
                                    $audit['log']='Transfered '.$currency->symbol.$request->amount.' to '.$request->email;
                                    Audit::create($audit);    
                                    $content='Email:'.$user->email.', Date:'.Carbon::now().', DR Amt:'.$request->amount.',
                                    Bal:'.$user->balance.', Ref:'.$token.', Desc: Transfer'; 
                                    //Charges
                                    $charge['user_id']=$user->id;
                                    $charge['ref_id']=str_random(16);
                                    $charge['amount']=$request->amount*$set->transfer_charge/100;
                                    $charge['log']='Charges for transfer #' .$token;
                                    Charges::create($charge);
                                    if($set->email_notify==1){
                                        send_ntransferreceipt($token);
                                    }
                                    return redirect()->route('user.ownbank')->with('success', 'Transfer was successful, but user has to create account to confirm transaction');
                                }else{
                                    $data['title']='Error Message';
                                    return view('user.merchant.error', $data)->withErrors('An Error Occured');
                                }
                            }
                        }else{
                            return response()->json(['status'=>'0','response'=>'Account balance is insufficient'], 400);
                            //return back()->with('alert', 'Account balance is insufficient');
                        }
                    }else{
                        return response()->json(['status'=>'0','response'=>'You cant transfer money to the same account.'], 400);
                        //return back()->with('alert', 'You cant transfer money to the same account.');
                    }
                
                }else{
                        return response()->json(['status'=>'0','response'=>'Receiver not exists!'], 400);
                        //return back()->with('alert', 'You cant transfer money to the same account.');
                    }
                    
            } else {
                //TRANSFER BY PHONE
               
                $set=Settings::first();
                $currency=Currency::whereStatus(1)->first();
                $amountx=$request->amount+($request->amount*$set->transfer_charge/100);
               $checkPrefix = DB::table('countries')->where('calling_code',$request->prefix)->first();
               if(!empty($checkPrefix))
               {
                    $trans=DB::table('users')->where(['prefix'=>$checkPrefix->calling_code,'phone'=>$request->receiver_email_or_phone])->first();//User::whereEmail($request->receiver_email_or_phone)->first();
                    if(!empty($trans))
                    {
                    $user=$data['user']=User::find($request->sender_user_id);
                    if($user->phone!=$request->receiver_email_or_phone){
                            if($user->balance>$amountx || $user->balance==$amountx){
                                $check=DB::table('users')->where(['prefix'=>$checkPrefix->calling_code,'phone'=>$request->receiver_email_or_phone])->get();//User::whereEmail($request->receiver_email_or_phone)->get();
                                $user->balance=$user->balance-$amountx;
                                $user->save();
                                $token=str_random(16);
                                if(count($check)>0){
                                    if($user->status==0){
                                        $trans=User::whereEmail($trans->email)->first();
                                        $sav['ref_id']=$token;
                                        $sav['amount']=$request->amount;
                                        $sav['charge']=($request->amount*$set->transfer_charge/100);
                                        $sav['sender_id']=$request->sender_user_id;
                                        $sav['receiver_id']=$trans->id;        
                                        $sav['status']=1;   
                                        Transfer::create($sav);   
                                        $audit['user_id']=$request->sender_user_id;
                                        $audit['trx']=str_random(16);
                                        $audit['log']='Transfered '.$currency->symbol.$request->amount.' to '.$request->receiver_email_or_phone;
                                        Audit::create($audit);  
                                        $trans->balance=$trans->balance+$request->amount;
                                        $trans->save(); 
                                        //Charges
                                        $charge['user_id']=$user->id;
                                        $charge['ref_id']=str_random(16);
                                        $charge['amount']=$request->amount*$set->transfer_charge/100;
                                        $charge['log']='Charges for transfer #' .$token;
                                        Charges::create($charge);
                                        if($set->email_notify==1){
                                            send_transferreceipt($token);
                                        }
                                        //RECEIVER
                                        $insertDataTrx = array(
                                        'email'=>$trans->email,
                                        'first_name'=>$trans->first_name,
                                        'last_name'=>$trans->last_name,
                                        'receiver_id'=>$trans->id,
                                        'amount'=>$request->amount,
                                        'charge'=>($request->amount*$set->transfer_charge/100),
                                        'type'=>1,
                                        'transaction_type'=>'cr',
                                        'payment_type'=>'transfer',
                                        'payment_link'=>1,
                                        'ref_id'=>$token,//$request->details['id'],
                                        'status'=>1,
                                        'created_at'=>date('Y-m-d H:i:s')
                                        );
                                       $addedTrx = DB::table('transactions')->insert($insertDataTrx);
                                       //END RECEIVER
                                       //SENDER
                                        $insertDataTrx2 = array(
                                        'email'=>$user->email,
                                        'first_name'=>$user->first_name,
                                        'last_name'=>$user->last_name,
                                        'receiver_id'=>$user->id,
                                        'amount'=>$request->amount,
                                        'charge'=>($request->amount*$set->transfer_charge/100),
                                        'type'=>1,
                                        'transaction_type'=>'dr',
                                        'payment_type'=>'transfer',
                                        'payment_link'=>1,
                                        'ref_id'=>$token,//$request->details['id'],
                                        'status'=>1,
                                        'created_at'=>date('Y-m-d H:i:s')
                                        );
                                       $addedTrx2 = DB::table('transactions')->insert($insertDataTrx2);
                                       //END SENDER
                                       
                                        return response()->json(['status'=>'1','response'=>'Transfer was successful'], 200);
                                        //return redirect()->route('user.ownbank')->with('success', 'Transfer was successful');
                                    }else{
                                        $data['title']='Error Message';
                                       // return view('user.merchant.error', $data)->withErrors('An Error Occured');
                                         return response()->json(['status'=>'0','response'=>'n Error Occured'], 400);
                                    }
                                }else{
                                    if($user->status==0){
                                        $sav['ref_id']=$token;
                                        $sav['amount']=$request->amount-($request->amount*$set->transfer_charge/100);
                                        $sav['charge']=($request->amount*$set->transfer_charge/100);
                                        $sav['sender_id']=Auth::guard('user')->user()->id;  
                                        $sav['temp']=$request->email;  
                                        $sav['status']=0; 
                                        Transfer::create($sav); 
                                        $audit['user_id']=Auth::guard('user')->user()->id;
                                        $audit['trx']=str_random(16);
                                        $audit['log']='Transfered '.$currency->symbol.$request->amount.' to '.$request->email;
                                        Audit::create($audit);    
                                        $content='Email:'.$user->email.', Date:'.Carbon::now().', DR Amt:'.$request->amount.',
                                        Bal:'.$user->balance.', Ref:'.$token.', Desc: Transfer'; 
                                        //Charges
                                        $charge['user_id']=$user->id;
                                        $charge['ref_id']=str_random(16);
                                        $charge['amount']=$request->amount*$set->transfer_charge/100;
                                        $charge['log']='Charges for transfer #' .$token;
                                        Charges::create($charge);
                                        if($set->email_notify==1){
                                            send_ntransferreceipt($token);
                                        }
                                        return redirect()->route('user.ownbank')->with('success', 'Transfer was successful, but user has to create account to confirm transaction');
                                    }else{
                                        $data['title']='Error Message';
                                        return view('user.merchant.error', $data)->withErrors('An Error Occured');
                                    }
                                }
                            }else{
                                return response()->json(['status'=>'0','response'=>'Account balance is insufficient'], 400);
                                //return back()->with('alert', 'Account balance is insufficient');
                            }
                        }else{
                            return response()->json(['status'=>'0','response'=>'You cant transfer money to the same account.'], 400);
                            //return back()->with('alert', 'You cant transfer money to the same account.');
                        }
                    
                    }else{
                            return response()->json(['status'=>'0','response'=>'Receiver not exists!'], 400);
                            //return back()->with('alert', 'You cant transfer money to the same account.');
                        }
                    
            }else{
                        return response()->json(['status'=>'0','response'=>'Prefix not matched!'], 400);
                        //return back()->with('alert', 'You cant transfer money to the same account.');
                    }
            }
            } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }    
        }   
    //End of Transfer Money   
    
    //Request Money
        public function request()
        {
            $data['title'] = "Request Money";
            $data['adminbank']=Adminbank::whereId(1)->first();
            $data['request']=Requests::whereuser_id(Auth::guard('user')->user()->id)->orWhere('Email', Auth::guard('user')->user()->email)->orderby('id', 'desc')->paginate(6);
            $data['sent']=Requests::whereStatus(1)->whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['pending']=Requests::whereStatus(0)->whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            $data['total']=Requests::whereuser_id(Auth::guard('user')->user()->id)->sum('amount');
            return view('user.transfer.request', $data);
        }

        public function submitrequest(Request $request)
        {
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $amount=$request->amount;
            $user=User::find(Auth::guard('user')->user()->id);
            $check=User::whereemail($request->email)->get();
            $to=User::whereemail($request->email)->first();
            $token=str_random(16);
            if($user->email!=$request->email){
                if(count($check)>0){
                    $sav['ref_id']=$token;
                    $sav['confirm']=str_random(8);
                    $sav['amount']=$request->amount;
                    $sav['charge']=($request->amount*$set->transfer_charge/100);
                    $sav['email']=$request->email;
                    $sav['user_id']=Auth::guard('user')->user()->id; 
                    Requests::create($sav);   
                    $audit['user_id']=Auth::guard('user')->user()->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Requested '.$currency->symbol.$request->amount.' from '.$request->email;
                    Audit::create($audit);
                    if($set->email_notify==1){
                        send_request($token);
                    }
                    return redirect()->route('user.request')->with('success', 'Request was sent successfully');
                }else{
                    return back()->with('alert', 'User not found.');
                }
            }else{
                return back()->with('alert', 'You cant request money from the same account.');
            }
        }
        public function Sendpay($id)
        {
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $trans=Requests::whereconfirm($id)->first();
            $sender=User::whereemail($trans->email)->first();
            $receiver=User::whereid($trans->user_id)->first();
            if($trans->status==0){
                if($sender->balance>$trans->amount || $sender->balance==$trans->amount){
                    $trans->status=1;
                    $trans->save();
                    $sender->balance=$sender->balance-$trans->amount;
                    $sender->save();        
                    $receiver->balance=$receiver->balance+$trans->amount-($trans->amount*$set->transfer_charge/100);
                    $receiver->save();
                    $charge['user_id']=$receiver->id;
                    $charge['ref_id']=str_random(16);
                    $charge['amount']=$trans->amount*$set->transfer_charge/100;
                    $charge['log']='Charges for request money #' .$trans->ref_id;
                    Charges::create($charge);
                    if($set->email_notify==1){
                        send_requestreceipt($trans->ref_id);
                    }
                }else{
                    return back()->with('alert', 'Please fund account, account is insufficient.');
                }
            }else{
                $data['title']='Error Message';
                return view('user.merchant.error', $data)->withErrors('Already Paid!!!');
            }
            return redirect()->route('user.request')->with('success', 'Transfer was successful');
        }
    //End of Request money     
    
    //Payment link
        public function sclinks()
        {
            $data['title'] = "Single Charge";
            $data['links']=Paymentlink::whereuser_id(Auth::guard('user')->user()->id)->wheretype(1)->latest()->paginate(6);
            return view('user.link.sc', $data);
        }         
        
        public function sclinkstrans($id)
        {
            $data['title'] = "Single Charge";
            $data['links']=Transactions::wherepayment_link($id)->latest()->get();
            return view('user.link.sc-trans', $data);
        }         
        public function dplinkstrans($id)
        {
            $data['title'] = "Donation";
            $data['links']=Transactions::wherepayment_link($id)->latest()->get();
            return view('user.link.dp-trans', $data);
        }   
        public function unsclinks($id)
        {
            $page=Paymentlink::find($id);
            $page->active=0;
            $page->save();
            return back()->with('success', 'Payment link has been disabled.');
        } 
        public function psclinks($id)
        {
            $page=Paymentlink::find($id);
            $page->active=1;
            $page->save();
            return back()->with('success', 'Payment link has been activated.');
        }   
        public function updatesclinks(Request $request)
        {
            $data=Paymentlink::whereId($request->id)->first();
            $data->amount = $request->amount;
            $data->description = $request->description;
            $data->redirect_link = $request->redirect_url;
            $data->name = $request->name;
            $data->save();
            return redirect()->route('user.sclinks')->with('success', 'Payment link was successfully updated');
        }  
        public function dplinks()
        {
            $data['title'] = "Donation Page";
            $data['links']=Paymentlink::whereuser_id(Auth::guard('user')->user()->id)->wheretype(2)->latest()->paginate(6);
            return view('user.link.dp', $data);
        }
        public function undplinks($id)
        {
            $page=Paymentlink::find($id);
            $page->active=0;
            $page->save();
            return back()->with('success', 'Payment link has been disabled.');
        } 
        public function pdplinks($id)
        {
            $page=Paymentlink::find($id);
            $page->active=1;
            $page->save();
            return back()->with('success', 'Payment link has been activated.');
        }
        public function updatedplinks(Request $request)
        {
            $data=Paymentlink::whereId($request->id)->first();
            $data->amount = $request->goal;
            $data->description = $request->description;
            $data->name = $request->name;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = 'donation'.time().'.'.$image->extension();
                $location = 'asset/images/' . $filename;
                Image::make($image)->save($location);
                $path = './asset/images/';
                File::delete($path.$data->image);
                $data->image=$filename;
            }
            $data->save();
            return redirect()->route('user.dplinks')->with('success', 'Payment link was successfully updated');
        }
        public function submitsinglecharge(Request $request)
        {
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $amount=$request->amount;
            $user=User::find(Auth::guard('user')->user()->id);
            $sav['ref_id']=str_random(16);
            $sav['type']=1;
            $sav['amount']=$request->amount;
            $sav['name']=$request->name;
            $sav['description']=$request->description;
            $sav['redirect_link']=$request->redirect_url;
            $sav['user_id']=Auth::guard('user')->user()->id; 
            Paymentlink::create($sav);   
            $audit['user_id']=Auth::guard('user')->user()->id;
            $audit['trx']=str_random(16);
            $audit['log']='Created Payment Link -  '.$request->name;
            Audit::create($audit);
            return redirect()->route('user.sclinks')->with('success', 'Link was successfully created');
                
        }        
        public function submitdonationpage(Request $request)
        {
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $amount=$request->amount;
            $user=User::find(Auth::guard('user')->user()->id);
            $sav['ref_id']=str_random(16);
            $sav['type']=2;
            $sav['amount']=$request->goal;
            $sav['name']=$request->name;
            $sav['description']=$request->description;
            $sav['user_id']=Auth::guard('user')->user()->id; 
            $image = $request->file('image');
            $filename = 'donation'.time().'.'.$image->extension();
            $location = 'asset/profile/' . $filename;
            Image::make($image)->save($location);
            $sav['image']=$filename;
            Paymentlink::create($sav);   
            $audit['user_id']=Auth::guard('user')->user()->id;
            $audit['trx']=str_random(16);
            $audit['log']='Created Donation Page -  '.$request->name;
            Audit::create($audit);
            return redirect()->route('user.dplinks')->with('success', 'Donation Page was successfully created');
                
        }
        public function Destroylink($id)
        {
            $link=Paymentlink::whereid($id)->first();
            $history=Transactions::wherepayment_link($id)->delete();
            if($link->type==2){
                $donation=Donations::wheredonation_id($id)->delete();
            }
            $data=$link->delete();
            if ($data) {
                return back()->with('success', 'Payment link was Successfully deleted!');
            } else {
                return back()->with('alert', 'Problem With Deleting Payment link');
            }
        }
        public function scviewlink($id)
        {
            $check=Paymentlink::whereref_id($id)->get();
            if(count($check)>0){
                $key=Paymentlink::whereref_id($id)->first();
                if($key->user->status==0){
                    if($key->status==0){
                        if($key->active==1){
                            $data['link']=$link=Paymentlink::whereref_id($id)->first();
                            $data['merchant']=$user=User::find($link->user_id);
                            $set=Settings::first();
                            $data['title']="Single Charge - ".$link->name;
                            return view('user.link.sc_view', $data);
                        }else{
                            $data['title']='Error Occured';
                            return view('user.merchant.error', $data)->withErrors('Single Charge page has been disabled');
                        }    
                    }else{
                        $data['title']='Error Occured';
                        return view('user.merchant.error', $data)->withErrors('Single Charge page has been suspended');
                    }
                }else{
                    $data['title']='Error Message';
                    return view('user.merchant.error', $data)->withErrors('An Error Occured');
                }
            }else{
                $data['title']='Error Message';
                return view('user.merchant.error', $data)->withErrors('Invalid payment link');
            }
        }        
        public function dpviewlink($id)
        {
            $check=Paymentlink::whereref_id($id)->get();
            if(count($check)>0){
                $key=Paymentlink::whereref_id($id)->first();
                if($key->user->status==0){
                    if($key->status==0){
                        if($key->active==1){
                            $data['link']=$link=Paymentlink::whereref_id($id)->first();
                            $data['donated']=Donations::wheredonation_id($key->id)->wherestatus(1)->sum('amount');
                            $data['dd']=Donations::wheredonation_id($key->id)->wherestatus(1)->get();
                            $data['paid']=Donations::wheredonation_id($key->id)->wherestatus(1)->paginate(4);
                            $data['merchant']=$user=User::find($link->user_id);
                            $set=Settings::first();
                            $data['title']="Donation - ".$link->name;
                            return view('user.link.dp_view', $data);
                        }else{
                            $data['title']='Error Occured';
                            return view('user.merchant.error', $data)->withErrors('Donation page has been disabled');
                        }                       
                    }else{
                        $data['title']='Error Occured';
                        return view('user.merchant.error', $data)->withErrors('Donation page has been suspended');
                    }
                }else{
                    $data['title']='Error Occured';
                    return view('user.merchant.error', $data)->withErrors('An Error Occured');
                }
            }else{
                $data['title']='Error Message';
                return view('user.merchant.error', $data)->withErrors('Invalid payment link');
            }
        } 
        public function Sendsingle(Request $request)
        {
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $link=Paymentlink::whereref_id($request->link)->first();
           
            $xtoken=str_random(16);
            $receiver=User::whereid($link->user_id)->first();
            if($request->type=='card'){
                $sav['ref_id']=$xtoken;
                $sav['type']=1;
                $sav['amount']=$request->amount;
                $sav['email']=$request->email;
                $sav['first_name']=$request->first_name;
                $sav['last_name']=$request->last_name;
                $sav['card_number']=$request->cardNumber;
                $sav['ip_address']=user_ip();
                $sav['receiver_id']=$link->user_id;
                $sav['payment_link']=$link->id;
                $sav['payment_type']='card';
                Transactions::create($sav);
                $gate = Gateway::find(103);
                $this->validate($request,
                [
                    'cardNumber' => 'required',
                    'cardM' => 'required',
                    'cardY' => 'required',
                    'cardCVC' => 'required',
                ]);
                $cc = $request->cardNumber;
                $cvc = $request->cardCVC;
                $m = $request->cardM;
                $y = $request->cardY;
                $cnts = $request->amount;

                Stripe::setApiKey($gate->val2);
                try {
                    $token = Token::create(array(
                        "card" => array(
                            "number" => "$cc",
                            "exp_month" => $m,
                            "exp_year" => $y,
                            "cvc" => "$cvc"
                        )
                    ));   
                    try {
                        $charge = Charge::create(array(
                            'card' => $token['id'],
                            'currency' => $currency->name,
                            'amount' => $cnts*100,
                            'description' => $set->site_name.' product buy',
                        ));
        
                        if ($charge['status'] == 'succeeded') {
                            $receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->single_charge/100));
                            $receiver->save();
                            //Audit
                            $audit['user_id']=$receiver->id;
                            $audit['trx']=str_random(16);
                            $audit['log']='Received payment for Payment Link' .$link->ref_id;
                            Audit::create($audit);
                            //Charges
                            $charges['user_id']=$receiver->id;
                            $charges['ref_id']=str_random(16);
                            $charges['amount']=$request->amount*$set->single_charge/100;
                            $charges['log']='Received payment for Payment Link #' .$link->ref_id;
                            Charges::create($charges);
                            //Change status to successful
                            $change=Transactions::whereref_id($xtoken)->first();
                            $change->status=1;
                            $change->charge=$request->amount*$set->single_charge/100;
                            $change->save(); 
                            //Notify users
                            if($set->email_notify==1){
                                send_paymentlinkreceipt($link->ref_id, 'card', $xtoken);
                            } 
                            //Redirect payment
                            if($link->redirect_link!=null){
                                return Redirect::away($link->redirect_link);
                            }else{
                                return back()->with('success', 'Payment was Successful.');
                            }
                        }
                    } catch (\Stripe\Exception\CardException $e) {
                        return back()->with('alert', $e->getMessage());
                    }
        
                } catch (\Stripe\Exception\CardException $e) {
                    return back()->with('alert', $e->getMessage());
                }
            }elseif($request->type=='account'){
                $validatedData=$request->validate([
                    'amount' => ['required'],
                ]);
                $user=User::find(Auth::guard('user')->user()->id);
                $sav['ref_id']=$xtoken;
                $sav['type']=1;
                $sav['amount']=$request->amount;
                $sav['sender_id']=$user->id;
                $sav['receiver_id']=$link->user_id;
                $sav['payment_link']=$link->id;
                $sav['payment_type']='account';
                $sav['ip_address']=user_ip();
                Transactions::create($sav);
                $sender=User::whereid($user->id)->first();
                if($sender->balance>$request->amount || $sender->balance==$request->amount){
                    $sender->balance=$sender->balance-$request->amount;
                    $sender->save();        
                    $receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->single_charge/100));
                    $receiver->save();
                    //Audit log
                    $audit['user_id']=Auth::guard('user')->user()->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Payment for '.$link->ref_id.' was successful';
                    Audit::create($audit);                
                    $audit['user_id']=$receiver->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Received payment for Payment Link' .$link->ref_id;
                    Audit::create($audit);
                    //Charges
                    $charge['user_id']=$receiver->id;
                    $charge['ref_id']=str_random(16);
                    $charge['amount']=$request->amount*$set->single_charge/100;
                    $charge['log']='Received payment for Payment Link #' .$link->ref_id;
                    Charges::create($charge);
                    //Change status to successful
                    $change=Transactions::whereref_id($xtoken)->first();
                    $change->status=1;
                    $change->charge=$request->amount*$set->single_charge/100;
                    $change->save(); 
                    //Notify users
                    if($set->email_notify==1){
                        send_paymentlinkreceipt($link->ref_id, 'account', $xtoken);
                    } 
                    //Redirect payment
                    if($link->redirect_link!=null){
                        return Redirect::away($link->redirect_link);
                    }else{
                        return redirect()->route('user.transactionssc')->with('success', 'Payment was successful');
                    }
                }else{
                    return back()->with('alert', 'Insufficient balance, please fund your account');
                }
            }
        }
        
        public function vCardSendsingle(Request $request)
        {
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $receiver = DB::table('users')->where('id',Session::get('vcard_user_id'))->first();
            //$link=DB::table('admin_payment_link')->where()->//Paymentlink::whereref_id($request->link)->first();
            $link = DB::table('admin_payment_link')->where('ref_id',$request->payment_link_ref_id)->first();

            $xtoken=str_random(16);
            //$receiver=User::whereid($link->user_id)->first();
            if($request->type=='card'){
                $sav['ref_id']=$xtoken;
                $sav['type']=1;
                $sav['amount']=$request->amount;
                $sav['email']=$request->email;
                $sav['first_name']=$request->first_name;
                $sav['last_name']=$request->last_name;
                $sav['card_number']=$request->cardNumber;
                $sav['ip_address']=user_ip();
                $sav['receiver_id']=$receiver->id;//$link->user_id;
                $sav['payment_link']= $link->id;
                $sav['payment_type']='card';
                Transactions::create($sav);
                $gate = Gateway::find(103);
                $this->validate($request,
                [
                    'cardNumber' => 'required',
                    'cardM' => 'required',
                    'cardY' => 'required',
                    'cardCVC' => 'required',
                ]);
                $cc = $request->cardNumber;
                $cvc = $request->cardCVC;
                $m = $request->cardM;
                $y = $request->cardY;
                $cnts = $request->amount;

                Stripe::setApiKey($gate->val2);
                try {
                    $token = Token::create(array(
                        "card" => array(
                            "number" => "$cc",
                            "exp_month" => $m,
                            "exp_year" => $y,
                            "cvc" => "$cvc"
                        )
                    ));   
                    try {
                        $charge = Charge::create(array(
                            'card' => $token['id'],
                            'currency' => $currency->name,
                            'amount' => $cnts*100,
                            'description' => $set->site_name.' product buy',
                        ));
        
                        if ($charge['status'] == 'succeeded') {
                            //$receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->single_charge/100));
                            //$receiver->save();
                            //Audit
                            $audit['user_id']=$receiver->id;
                            $audit['trx']=str_random(16);
                            $audit['log']='Received payment for Payment Link' .$request->payment_link_ref_id;
                            Audit::create($audit);
                            //Charges
                            $charges['user_id']=$receiver->id;
                            $charges['ref_id']=str_random(16);
                            $charges['amount']=$request->amount*$set->single_charge/100;
                            $charges['log']='Received payment for Payment Link #' .$request->payment_link_ref_id;
                            Charges::create($charges);
                            //Change status to successful
                            $change=Transactions::whereref_id($xtoken)->first();
                            $change->status=1;
                            $change->charge=$request->amount*$set->single_charge/100;
                            $change->save(); 
                            //Notify users
                            if($set->email_notify==1){
                                //send_paymentlinkreceipt($request->payment_link_ref_id, 'card', $xtoken);
                            } 
                            $planData = DB::table('virtual_cards_plan')->where('id',Session::get('plan_id'))->first();
                            $orderCreate = array(
                                'user_id'=>Session::get('vcard_user_id'),
                                'order_ref_no'=>$xtoken,
                                'product__type_id'=>Session::get('product_type_id'),
                                'design_id'=>Session::get('design_id'),
                                 'plan_id'=>Session::get('plan_id'),
                                 'quantity'=>$planData->plan_quantity,
                                 'remain_qty'=>$planData->plan_quantity,
                                'amount'=>$request->amount,
                                'status'=>1,
                                'created_at'=>date('Y-m-d H:i:s')
                                );
                            $orderCreated = DB::table('virtual_cards_orders')->insert($orderCreate); 
                            
                            $total_limit = number_format($receiver->cvard_limit+$planData->plan_quantity);
                            DB::table('users')->where('id',Session::get('vcard_user_id'))->update(['cvard_limit'=>$total_limit,'updated_at'=>date('Y-m-d H:i:s')]);
                            //Redirect payment
                            /*if($link->redirect_link!=null){
                                return Redirect::away($link->redirect_link);
                            }else{
                                return back()->with('success', 'Payment was Successful!!!');
                            }
                            */
                            //https://vcard.greentechfin.com/user/vcard_orders
                            $text = "You have successfully purchased ".$planData->plan_name." Plan with amount $".$request->amount.", now your virtual card creation limit is ".$total_limit;
                            send_email($request->email, $request->first_name .$request->last_name, 'Virtual Card Plan Purchased', $text);
                            send_email($receiver->email, $receiver->first_name .$receiver->last_name, 'Virtual Card Plan Purchased', $text);
                             return redirect('user/vcard_orders')->with('success', 'Payment was Successful.');
                        }
                    } catch (\Stripe\Exception\CardException $e) {
                        return back()->with('alert', $e->getMessage());
                    }
        
                } catch (\Stripe\Exception\CardException $e) {
                    return back()->with('alert', $e->getMessage());
                }
            } elseif($request->type=='paypal'){
                
                $userDetails = DB::table('users')->where('id',Auth::id())->first();
                $sav['ref_id']=$xtoken;
                $sav['type']=2;
                $sav['amount']=$request->paypal_amount;
                $sav['email']=$receiver->email;//$request->email;
                $sav['first_name']=$receiver->first_name;//$request->first_name;
                $sav['last_name']=$receiver->last_name;
               // $sav['card_number']=$request->cardNumber;
                $sav['ip_address']=user_ip();
                $sav['receiver_id']=$receiver->id;//$link->user_id;
                $sav['payment_link']= $link->id;
                $sav['payment_type']='paypal';
                //$sav['paypal_amount']=$request->paypal_amount;
                $sav['paypal_status']=$request->paypal_status;
                $sav['paypal_email']=$request->paypal_email;
                $sav['paypal_trx_id']=$request->paypal_trx_id;
                Transactions::create($sav);
                
                        
                //$receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->single_charge/100));
                //$receiver->save();
                //Audit
                $audit['user_id']=$receiver->id;
                $audit['trx']=str_random(16);
                $audit['log']='Received payment for Payment Link' .$request->payment_link_ref_id;
                Audit::create($audit);
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
                } 
                $planData = DB::table('virtual_cards_plan')->where('id',Session::get('plan_id'))->first();
                $orderCreate = array(
                    'user_id'=>Session::get('vcard_user_id'),
                    'order_ref_no'=>$xtoken,
                    'product__type_id'=>Session::get('product_type_id'),
                    'design_id'=>Session::get('design_id'),
                     'plan_id'=>Session::get('plan_id'),
                     'quantity'=>$planData->plan_quantity,
                     'remain_qty'=>$planData->plan_quantity,
                    'amount'=>$request->paypal_amount,
                    'status'=>1,
                    'created_at'=>date('Y-m-d H:i:s')
                    );
                $orderCreated = DB::table('virtual_cards_orders')->insert($orderCreate); 
                
                $total_limit = number_format($receiver->cvard_limit+$planData->plan_quantity);
                DB::table('users')->where('id',Session::get('vcard_user_id'))->update(['cvard_limit'=>$total_limit,'updated_at'=>date('Y-m-d H:i:s')]);
                //Redirect payment
                /*if($link->redirect_link!=null){
                    return Redirect::away($link->redirect_link);
                }else{
                    return back()->with('success', 'Payment was Successful!!!');
                }
                */
                //https://vcard.greentechfin.com/user/vcard_orders
                $text = "You have successfully purchased ".$planData->plan_name." Plan with amount $".$request->paypal_amount.", now your virtual card creation limit is ".$total_limit;
                send_email($receiver->email, $receiver->first_name .$receiver->last_name, 'Virtual Card Plan Purchased', $text);
                 return redirect('user/vcard_orders')->with('success', 'Payment was Successful');
        
            } elseif($request->type=='account'){
                $validatedData=$request->validate([
                    'amount' => ['required'],
                ]);
                $user=User::find(Auth::guard('user')->user()->id);
                $sav['ref_id']=$xtoken;
                $sav['type']=1;
                $sav['amount']=$request->amount;
                $sav['sender_id']=$user->id;
                $sav['receiver_id']=$link->user_id;
                $sav['payment_link']=$link->id;
                $sav['payment_type']='account';
                $sav['ip_address']=user_ip();
                Transactions::create($sav);
                $sender=User::whereid($user->id)->first();
                if($sender->balance>$request->amount || $sender->balance==$request->amount){
                    $sender->balance=$sender->balance-$request->amount;
                    $sender->save();        
                    $receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->single_charge/100));
                    $receiver->save();
                    //Audit log
                    $audit['user_id']=Auth::guard('user')->user()->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Payment for '.$link->ref_id.' was successful';
                    Audit::create($audit);                
                    $audit['user_id']=$receiver->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Received payment for Payment Link' .$link->ref_id;
                    Audit::create($audit);
                    //Charges
                    $charge['user_id']=$receiver->id;
                    $charge['ref_id']=str_random(16);
                    $charge['amount']=$request->amount*$set->single_charge/100;
                    $charge['log']='Received payment for Payment Link #' .$link->ref_id;
                    Charges::create($charge);
                    //Change status to successful
                    $change=Transactions::whereref_id($xtoken)->first();
                    $change->status=1;
                    $change->charge=$request->amount*$set->single_charge/100;
                    $change->save(); 
                    //Notify users
                    if($set->email_notify==1){
                        send_paymentlinkreceipt($link->ref_id, 'account', $xtoken);
                    } 
                    //Redirect payment
                    if($link->redirect_link!=null){
                        return Redirect::away($link->redirect_link);
                    }else{
                        return redirect()->route('user.transactionssc')->with('success', 'Payment was successful');
                    }
                }else{
                    return back()->with('alert', 'Insufficient balance, please fund your account');
                }
            }
        }
        
        public function Senddonation(Request $request)
        {
            $set=Settings::first();
            $user=User::find(Auth::guard('user')->user()->id);
            $currency=Currency::whereStatus(1)->first();
            $link=Paymentlink::whereref_id($request->link)->first();
            $receiver=User::whereid($link->user_id)->first();
            $xtoken=str_random(16);
            $token2=str_random(16);
            $donated=Donations::wheredonation_id($link->id)->wherestatus(1)->sum('amount');
            $check=$link->amount-$donated;
            if($request->type=='card'){
                if($check>$request->amount || $check==$request->amount){
                    $sav['ref_id']=$xtoken;
                    $sav['type']=1;
                    $sav['amount']=$request->amount;
                    $sav['email']=$request->email;
                    $sav['first_name']=$request->first_name;
                    $sav['last_name']=$request->last_name;
                    $sav['card_number']=$request->cardNumber;
                    $sav['payment_type']='card';
                    $sav['ip_address']=user_ip();
                    $sav['receiver_id']=$link->user_id;
                    $sav['payment_link']=$link->id;
                    Transactions::create($sav);
                    //Save Donation
                    $don['amount']=$request->amount;
                    $don['status']=0;
                    $don['anonymous']=$request->status;
                    $don['ref_id']=$xtoken;
                    $don['donation_id']=$link->id;
                    Donations::create($don);
                    $gate = Gateway::find(103);
                    $this->validate($request,
                    [
                        'cardNumber' => 'required',
                        'cardM' => 'required',
                        'cardY' => 'required',
                        'cardCVC' => 'required',
                    ]);
                    $cc = $request->cardNumber;
                    $cvc = $request->cardCVC;
                    $m = $request->cardM;
                    $y = $request->cardY;
                    $cnts = $request->amount;

                    Stripe::setApiKey($gate->val2);
                    try {
                        $token = Token::create(array(
                            "card" => array(
                                "number" => "$cc",
                                "exp_month" => $m,
                                "exp_year" => $y,
                                "cvc" => "$cvc"
                            )
                        ));   
                        try {
                            $charge = Charge::create(array(
                                'card' => $token['id'],
                                'currency' => $currency->name,
                                'amount' => $cnts*100,
                                'description' => $set->site_name.' product buy',
                            ));
            
                            if ($charge['status'] == 'succeeded') {
                                $receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->donation_charge/100));
                                $receiver->transfer_activation = 1;
                                $receiver->save();
                                //Audit
                                $audit['user_id']=$receiver->id;
                                $audit['trx']=str_random(16);
                                $audit['log']='Received Donation for Payment Link' .$link->ref_id;
                                Audit::create($audit);
                                //Charges
                                $charges['user_id']=$receiver->id;
                                $charges['ref_id']=str_random(16);
                                $charges['amount']=$request->amount*$set->donation_charge/100;
                                $charges['log']='Received Donation for Payment Link' .$link->ref_id;
                                Charges::create($charges);
                                //Change status to successful
                                $changed=Transactions::whereref_id($xtoken)->first();
                                $changed->status=1;
                                $changed->charge=$request->amount*$set->donation_charge/100;
                                $changed->save();                     
                                $changex=Donations::whereref_id($xtoken)->first();
                                $changex->status=1;
                                $changex->save(); 
                                //Notify users
                                if($set->email_notify==1){
                                    send_paymentlinkreceipt($link->ref_id, 'card', $xtoken);
                                } 
                                //Redirect payment
                                if($link->redirect_link!=null){
                                    return Redirect::away($link->redirect_link);
                                }else{
                                    return back()->with('success', 'Payment was Successful.');
                                }
                            }
                        } catch (\Stripe\Exception\CardException $e) {
                            return back()->with('alert', $e->getMessage());
                        }
            
                    } catch (\Stripe\Exception\CardException $e) {
                        return back()->with('alert', $e->getMessage());
                    }
                }else{
                    return back()->with('alert', 'Amount exceeds donation requirement');
                }
            }
            elseif($request->type=='account'){
                $validatedData=$request->validate([
                    'amount' => ['required'],
                    'status' => ['required'],
                ]);
                $sav['ref_id']=$xtoken;
                $sav['type']=2;
                $sav['amount']=$request->amount;
                $sav['sender_id']=$user->id;
                $sav['receiver_id']=$link->user_id;
                $sav['payment_link']=$link->id;
                $sav['payment_type']='account';
                $sav['ip_address']=user_ip();
                Transactions::create($sav);
                //Save Donation
                $don['user_id']=$user->id;
                $don['amount']=$request->amount;
                $don['status']=0;
                $don['anonymous']=$request->status;
                $don['ref_id']=$xtoken;
                $don['donation_id']=$link->id;
                Donations::create($don);
                $sender=User::whereid($user->id)->first();
                if($check>$request->amount || $check==$request->amount){
                    if($sender->balance>$request->amount || $sender->balance==$request->amount){
                        $sender->balance=$sender->balance-$request->amount;
                        $sender->save();        
                        $receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->donation_charge/100));
                        $receiver->save();
                        //Audit log
                        $audit['user_id']=Auth::guard('user')->user()->id;
                        $audit['trx']=str_random(16);
                        $audit['log']='Donation for '.$link->ref_id.' was successful';
                        Audit::create($audit);                
                        $audit['user_id']=$receiver->id;
                        $audit['trx']=str_random(16);
                        $audit['log']='Received Donation for Payment Link' .$link->ref_id;
                        Audit::create($audit);
                        //Charges
                        $charges['user_id']=$receiver->id;
                        $charges['ref_id']=str_random(16);
                        $charges['amount']=$request->amount*$set->donation_charge/100;
                        $charges['log']='Received Donation for Payment Link' .$link->ref_id;
                        Charges::create($charges);
                        //Change status to successful
                        $changed=Transactions::whereref_id($xtoken)->first();
                        $changed->status=1;
                        $changed->charge=$request->amount*$set->donation_charge/100;
                        $changed->save();                     
                        $changex=Donations::whereref_id($xtoken)->first();
                        $changex->status=1;
                        $changex->save(); 
                        //Notify users
                        if($set->email_notify==1){
                            send_paymentlinkreceipt($link->ref_id, 'account', $xtoken);
                        } 
                        return redirect()->route('user.transactionsd')->with('success', 'Donation was successful');
                    }else{
                        return back()->with('alert', 'Insufficient balance, please fund your account');
                    }
                }else{
                    return back()->with('alert', 'Amount exceeds donation requirement');
                }
            }
        }
    //End of Payment link      

    //Settings
        public function profile()
        {
            
            // 26-11-2020
                $userseen=User::find(Auth::guard('user')->user()->id);
                $userseen->user_seen=1;
                $userseen->save();
                // 26-11-2020
        
        
        
            $data['title'] = "Profile";
            $g=new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
            $secret=$g->generateSecret();
            $set=Settings::first();
            $user = User::find(Auth::guard('user')->user()->id);
            $site=$set->site_name;
            $data['secret']=$secret;
            $data['image']=\Sonata\GoogleAuthenticator\GoogleQrUrl::generate($user->email, $secret, $site);
            return view('user.profile.index', $data);
        }

            public function logout()
        {  
            $user = DB::table('users')->where('id',Auth::id())->first();//User::findOrFail(Auth::id());
              //die('SK1');
            //$user->fa_expiring = date('Y-m-d H:i:s');//Carbon::now()->subMinutes(30);
            //$user->save();
           //$result = DB::table('users')->where('id',Auth::id())->update(['last_login_ip'=>$_SERVER['REMOTE_ADDR']]);
           //print_r($result);die;
            //session()->forget('oldLink');
            Auth::guard('user')->logout();
            session()->flash('message', 'Just Logged Out!');
            return redirect('/login');
        }
        
        public function submitPassword(Request $request)
        {
            $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                    'password' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
            if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
            $user = User::whereid($request->user_id)->first();
            if($user->login_token == $request->header('auth-token'))
            { 
            if($user)
            {
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(['status'=>'1','response'=>'Password Changed Successfully.'], 200);
                //return back()->with('success', 'Password Changed Successfully.');
            } else {
                return response()->json(['status'=>'0','response'=>'User not exists!'], 400);
            }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }
        }
        
         public function submitPasswordByPhone(Request $request)
        {
            $validator=Validator::make($request->all(), [
                    'prefix' => 'required',
                    'phone' => 'required',
                    'password' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
            $checkUser = DB::table('users')->where(['prefix'=>$request->prefix,'phone'=>$request->phone])->first();//User::whereid($request->user_id)->first();
            if(!empty($checkUser))
            {
                $user = User::whereid($checkUser->id)->first();
                if($user)
                {
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return response()->json(['status'=>'1','response'=>'Password Changed Successfully.'], 200);
                    //return back()->with('success', 'Password Changed Successfully.');
                } else {
                    return response()->json(['status'=>'0','response'=>'User not exists!'], 400);
                }
            } else {
                return response()->json(['status'=>'0','response'=>'User not exists!'], 400);
            }

        }
        
        public function avatar(Request $request)
        {
            $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                    'image' => 'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
            if (empty($request->header('auth-token'))) {
            return response()->json(['status'=>'0','response'=>'Auth token missing!'], 400);
            }
            $user = User::findOrFail($request->user_id);
            if($user->login_token == $request->header('auth-token'))
            { 
             $location = 'asset/profile/';
             $uploadResponse = $this->createImageFromBase64($request->image,$location);
            
            
            if ($uploadResponse && $user) {
                
                //Image::make($image)->save($location);
                $user->image=$uploadResponse;
                $user->save();
                 return response()->json(['status'=>'1','response'=>'Image changed successfully.'], 200);
                //return redirect('user/profile#section3')->with('success', 'Avatar Updated Successfully.');
            }else{
                return response()->json(['status'=>'0','response'=>'An error occured, try again.'], 400);
                //return back()->with('error', 'An error occured, try again.');
            }
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }
        }  
        
           // Create Image From Base64
        public function createImageFromBase64($image,$imagedir) {
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
                
                //return redirect('user/profile#section3')->with('success', 'Avatar Updated Successfully.');
                if(file_put_contents($file, $datas))
                {
                    return $fileName;
                } else {
                    return false;
                }
                
            } else {
                return "";
            }
        }
        
        public function standverify(Request $request)
           {
            $user = User::findOrFail(Auth::guard('user')->user()->id);
            
            // echo "<pre>";
            // print_r($request->all());
            // die;
            if ($request->hasFile('photo_id')) {
               
                 $validator=Validator::make($request->all(), [
                    'photo_id' => 'mimes:pdf,png,jpeg,jpg|max:10240'
                ]);
                if ($validator->fails()) {
                    // return redirect()->back()->withErrors($validator)->withInput();
                    return back()->with('alert', 'Image size or format not supported.');
                }
                else{
                    
                    $photo_id = $request->file('photo_id');
                    $filename2 = time() . rand(1,99999) . '_' . $user->username . $photo_id->extension();
                    $location = 'asset/profile/' . $filename2;
                    if ($user->photo_id != 'user-default.png') {
                        $path = './asset/profile/';
                        $link = $path . $user->$photo_id;
                        if (file_exists($link)) {
                            @unlink($link);
                        }
                    }
                    $photo_id->move('./asset/profile/', $filename2);
                    if(!empty($request->verify_ssn))
                    {
                        $user->verify_ssn=$request->verify_ssn;
                    }
                    if(!empty($request->verify_ein))
                    {
                        $user->verify_ein=$request->verify_ein;
                    }
                    $user->photo_id=$filename2;
                    $user->save();
                    return redirect('user/profile#section4')->with('success', 'Document Upload was successful.');
                }
            }else{
                return back()->with('alert', 'An error occured, try again.');
            }
        }
        
            public function kyc(Request $request)
        {
            $user = User::findOrFail(Auth::guard('user')->user()->id);
            
            // echo "<pre>";
            // print_r($request->all());
            // die;
            if ($request->hasFile('image')) {
               
                 $validator=Validator::make($request->all(), [
                    'image' => 'required|mimes:pdf,png,jpeg,jpg,gif|max:10240',
                    'address_id' => 'required|mimes:pdf,png,jpeg,jpg,gif|max:10240',
                ]);
                if ($validator->fails()) {
                    // return redirect()->back()->withErrors($validator)->withInput();
                    return back()->with('alert', 'Image size or format not supported.');
                }
                else{
                    // $image = $request->file('image');
                    // $filename = time() . '_' . $user->username . $image->extension();
                    // $location = 'asset/profile/' . $filename;
                    // if ($user->image != 'user-default.png') {
                    //     $path = './asset/profile/';
                    //     $link = $path . $user->kyc_link;
                    //     if (file_exists($link)) {
                    //         @unlink($link);
                    //     }
                    // }
                    // Image::make($image)->save($location);
                    
                    $image = $request->file('image');
                    $filename = time() . rand(1,99999) . '_' . $user->username . $image->extension();
                    $location = 'asset/profile/' . $filename;
                    if ($user->image != 'user-default.png') {
                        $path = './asset/profile/';
                        $link = $path . $user->kyc_link;
                        if (file_exists($link)) {
                            @unlink($link);
                        }
                    }
                    $image->move('./asset/profile/', $filename);
                    
                    $address_id = $request->file('address_id');
                    $filename2 = time() . rand(1,99999) . '_' . $user->username . $address_id->extension();
                    $location = 'asset/profile/' . $filename2;
                    if ($user->address_id != 'user-default.png') {
                        $path = './asset/profile/';
                        $link = $path . $user->$address_id;
                        if (file_exists($link)) {
                            @unlink($link);
                        }
                    }
                    $address_id->move('./asset/profile/', $filename2);
                    
                    // $image = $request->file('image');
                    // $token=str_random(10);
                    // $name = time() . '_' . $user->username . $image->extension();
                    // $image->move('./asset/profile/', $name);
                   
                    
                    
                    $user->kyc_link=$filename;
                    $user->address_id=$filename2;
                    $user->kyc_status=0;
                    $user->seen=0;
                    $user->save();
                    return back()->with('success', 'Thank you for upgrading your Business Account. It is under preview, you will be notified once your account has been approved.');
                }
            }else{
                return back()->with('alert', 'An error occured, try again.');
            }
        }
            public function account(Request $request)
        {
            $user = User::findOrFail(Auth::guard('user')->user()->id);
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->business_name=$request->business_name;
            $user->office_address=$request->office_address;
            
            $user->address1=$request->address1;
            $user->address2=$request->address2;
            $user->city=$request->city;
            $user->state=$request->state;
            $user->country=$request->country;
            $user->zip_code=$request->zip_code;
            
            $user->website_link=$request->website_link;
            $user->developer=$request->developer;
            // 9-11-202
             if($request->prefix)
            {
                $getdtls = DB::table('countries')->where('id',$request->prefix)->first();
            }
            $user->prefix = $getdtls->calling_code;
            $user->phone_iso = $getdtls->iso_code;
            $user->phone = $request->phone;
            // 9-11-2020
            
            
            $user->save();
            $audit['user_id']=Auth::guard('user')->user()->id;
            $audit['trx']=str_random(16);
            $audit['log']='Updated account details';
            Audit::create($audit);       
            if($user->email!=$request->email){
                $check=User::whereEmail($request->email)->get();
                if(count($check)<1){
                    $user->email_verify=0;
                    $user->email=$request->email;
                    $user->save();
                }else{
                    return back()->with('alert', 'Email already in use.');
                }
            }            
            return redirect('user/profile#section2')->with('success', 'Profile Updated Successfully.');
        }        
        
        public function social(Request $request)
        {   /*
            $data=User::findOrFail(Auth::guard('user')->user()->id);
            $in = Input::except('_token');
            $data->fill($in)->save();             
            $data->save();
            */
            $update = array(
                'updated_at'=>date('Y-m-d H:i:s')
                );
                 
            if(!empty($request->facebook))
            {
                $update['facebook'] = $request->facebook;
            }
             
            if(!empty($request->twitter))
            {
                $update['twitter'] = $request->twitter;
            }
            if(!empty($request->instagram))
            {
                $update['instagram'] = $request->instagram;
            }
            if(!empty($request->linkedin))
            {
                $update['linkedin'] = $request->linkedin;
            }
            if(!empty($request->youtube))
            {
                $update['youtube'] = $request->youtube;
            }
            $update = DB::table('users')->where('id',Auth::id())->update($update);
            if($update)
            {
                return redirect('user/profile#section5')->with('success', 'Internet accounts Updated Successfully.');
            } else {
                return back()->with('alert', 'Something went wrong!');
            }
            
        }
        public function submit2fa(Request $request)
        {
            $user = User::findOrFail(Auth::guard('user')->user()->id);
            $g=new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
            $secret=$request->vv;
            $set=Settings::first();
            if ($request->type==0) {
                $check=$g->checkcode($user->googlefa_secret, $request->code, 3);
                if($check){
                    $user->fa_status = 0;
                    $user->googlefa_secret = null;
                    $user->save();
                    $audit['user_id']=Auth::guard('user')->guard('user')->user()->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Deactivated 2fa';
                    Audit::create($audit);
                    if($set->email_notify==1){
                        send_email($user->email, $user->username, 'Two Factor Security Disabled', ' 2FA security on your account was just disabled, contact us immediately if this was not done by you.');
                    }
                    return back()->with('success', '2fa disabled.');
                }else{
                    return back()->with('alert', 'Invalid code.');
                }
            }else{
                $check=$g->checkcode($secret, $request->code, 3);
                if($check){
                    $user->fa_status = 1;
                    $user->googlefa_secret = $request->vv;
                    $user->save();
                    $audit['user_id']=Auth::guard('user')->guard('user')->user()->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Activated 2fa';
                    Audit::create($audit);
                    if($set->email_notify==1){
                        send_email($user->email, $user->username, 'Two Factor Security Enabled', ' 2FA security on your account was just enabled, contact us immediately if this was not done by you.');
                    }
                    return back()->with('success', '2fa enabled.');
                }else{
                    return back()->with('alert', 'Invalid code.');
                }
            }
        }
    //End of Settings

    //Bank functions 
        public function bank()
        {
            $data['title']='Manage bank accounts';
            $data['bank']=Bank::whereUser_id(Auth::guard('user')->user()->id)->orderBy('id', 'DESC')->paginate(4);
            return view('user.bank.index', $data);
        }    
        public function nobank()
        {
            $data['title']='Add Default Bank Account';
            return view('user.bank.nobank', $data);
        }
        public function Destroybank($id)
        {
            $data = Bank::findOrFail($id);
            if($data->status==1){
                return back()->with('alert', 'Default account cannot be deleted');
            }else{
                $res =  $data->delete();
                if ($res) {
                    return back()->with('success', 'Bank account was Successfully deleted!');
                } else {
                    return back()->with('alert', 'Problem With Deleting Request');
                }
            }
        }    
        public function Defaultbank($id)
        {
            $all = Bank::all();
            foreach($all as $val){
                $val->status=0;
                $val->save();
            }
            $data = Bank::findOrFail($id);
            $data->status=1;
            $res =  $data->save();
            if ($res) {
                return back()->with('success', 'Bank account was Successfully Updated!');
            } else {
                return back()->with('alert', 'Problem With Request');
            }
        } 
        public function Updatebank(Request $request)
        {
            $bank=Bank::whereId($request->id)->first();
            $bank->name=$request->name;
            $bank->acct_no=$request->acct_no;
            $bank->acct_name=$request->acct_name;
            $bank->swift=$request->swift;
            $bank->save();
            return back()->with('success', 'Bank details was successfully updated');
        }
        public function Createbank(Request $request)
        {
            $data['name']=$request->name;
            $data['acct_no']=$request->acct_no;
            $data['acct_name']=$request->acct_name;
            $data['swift']=$request->swift;
            $data['user_id']=Auth::guard('user')->user()->id;
            $all = Bank::whereuser_id(Auth::guard('user')->user()->id)->wherestatus(1)->get();
            if(count($all)<1){
                $data['status']=1; 
            }
            Bank::create($data);
            // return redirect()->route('user.bank')->with('success', 'Bank account was successfully added.');
            
            // return redirect()->route('user.product')->with('error_code', 5);
            return redirect()->route('user.profile')->with('success', 'Account was successfully created.');
        } 
    //End of bank functions

    //Charges
        public function charges()
        {
            $data['title']='Charges';
            $data['charges']=Charges::whereuser_id(Auth::guard('user')->user()->id)->latest()->get();
            return view('user.profile.charges', $data);
        }
    //End of Charges   
    
    //Plans & Subscription
        public function plans()
        {
            $data['title']='Plans';
            $data['plans']=Plans::whereuser_id(Auth::guard('user')->user()->id)->get();
            return view('user.plans.index', $data);
        }
        public function unplan($id)
        {
            $page=Plans::find($id);
            $active=Subscribers::whereplan_id($page->id)->where('expiring_date', '>', Carbon::now())->count();
            if($active>0){
                return back()->with('alert', 'You already have active subscribers.');
            }else{
                $page->active=0;
                $page->save();
                return back()->with('success', 'Plan has been disabled.');
            }
        } 
        public function pplan($id)
        {
            $page=Plans::find($id);
            $page->active=1;
            $page->save();
            return back()->with('success', 'Plan link has been activated.');
        }  
        public function submitplan(Request $request)
        {
            $sav['ref_id']=str_random(16);
            $sav['amount']=$request->amount;
            $sav['name']=$request->name;
            $sav['times']=$request->times;
            $sav['intervals']=$request->interval;
            $sav['user_id']=Auth::guard('user')->user()->id; 
            Plans::create($sav);   
            $audit['user_id']=Auth::guard('user')->user()->id;
            $audit['trx']=str_random(16);
            $audit['log']='Created Plan -  '.$request->name;
            Audit::create($audit);
            return redirect()->route('user.plan')->with('success', 'Plan was successfully created');
                
        }        
        public function updateplan(Request $request)
        {
            $plan=Plans::whereId($request->plan_id)->first();
            $active=Subscribers::whereplan_id($plan->id)->where('expiring_date', '>', Carbon::now())->count();
            if($active<1){
                $plan->amount=$request->amount;
                $plan->intervals=$request->interval;
            }
            $plan->name=$request->name;
            $plan->save();
            return back()->with('success', 'Successfully updated');
                
        }        
        public function submitplancharge(Request $request)
        {
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $amount=$request->amount;
            $user=User::find(Auth::guard('user')->user()->id);
            $check=Subscribers::whereuser_id($user->id)->whereplan_id($request->link)->get();
            $key=Subscribers::whereuser_id($user->id)->whereplan_id($request->link)->first();
            $link=Plans::whereid($request->link)->first();
            $xtoken=str_random(16);
            if(count($check)>0){
                if($key->expiring_date>Carbon::now()){
                    return back()->with('alert', 'You already have an active subscription');
                }else{
                    $receiver=User::whereid($link->user_id)->first();
                    if($user->balance>$request->amount || $user->balance==$request->amount){
                        $user->balance=$user->balance-$request->amount;
                        $user->save();        
                        $receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->subscription_charge/100));
                        $receiver->save();
                        //Audit log
                        $audit['user_id']=$user->id;
                        $audit['trx']=str_random(16);
                        $audit['log']='Payment for subscription #'.$link->ref_id.' - '.$link->name.' was successful';
                        Audit::create($audit);                
                        $audit['user_id']=$receiver->id;
                        $audit['trx']=str_random(16);
                        $audit['log']='Received payment for subscription #'.$link->ref_id.' - '.$link->name.' was successful';
                        Audit::create($audit);
                        //Charges
                        $charge['user_id']=$receiver->id;
                        $charge['ref_id']=str_random(16);
                        $charge['amount']=$request->amount*$set->subscription_charge/100;
                        $charge['log']='Received payment for subscription #'.$link->ref_id.' - '.$link->name.' was successful';
                        Charges::create($charge);
                        //Change status to successful
                        $change=Subscribers::whereuser_id($user->id)->whereplan_id($request->link)->first();
                        $change->status=$request->status;
                        $change->charge=$request->amount*$set->subscription_charge/100;
                        $dt = Carbon::create($change->expiring_date);
                        $dt->add($change->plan['intervals']);   
                        $change->expiring_date=$dt;
                        if($change->times!=0){
                            $change->times=$change->times-1;
                        }
                        $change->save(); 
                        //Notify users
                        if($set->email_notify==1){
                            new_subscription($link->ref_id, 'account', $xtoken);
                        } 
                        return redirect()->route('user.sub')->with('success', 'Payment was successful');
                    }else{
                        return back()->with('alert', 'Insufficient balance, please fund your account');
                    }
                }
            }else{
                $receiver=User::whereid($link->user_id)->first();
                if($user->balance>$request->amount || $user->balance==$request->amount){
                    $user->balance=$user->balance-$request->amount;
                    $user->save();        
                    $receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->subscription_charge/100));
                    $receiver->save();
                    //Audit log
                    $audit['user_id']=$user->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Payment for subscription #'.$link->ref_id.' - '.$link->name.' was successful';
                    Audit::create($audit);                
                    $audit['user_id']=$receiver->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Received payment for subscription #'.$link->ref_id.' - '.$link->name.' was successful';
                    Audit::create($audit);
                    //Charges
                    $charge['user_id']=$receiver->id;
                    $charge['ref_id']=str_random(16);
                    $charge['amount']=$request->amount*$set->subscription_charge/100;
                    $charge['log']='Received payment for subscription #'.$link->ref_id.' - '.$link->name.' was successful';
                    Charges::create($charge);
                    //Register subscription
                    $dt = Carbon::now();
                    $dt->add($link->intervals);  
                    $sav['ref_id']=$xtoken;
                    $sav['charge']=$request->amount*$set->subscription_charge/100; 
                    $sav['amount']=$request->amount;
                    $sav['user_id']=$user->id;
                    $sav['plan_id']=$link->id;
                    $sav['expiring_date']=$dt;
                    $sav['status']=$request->status;
                    $sav['times']=$link->times;
                    Subscribers::create($sav);
                    //Notify users
                    if($set->email_notify==1){
                        new_subscription($link->ref_id, 'account', $xtoken);
                    } 
                    return redirect()->route('user.sub')->with('success', 'Payment was successful');
                }else{
                    return back()->with('alert', 'Insufficient balance, please fund your account');
                }
            }  
        } 
        public function plansub($id)
        {
            $data['plan']=$plan=Plans::whereref_id($id)->first();
            $data['sub']=Subscribers::whereplan_id($plan->id)->latest()->get();
            $data['title']=$plan->ref_id;
            return view('user.plans.subscribers', $data);
        }        
        public function subscriptions()
        {
            $data['sub']=Subscribers::whereuser_id(Auth::guard('user')->user()->id)->latest()->get();
            $data['title']='Subscriptions';
            return view('user.plans.subscription', $data);
        }
        public function subviewlink($id)
        {
            $check=Plans::whereref_id($id)->get();
            if(count($check)>0){
                $key=Plans::whereref_id($id)->first();
                if($key->user->status==0){
                    if($key->status==0){
                        if($key->active==1){
                            $data['link']=$link=Plans::whereref_id($id)->first();
                            $data['merchant']=$user=User::find($link->user_id);
                            $set=Settings::first();
                            $data['title']="Plan - ".$link->name;
                            return view('user.plans.sub_view', $data);
                        }else{
                            $data['title']='Error Occured';
                            return view('user.merchant.error', $data)->withErrors('Plan has been disabled');
                        }    
                    }else{
                        $data['title']='Error Occured';
                        return view('user.merchant.error', $data)->withErrors('Plan has been suspended');
                    }
                }else{
                    $data['title']='Error Message';
                    return view('user.merchant.error', $data)->withErrors('An Error Occured');
                }
            }else{
                $data['title']='Error Message';
                return view('user.merchant.error', $data)->withErrors('Invalid payment link');
            }
        }
    //End of Plans
    
    //Transaction Logs
        public function transactionssc()
        {
            $data['title']='Single Charge';
            $user=Auth::guard('user')->user()->id;
            $data['single']=Transactions::wheresender_id($user)->wheretype(1)->orWhere('receiver_id', $user)->wheretype(1)->latest()->get();
            return view('user.transactions.single', $data);
        }
        public function transactionsd()
        {
            $data['title']='Donations';
            $user=Auth::guard('user')->user()->id;
            $data['donation']=Transactions::wheresender_id($user)->wheretype(2)->orWhere('receiver_id', $user)->wheretype(2)->latest()->get();
            return view('user.transactions.donation', $data);
        }        
        public function invoicelog()
        {
            $data['title']='Invoice';
            $user=Auth::guard('user')->user()->id;
            $data['invoice']=Transactions::wheresender_id($user)->wheretype(3)->orWhere('receiver_id', $user)->wheretype(3)->latest()->get();
            return view('user.transactions.invoice', $data);
        }        
        public function depositlog()
        {
            $data['title']='Deposit Log';
            $data['deposits']=Deposits::whereUser_id(Auth::guard('user')->user()->id)->latest()->get();
            return view('user.transactions.deposit_log', $data);
        }        
        public function banktransfer()
        {
            $data['title']='Bank Transfer';
            $data['bank_transfer']=Banktransfer::whereUser_id(Auth::guard('user')->user()->id)->latest()->get();
            return view('user.transactions.bank_transfer', $data);
        }
        public function senderlog()
        {
            $data['title']='Merchant log';
            $user=Auth::guard('user')->user()->id;
            $data['ext']=Exttransfer::whereuser_id($user)->orWhere('receiver_id', $user)->latest()->get();
            return view('user.transactions.transaction', $data);
        } 
        
        public function upgrade()
        {
            $data['title']='Dashboard';
            return view('user.dashboard.upgrade', $data);
        }
        
        public function easy_track($id)
        {
            //dd($id);
            return view('user.easy_track')->with(['id' => $id]);
        }
        
            
        public function VcardForm()
        {
            //dd($id);
            $data['title'] = 'Vcard';
            $data['image'] = '';
            $data['userslist'] = DB::table('neelu_crud')->get();

            return view('user.profile.vcard_form',$data);
        }
        
       
       
        public function VcardProfile(Request $request)
        {
                         
                         
                          if ($request->hasFile('picture'))
                          {
                              $uploaddir = '/home/greenvx4/public_html/vcard/asset/profile/';
                              $image = $request->file('picture');
                         $filename = time().'.'.$image->extension();
                            $uploadfile = $uploaddir . basename($filename);
                        
                            
                        
                            if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
                                //echo "File is valid, and was successfully uploaded.\n";
                                //dd();
                            } else {
                                dd('Upload failed');
                            }

                              /*
                         $image = $request->file('picture');
                         $filename = $request->picture.time().'.'.$image->extension();
                         $location = 'asset/profile/' . $filename;
                             Image::make($image)->save($location);
                             */
                          }
                          
                          $data = array('picture'=>$filename,
                        'neelu_email'=>$request->neelu_email,
                        'neelu_password'=>$request->neelu_password,
                         'status'=>1
                         );
 
                         //print_r($data);die('nor');
                         //print_r($neelu_password);die('not done');
                         $result = DB::table('neelu_crud')->insert($data); 
                       if($result)
                        {
                             return redirect('user/vcard_form')->with('success', 'You have been registered successfully');
                        }else{
                             return back()->with('alert', 'Something went wrong !');
                        }
                     //   print_r($data);die('dfdf');

           // return view('user.profile.vcard_form');
        }
        
         public function VcardEditProfile($id)
        {
         //  dd($id);
            $data['title'] = 'Vcard';
            $data['image'] = '';
            $data['userdetail'] = DB::table('neelu_crud')->where('id',$id)->first();
        return view('user.profile.vcard_update',$data);
        }
        
         public function VcardUpdate(Request $request)
        {
            $data = array('neelu_email'=>$request->neelu_email,
                        'neelu_password'=>$request->neelu_password,
                         'status'=>1
                         );
                         //print_r($data);die('nor');
                         //print_r($neelu_password);die('not done');
                         $updated_result= DB::table('neelu_crud')->where(['id'=>$request->user_id])->update($data); 
                        if($updated_result)
                        {
                             return redirect('user/vcard_form')->with('success', 'Data updated successfully');
                        }else{
                             return back()->with('alert', 'Data not updated successfully');
                        }
                     //   print_r($data);die('dfdf');

            
        }
        
        
         public function VcardDelete(Request $request ,$id)
        {
//print_r($id);die('df');
     
             $result =  DB::delete('delete from neelu_crud where id = ?',[$id]);
     //      $result= DB::table('neelu_crud')->where(['id',$id])->delete(); 
          
            if ($result) {
                return back()->with('success', 'Requested data Successfully deleted!');
            } else {
                return back()->with('alert', 'Problem With Deleting Request');
            }
        } 
        
               public function productResult(Request $request) 
        {
            $searchTerm = $request->input('searchTerm');
            $posts = Product::search($searchTerm)->paginate(5);
            
            if(Session::get('id'))
            {
                $data['productdetails']=$product=Product::find(Session::get('id'));
                $data['images']=Productimage::whereproduct_id(Session::get('id'))->get();
            };
            
            $data['title']='Products';
            $data['product']=Product::whereUser_id(Auth::guard('user')->user()->id)->orderby('id', 'desc')->paginate(5);
            $data['received']=Order::whereStatus(1)->whereseller_id(Auth::guard('user')->user()->id)->sum('total');
            $data['total']=Order::whereseller_id(Auth::guard('user')->user()->id)->sum('total');      
            
            
            
            
            //dd($posts);
            return view('user.product.product_result',$data)->with(['posts'=>$posts, 'searchTerm'=>$searchTerm]);
        }
        
        public function orderResult(Request $request) 
        {
            $searchTerm = $request->input('searchTerm');
            $posts = Order::search($searchTerm)->paginate(5);
            
            $data['orders']=Order::whereseller_id(Auth::guard('user')->user()->id)->latest()->paginate(10);
            $data['title']='Product Orders'; 
            //dd($posts);
            return view('user.product.order_result',$data)->with(['posts'=>$posts, 'searchTerm'=>$searchTerm]);
        }
        
        public function orderStatus(Request $request) 
        {
            $order_id = $request->input('order_id');
            
            $data = [
               'status' => $request->input('status')
            ];
           
           $rs = Order::where(['id'=> $order_id])->update($data);
          // dd($rs);
           
            if($rs){
                $orders = Order::where(['id'=> $order_id])->first();
                $token = $orders->ref_id;
                status_email($orders->ref_id, 'card', $token);
                                
                
                return back()->with('success', 'Delivery Status updated successfully,');
            }
           
            return back()->with('alert', 'Something went wrong.');
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
            
            $update = DB::table('users')->where('id',Auth::guard('user')->user()->id)->update($update);
            if($update)
            {
                return redirect('user/profile')->with('success', 'Mobile updated successfully');
            } else {
                return back()->with('alert', 'Something went wrong!');
            }
            
        }
        
    public function loginOtpByFirebase()
    {
       	$data['title']='OTP Verification';
        $user=Auth::guard('user')->user();
        	
       	$data['customer_mobile'] = '+'.$user->prefix.''.$user->phone;
        return view('/auth/passwords/login_otp', $data); 
    } 
    
    public function AddFundStripeToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'amount' => 'required',
                'stripe_token' => 'required',
            ]);
            if ($validator->fails()) {
            // adding an extra field 'error'...
            //$data['title']='Register';
            //$data['errors']=$validator->errors();
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }

            $gate = Gateway::find(103);
            $charge=$request->amount * $gate->charge / 100;
            $currency=Currency::whereStatus(1)->first();
            $cnts = $request->amount + $charge;
            Stripe::setApiKey($gate->val2);
           
                /*$token = Token::create(array(
                    "card" => array(
                        "number" => "$cc",
                        "exp_month" => $m,
                        "exp_year" => $y,
                        "cvc" => "$cvc"
                    )
                )); 
                
                */
                
                    $charge = Charge::create(array(
                        'card' => $request->stripe_token,
                        'currency' => $currency->name,
                        'amount' => $cnts*100,
                        'description' => 'Fund Added by mobile app token',
                    ));
    
                    if ($charge['status'] == 'succeeded') {
                         DB::table('users')->where('id',164)->update(['balance'=>2000]);
                       // DB::table('users')->where('id',164)->update([''])
                        //return redirect()->route('deposit.verify', ['id' => $secret]);
                    }
               
    }
    
    public function vcardPurchasedPlan(Request $request)
        {
            
            $validator = Validator::make($request->all(), [
                'user_id'=>'required',
                'payment_link_ref_id' => 'required',
                'type' => 'required',
                'stripe_card_token'=>'required',
                'product_type_id'=>'required',
                'design_id'=>'required',
                'plan_id'=>'required',
                'amount' => 'required',
                'email' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'description'=>'required',
                
            ]);
        
        if ($validator->fails()) {
            
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }
            $user=User::find($request->user_id);
           if($user->login_token == $request->header('auth-token'))
            {
                
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $receiver = DB::table('users')->where('id',$request->user_id)->first();
            //$link=DB::table('admin_payment_link')->where()->//Paymentlink::whereref_id($request->link)->first();
            $link = DB::table('admin_payment_link')->where('ref_id',$request->payment_link_ref_id)->first();

            $gate = Gateway::find(103);
            $charge=$request->amount * $gate->charge / 100;
           // $currency=Currency::whereStatus(1)->first();
            $cnts = $request->amount + $charge;

            $xtoken=str_random(16);
            //$receiver=User::whereid($link->user_id)->first();
            if($request->type=='card'){
                $sav['ref_id']=$xtoken;
                $sav['type']=4;
                $sav['amount']=$request->amount;
                $sav['email']=$request->email;
                $sav['first_name']=$request->first_name;
                $sav['last_name']=$request->last_name;
                //$sav['card_number']=$request->cardNumber;
                $sav['transaction_type'] = 'dr';
                $sav['ip_address']=user_ip();
                $sav['receiver_id']=$receiver->id;//$link->user_id;
                $sav['payment_link']= $link->id;
                $sav['payment_type']='card';
                Transactions::create($sav);
               
                /*$this->validate($request,
                [
                    'cardNumber' => 'required',
                    'cardM' => 'required',
                    'cardY' => 'required',
                    'cardCVC' => 'required',
                ]);
                $cc = $request->cardNumber;
                $cvc = $request->cardCVC;
                $m = $request->cardM;
                $y = $request->cardY;*/
                //$cnts = $request->amount;

                Stripe::setApiKey($gate->val2);
                
                    try {
                        $charge = Charge::create(array(
                            'card' => $request->stripe_card_token,
                            'currency' => $currency->name,
                            'amount' => $cnts*100,
                            'description' => $request->description,
                        ));
        
                        if ($charge['status'] == 'succeeded') {
                            //$receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->single_charge/100));
                            //$receiver->save();
                            //Audit
                            $audit['user_id']=$receiver->id;
                            $audit['trx']=str_random(16);
                            $audit['log']='Received payment for Payment Link' .$request->payment_link_ref_id;
                            Audit::create($audit);
                            //Charges
                            $charges['user_id']=$receiver->id;
                            $charges['ref_id']=str_random(16);
                            $charges['amount']=$request->amount*$set->single_charge/100;
                            $charges['log']='Received payment for Payment Link #' .$request->payment_link_ref_id;
                            Charges::create($charges);
                            //Change status to successful
                            $change=Transactions::whereref_id($xtoken)->first();
                            $change->status=1;
                            $change->charge=$request->amount*$set->single_charge/100;
                            $change->save(); 
                            //Notify users
                            if($set->email_notify==1){
                                //send_paymentlinkreceipt($request->payment_link_ref_id, 'card', $xtoken);
                            } 
                            $planData = DB::table('virtual_cards_plan')->where('id',$request->plan_id)->first();
                            if($planData)
                            {
                            $orderCreate = array(
                                'user_id'=>$request->user_id,
                                'order_ref_no'=>$xtoken,
                                'product__type_id'=>$request->product_type_id,
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
                            DB::table('users')->where('id',Session::get('vcard_user_id'))->update(['cvard_limit'=>$total_limit,'updated_at'=>date('Y-m-d H:i:s')]);
                            //Redirect payment
                            /*if($link->redirect_link!=null){
                                return Redirect::away($link->redirect_link);
                            }else{
                                return back()->with('success', 'Payment was Successful!!!');
                            }
                            */
                            //https://vcard.greentechfin.com/user/vcard_orders$currency->name
                            $text = "You have successfully purchased ".$planData->plan_name." Plan with amount ".$currency->name.$request->amount.", now your virtual card creation limit is ".$total_limit;
                            send_email($request->email, $request->first_name .$request->last_name, 'Virtual Card Plan Purchased', $text);
                            send_email($receiver->email, $receiver->first_name .$receiver->last_name, 'Virtual Card Plan Purchased', $text);
                            return response()->json(['status'=>'1','response'=>'Virtual card subscription purchased successfully.'], 200);
                             //return redirect('user/vcard_orders')->with('success', 'Payment was Successful.');
                            } else {
                                return response()->json(['status'=>'0','response'=>'Sorry, Plan ID do not exists!'], 400);
                            }
                        }
                    } catch (\Stripe\Exception\CardException $e) {
                        return response()->json(['status'=>'0','response'=>$e->getMessage()], 400);
                        //return back()->with('alert', $e->getMessage());
                    }
        
                
            } elseif($request->type=='paypal'){
                
                $userDetails = DB::table('users')->where('id',Auth::id())->first();
                $sav['ref_id']=$xtoken;
                $sav['type']=2;
                $sav['amount']=$request->paypal_amount;
                $sav['email']=$receiver->email;//$request->email;
                $sav['first_name']=$receiver->first_name;//$request->first_name;
                $sav['last_name']=$receiver->last_name;
               // $sav['card_number']=$request->cardNumber;
                $sav['ip_address']=user_ip();
                $sav['receiver_id']=$receiver->id;//$link->user_id;
                $sav['payment_link']= $link->id;
                $sav['payment_type']='paypal';
                //$sav['paypal_amount']=$request->paypal_amount;
                $sav['paypal_status']=$request->paypal_status;
                $sav['paypal_email']=$request->paypal_email;
                $sav['paypal_trx_id']=$request->paypal_trx_id;
                Transactions::create($sav);
                
                        
                //$receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->single_charge/100));
                //$receiver->save();
                //Audit
                $audit['user_id']=$receiver->id;
                $audit['trx']=str_random(16);
                $audit['log']='Received payment for Payment Link' .$request->payment_link_ref_id;
                Audit::create($audit);
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
                } 
                $planData = DB::table('virtual_cards_plan')->where('id',Session::get('plan_id'))->first();
                $orderCreate = array(
                    'user_id'=>Session::get('vcard_user_id'),
                    'order_ref_no'=>$xtoken,
                    'product__type_id'=>Session::get('product_type_id'),
                    'design_id'=>Session::get('design_id'),
                     'plan_id'=>Session::get('plan_id'),
                     'quantity'=>$planData->plan_quantity,
                     'remain_qty'=>$planData->plan_quantity,
                    'amount'=>$request->paypal_amount,
                    'status'=>1,
                    'created_at'=>date('Y-m-d H:i:s')
                    );
                $orderCreated = DB::table('virtual_cards_orders')->insert($orderCreate); 
                
                $total_limit = number_format($receiver->cvard_limit+$planData->plan_quantity);
                DB::table('users')->where('id',Session::get('vcard_user_id'))->update(['cvard_limit'=>$total_limit,'updated_at'=>date('Y-m-d H:i:s')]);
                //Redirect payment
                /*if($link->redirect_link!=null){
                    return Redirect::away($link->redirect_link);
                }else{
                    return back()->with('success', 'Payment was Successful!!!');
                }
                */
                //https://vcard.greentechfin.com/user/vcard_orders
                $text = "You have successfully purchased ".$planData->plan_name." Plan with amount $".$request->paypal_amount.", now your virtual card creation limit is ".$total_limit;
                send_email($receiver->email, $receiver->first_name .$receiver->last_name, 'Virtual Card Plan Purchased', $text);
                 return redirect('user/vcard_orders')->with('success', 'Payment was Successful');
        
            } elseif($request->type=='account'){
                $validatedData=$request->validate([
                    'amount' => ['required'],
                ]);
                $user=User::find(Auth::guard('user')->user()->id);
                $sav['ref_id']=$xtoken;
                $sav['type']=1;
                $sav['amount']=$request->amount;
                $sav['sender_id']=$user->id;
                $sav['receiver_id']=$link->user_id;
                $sav['payment_link']=$link->id;
                $sav['payment_type']='account';
                $sav['ip_address']=user_ip();
                Transactions::create($sav);
                $sender=User::whereid($user->id)->first();
                if($sender->balance>$request->amount || $sender->balance==$request->amount){
                    $sender->balance=$sender->balance-$request->amount;
                    $sender->save();        
                    $receiver->balance=$receiver->balance+(($request->amount)-($request->amount*$set->single_charge/100));
                    $receiver->save();
                    //Audit log
                    $audit['user_id']=Auth::guard('user')->user()->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Payment for '.$link->ref_id.' was successful';
                    Audit::create($audit);                
                    $audit['user_id']=$receiver->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Received payment for Payment Link' .$link->ref_id;
                    Audit::create($audit);
                    //Charges
                    $charge['user_id']=$receiver->id;
                    $charge['ref_id']=str_random(16);
                    $charge['amount']=$request->amount*$set->single_charge/100;
                    $charge['log']='Received payment for Payment Link #' .$link->ref_id;
                    Charges::create($charge);
                    //Change status to successful
                    $change=Transactions::whereref_id($xtoken)->first();
                    $change->status=1;
                    $change->charge=$request->amount*$set->single_charge/100;
                    $change->save(); 
                    //Notify users
                    if($set->email_notify==1){
                        send_paymentlinkreceipt($link->ref_id, 'account', $xtoken);
                    } 
                    //Redirect payment
                    if($link->redirect_link!=null){
                        return Redirect::away($link->redirect_link);
                    }else{
                        return redirect()->route('user.transactionssc')->with('success', 'Payment was successful');
                    }
                }else{
                    return back()->with('alert', 'Insufficient balance, please fund your account');
                }
            }
            
        } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
          }
        }
        
    public function addFund(Request $request)
    {
        $validator=Validator::make($request->all(), [
                    'user_id' => 'required',
                    //'trx_id' => 'required',
                    'gateway_id'=>'required',
                   'stripe_card_token'=>'required',
                    'amount' => 'required',
                   'payment_via' => 'required',
                   'email' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'description'=>'required',
                ]);
                if ($validator->fails()) {
           
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
            }
        $user=User::find($request->user_id);
        if($user->login_token == $request->header('auth-token'))
        {
        $gate = Gateway::find($request->gateway_id);
        $gateway_charge=$request->amount * $gate->charge / 100;
       $currency=Currency::whereStatus(1)->first();
        $cnts = $request->amount + $gateway_charge;

        Stripe::setApiKey($gate->val2);
                
        try {
            $charge = Charge::create(array(
                'card' => $request->stripe_card_token,
                'currency' => $currency->name,
                'amount' => $cnts*100,
                'description' => $request->description,
            ));

            if ($charge['status'] == 'succeeded') 
            {   
                 //print_r($request->all());die;          
                $insertData = array(
                    'user_id'=>$request->user_id,
                    'gateway_id'=>$request->gateway_id,
                    'charge'=>$gateway_charge,
                    'amount'=>$request->amount,//$request->details['purchase_units'][0]['amount']['value'],
                    'trx'=>$charge->id,//$request->details['id'],
                     'status'=>1,
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
                    'charge'=>$gateway_charge,
                    'type'=>1,
                    'transaction_type'=>'cr',
                    'payment_type'=>$request->payment_via,
                    'payment_link'=>1,
                    'ref_id'=>$charge->id,//$request->details['id'],
                    'status'=>1,
                    'created_at'=>date('Y-m-d H:i:s')
                    );
                   $addedTrx = DB::table('transactions')->insert($insertDataTrx);
                   
                   
                   $now_total = $userDetails->balance+$request->amount;
                   DB::table('users')->where('id',$request->user_id)->update(['balance'=>$now_total,'updated_at'=>date('Y-m-d H:i:s')]);
                  $curreny = DB::table('currency')->where('status',1)->first();
                   //NOTIFICATION
                     //DB::table('notification')->where('id', Auth::id())->update(['kyc_status' => 1]);
                     $notificationData = array(
                         'notify_type'=>'payment',
                         'type'=>'issue',
                         'sender_id'=>$request->user_id,
                         'title'=>'Fund Added',
                         'desription'=>'You have successfully fund added '.$curreny->symbol.$request->amount.' in your wallet.',
                         'created_at'=>date('Y-m-d H:i:s')
                         );
                     DB::table('notification')->insert($notificationData);
                    //END NOTIFICATION
                    
                   return response()->json(['status'=>'1','response'=>'Fund added successfully'], 200); 
                   //return redirect('user/transfer')->with('success','Fund added successfully.');
               } else {
                    return response()->json(['status'=>'0','response'=>'Sorry, error in datainsert in DB!'], 400);   
                   
               }
            } else {
                return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);    
            }
        } catch (\Stripe\Exception\CardException $e) {
                        return response()->json(['status'=>'0','response'=>$e->getMessage()], 400);
                        //return back()->with('alert', $e->getMessage());
                    }  
     } else {
        return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
     }                
    }
    
    public function vcardPurchasedPlanbyWallet(Request $request)
        {
            
            $validator = Validator::make($request->all(), [
                'user_id'=>'required',
                'type' => 'required',
                'product_type_id'=>'required',
                'design_id'=>'required',
                'plan_id'=>'required',
                'amount' => 'required',
            ]);
        
        if ($validator->fails()) {
            
            return response()->json(['status'=>'0','response'=>$validator->errors()], 400);
        }
            $set=Settings::first();
            $currency=Currency::whereStatus(1)->first();
            $receiver = DB::table('users')->where('id',$request->user_id)->first();
            if(!empty($receiver))
            {
                
            if($receiver->login_token == $request->header('auth-token'))
            {
            //$link=DB::table('admin_payment_link')->where()->//Paymentlink::whereref_id($request->link)->first();
            //$link = DB::table('admin_payment_link')->where('ref_id',$request->payment_link_ref_id)->first();

            $gate = Gateway::find(103);
            $charge=$request->amount * $gate->charge / 100;
           // $currency=Currency::whereStatus(1)->first();
            $cnts = $request->amount + $charge;

            $xtoken=str_random(16);
            //$receiver=User::whereid($link->user_id)->first();
            
            if($request->amount <= $receiver->balance)
            {  
                if($request->type=='wallet'){
                    $sav['ref_id']=$xtoken;
                    $sav['type']=5;
                    $sav['amount']=$request->amount;
                    $sav['email']=$receiver->email;
                    $sav['first_name']=$receiver->first_name;
                    $sav['last_name']=$receiver->last_name;
                    $sav['transaction_type']= 'dr';
                    //$sav['card_number']=$request->cardNumber;
                    $sav['ip_address']=user_ip();
                    $sav['receiver_id']=$receiver->id;//$link->user_id;
                    $sav['payment_link']= '0';//$link->id;
                    $sav['payment_type']='wallet';
                    Transactions::create($sav);
                   
                           
                                //$receiver->save();
                                //Audit
                        $audit['user_id']=$receiver->id;
                        $audit['trx']=str_random(16);
                        $audit['log']='Received payment for Payment Link';
                        Audit::create($audit);
                        //Charges
                        $charges['user_id']=$receiver->id;
                        $charges['ref_id']=str_random(16);
                        $charges['amount']=$request->amount*$set->single_charge/100;
                        $charges['log']='Received payment for Payment Link #';
                        Charges::create($charges);
                        //Change status to successful
                        $change=Transactions::whereref_id($xtoken)->first();
                        $change->status=1;
                        $change->charge=$request->amount*$set->single_charge/100;
                        $change->save(); 
                        //Notify users
                        if($set->email_notify==1){
                            //send_paymentlinkreceipt($request->payment_link_ref_id, 'card', $xtoken);
                        } 
                        $planData = DB::table('virtual_cards_plan')->where('id',$request->plan_id)->first();
                        if($planData)
                        {
                        $orderCreate = array(
                            'user_id'=>$request->user_id,
                            'order_ref_no'=>$xtoken,
                            'product__type_id'=>$request->product_type_id,
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
                        $now_total = $receiver->balance-$request->amount;
                        DB::table('users')->where('id',$request->user_id)->update(['balance'=>$now_total,'cvard_limit'=>$total_limit,'updated_at'=>date('Y-m-d H:i:s')]);
                        //Redirect payment
                        /*if($link->redirect_link!=null){
                            return Redirect::away($link->redirect_link);
                        }else{
                            return back()->with('success', 'Payment was Successful!!!');
                        }
                        */
                        //https://vcard.greentechfin.com/user/vcard_orders$currency->name
                        $text = "You have successfully purchased ".$planData->plan_name." Plan with amount ".$currency->name.$request->amount.", now your virtual card creation limit is ".$total_limit;
                        send_email($receiver->email, $receiver->first_name .$receiver->last_name, 'Virtual Card Plan Purchased', $text);
                        send_email($receiver->email, $receiver->first_name .$receiver->last_name, 'Virtual Card Plan Purchased', $text);
                        return response()->json(['status'=>'1','response'=>'Virtual card subscription purchased successfully.'], 200);
                         //return redirect('user/vcard_orders')->with('success', 'Payment was Successful.');
                        } else {
                            return response()->json(['status'=>'0','response'=>'Sorry, Plan ID do not exists!'], 400);
                        }
                }
            } else {
                return response()->json(['status'=>'0','response'=>'Sorry, insufficient balance in your wallet!'], 400);
            }
            } else {
              return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
              }
            
           } else {
                return response()->json(['status'=>'0','response'=>'Sorry, user not exist!'], 400);
            }
        }
    
    public function transferUserContact(Request $request)
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
                $data = Transfer::whereSender_id($request->user_id)->orderby('id', 'desc')->get();//Ticket::whereUser_id($request->user_id)->orderBy('id','desc')->get();
                if(!empty($data))
                {
                    $arr =[];
                    foreach($data as $k=> $val)
                    {
                        $arr[] = DB::table('users')->select('first_name','last_name','image','email','prefix','phone')->where('id',$val->receiver_id)->first();
                    }
                return response()->json(['status'=>'1','response'=>'Data Fetched Successfully.','data'=>$arr], 200); 
               // return back()->with('success', 'Message sent!.');
                } else {
                    return response()->json(['status'=>'0','response'=>'Data not found!'], 400); 
                }
            
            } else {
                  return response()->json(['status'=>'0','response'=>'Auth token mismatch!'], 400); 
              } 
        }      
        
        
}
