<?php

namespace App\Http\Controllers;

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

class RestController extends Controller
{

        
    public function __construct()
    {		
        
    }
    
    public function  get_userlist()
     {
         $data['userlist']=DB::table('neelu_crud')->where('status',1)->orderBy('id','DESC')->get();
         return response()->json(['status'=>'1','response'=>$data], 200);

     }
     
     //fetch userslistfrom users table
     
       public function  get_userlist1()
        {
         $data['userlist']=DB::table('users')->where('fa_status',0)->orderBy('id','DESC')->get();
         return response()->json(['status'=>'1','response'=>$data], 200);

        }
     
     
     public function  get_userDetails(Request $request)
     {
          $validator = Validator::make($request->all(), [
                'user_id' => 'required'
                ]);
           // $checkhandleSileApiResult = app('App\Http\Controllers\SilaController')->checkHandle($request->username);   
            if ($validator->fails()) 
            {
                
                return response()->json(['status'=>'0','response'=>$validator->messages()], 400);
                
            }else
            {
         
                  $FetchResult  =DB::table('neelu_crud')->where(['id'=>$request->user_id,'status'=>1])->orderBy('id','DESC')->get();
                  if(count($FetchResult) > 0)
                   {
         
                   return response()->json(['status'=>'1','response'=>$FetchResult], 200);
                   }
                else
                {
                 return response()->json(['status'=>'0','response'=>'User does not exist!'], 400);
                }
            }
     }
     
     public function  userRegister(Request $request)
     {   
             $validator = Validator::make($request->all(), [
                'neelu_email' => 'required|email|unique:neelu_crud|regex:/^\S*$/u',
                'pwd' => 'required',
               ]);
           // $checkhandleSileApiResult = app('App\Http\Controllers\SilaController')->checkHandle($request->username);   
            if ($validator->fails())
            {
                
                return response()->json(['status'=>'0','response'=>$validator->messages()], 400);
                
            }  else {
                
                        $insertData = array(
                                         'neelu_email'=>$request->neelu_email,
                                         'neelu_password'=>$request->pwd,
                                         'status'=>1
                                             );
                        
             $insertResult = DB::table('neelu_crud')->insert($insertData); 
             if($insertResult)
             {
                  return response()->json(['status'=>'1','response'=>'User Register Successfully.'], 200);
             } else {
                 return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);
             }
    
            }
     }
      public function  productRegister(Request $request)
     {   
             $validator = Validator::make($request->all(), [
              // 'product_id' => 'required',
                'product_name' => 'required|regex:/^\S*$/u',
                'quantity' => 'required'
                
               ]);
            if ($validator->fails())
            {
                
                return response()->json(['response'=>$validator->messages()], 400);
                
            }  else
              {
                
              $insertData = array(
                            'Product_Id'=>$request->product_id,
                            'Product_name'=>$request->product_name,
                            'Quantity'=>$request->quantity,
                            'Price'=>$request->price,
                            'Description'=>$request->description
                            );
                        
             $insertResult = DB::table('laravelproduct')->insert($insertData); 
             if($insertResult)
             {
                  return response()->json(['response'=>'Product Register Successfully.'], 200);
             } 
             else   {
                 return response()->json(['response'=>'Something went wrong!'], 400);
                    }
    
            }
     }
     
      public function  get_productlist(Request $request)
     {
          $validator = Validator::make($request->all(), [
                'Product_id' => 'required'
                ]);
           // $checkhandleSileApiResult = app('App\Http\Controllers\SilaController')->checkHandle($request->username);   
            if ($validator->fails())
            {
                
                return response()->json(['status'=>'0','response'=>$validator->messages()], 400);
                
            }else
               {
         
                  $FetchResult  =DB::table('laravelproduct')->where(['Product_id'=>$request->Product_id])->orderBy('Product_id','DESC')->get();
                 if(count($FetchResult) > 0)
                   {
         
                   return response()->json(['status'=>'1','response'=>$FetchResult], 200);
                   }
                else{
                     return response()->json(['status'=>'0','response'=>'product does not exist!'], 400);

                   }
             }
     } 
      public function  productlist()
     {
         $data['productlist']=DB::table('laravelproduct')->orderBy('Product_id','DESC')->get();
         return response()->json(['status'=>'1','response'=>$data], 200);

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
        
        public function CategoryForm()
        {
            
            $data['title']= 'Add New Category';
            $data['allcategory'] = DB::table('allcategory_sk')->where('parent_id',0)->get();
                     $data['userlist']=DB::table('allcategory_sk')->where('status',1)->orderBy('id','DESC')->get();

            return view('user.profile.category',$data);
        }
       public function CategoryInsert(Request $request)
       {
                        $maincategory_id= $request->maincategory_id;      
                        if(empty($request->maincategory_id))
                        {
                            
                            $maincategory_id=0;
                        }       
                         
                       
                        $data = array('parent_id'=>$maincategory_id,
                                     'title'=>$request->category,
                                    'status'=>1,
                                    'created_at'=>date('Y-m-d H:i:s')
                                  );
                        
                               //   print_r($request->maincategory_id);
                 //    print_r($data['allcategories'])=DB::table('allcategory_sk')->where(['id'=>$request->id])->get();die('nk');
                         //print_r($data);die('nor');
                         //print_r($neelu_password);die('not done');
                         $result = DB::table('allcategory_sk')->insert($data); 
                       if($result)
                        {
                             return redirect('user/category_add')->with('success', 'Category added successfully');
                        }else{
                             return back()->with('alert', 'Something went wrong !');
                        }
       }
     
     public function CategoryList()
     {
         
         $data['userlist']=DB::table('allcategory_sk')->where('status',1)->orderBy('id','DESC')->get();
         return response()->json(['status'=>'1','response'=>$data], 200);
     }
}
       
