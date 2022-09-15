<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use Image;
use App\Models\PasswordReset;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login';

    public function showResetForm(Request $request, $token)
    {
        // echo("hello"); die;
        $data['title'] = "Change Password";
         $tk =PasswordReset::where('token',$token)->first();
         if(is_null($tk))
         {
            $notification =  array('message' => 'Token Not Found!!','alert-type' => 'warning');
            return redirect()->route('user.password.request')->with($notification);
         }else{
            $email = $tk->email;
            return view('auth.passwords.reset',$data)->with(
                ['token' => $token, 'email' => $email]
            );
         }
    }


    public function reset(Request $request)
    {
        //  print_r($request->all());die;
        // $this->validate($request, $this->rules(), $this->validationErrorMessages());
        
        $tk =PasswordReset::where('token',$request->token)->first();
        
       
        $user = User::whereEmail($tk->email)->first();
        if(!$user)
        {
            return back()->with('warning', 'Email don\'t match!!');
        }
        $user->password = bcrypt($request->password);
        $user->save();
        // return back()->with('success', 'Successfully Password Reset.');
        
        return redirect('login')->with('success', 'Successfully Password Reset.');
    }
    
        public function checkUserMobile(Request $request)
    { 
        $validator = Validator::make($request->all(), [
           
            'phone' => 'required|min:10|unique:users|regex:/^\S*$/u',
           ]);
       // $checkhandleSileApiResult = app('App\Http\Controllers\SilaController')->checkHandle($request->username);   
        if ($validator->fails()) {
            Session::put('phone_no',$request->phone);
            Session::put('country_code',$request->country_code);
            return response()->json(['result'=>'0','response'=>$validator->messages()], 400);
        }  else {
             return response()->json(['result'=>'1','response'=>'Available.'], 200);
        }
    }
    
    public function resetbyPhone()
    { 
        if(!empty(Session::get('phone_no')))
        {
            $user = DB::table('users')->where('phone',Session::get('phone_no'))->first();
            //$to =$user->email;
            //$name = $user->name;
            //$subject = 'Password Reset';
            $code = str_random(30);
            //$link = url('/user-password/').'/reset/'.$code;
            //$message = "Use This Link to Reset Password: <br>";
            //$message .= "<a href='$link'>".$link."</a>";
            DB::table('password_resets')->insert(
                ['email' => $user->email, 'token' => $code,  'created_at' => date("Y-m-d h:i:s")]
            );
            $data['token'] = $code;
           $data['title'] = "Set New password";
           return view('auth.passwords.reset_by_mobile',$data);
        } else {
            return back()->with('alert', 'Phone don\'t match!!');
        }
    }
    
    public function resetby_Phone(Request $request)
    {
        $tk =PasswordReset::where('token',$request->token)->first();
        
       
        $user = DB::table('users')->where('phone',$tk->phone);//User::whereEmail($tk->phone)->first();
        if(!$user)
        {
            return back()->with('warning', 'Phone don\'t match!!');
        }
        $user->password = bcrypt($request->password);
        $user->save();
        // return back()->with('success', 'Successfully Password Reset.');
        
        return redirect('login')->with('success', 'Successfully Password Reset.');
    }
    
    public function showReuploadForm(Request $request, $token)
    {
        
        $data['title'] = "Reupload Document";
         $tk =DB::table('custom_doc_link_generate')->where(['token'=>$token,'is_active'=>0])->first();
         if(is_null($tk))
         {
            //$notification =  array('message' => 'Token Not Found!!','alert-type' => 'warning');
            return redirect()->route('user.reupload.thankyou')->with('error', 'Sorry, Token Expired!');
            //return redirect('/')
         }else{
            $email = $tk->email;
            $data['All_country'] = DB::table('countries')->get();
            return view('auth.passwords.reupload',$data)->with(
                ['token' => $token,'email'=>$email]
            );
         }
    }
    
    public function submitReuploadData(Request $request)
    {   
        $validator = Validator::make($request->all(), [
                'upload_type' => 'required',
                'image12' => 'required|max:10240',
                'country' => 'required',
                'address1' => 'required',
                'address2' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip_code' => 'required',
            ]);
            
        if ($validator->fails()) {
           
            $data['title']='Reupload Document';
            $data['errors']=$validator->errors();
            return view('auth/passwords/reupload', $data);
        }
         if ($request->hasFile('image12')) {
                $image = $request->file('image12');
                $filename = time().'.'.$image->extension();
                
                $location = 'asset/profile/' . $filename;
                
                Image::make($image)->save($location);
                $update = array();
                $update['photo_id']=$filename;
                
                  $update['country']=$request->country;
                  $update['address1']=$request->address1;
                  $update['address2']=$request->address2;
                  $update['city']=$request->city;
                  $update['state']=$request->state;
                  $update['zip_code']=$request->zip_code;
                  
                $update['updated_at'] = date('Y-m-d h:i:s');
                
               DB::table('users')->where('email',$request->email)->update($update);
               DB::table('custom_doc_link_generate')->where('token',$request->token)->update(['is_active'=>1,'updated_at'=>date('Y-m-d h:i:s')]);
               
              $userData = DB::table('users')->where('email',$request->email)->first();
               $adminDetails = DB::table('settings')->first();
               //NOTIFY ADMIN
               $link = url('/admin/manage-user/').'/'.$userData->id;
               $text = $request->upload_type." has been reuploaded by ".$userData->business_name." <a href=".$link."> Please check</a>";
               send_email($adminDetails->support_email, 'GetVirtualCard Admin', 'Reuploaded National ID', $text);
               return redirect()->route('user.reupload.thankyou');
            }
            else {
              return redirect()->back()->with('error', 'Something went wrong!');  
            }
           
    }
    
    public function reuploadThakyou(Request $request)
    {
            $data['title']='Reupload Thank You';
           // $data['errors']=$validator->errors();
            return view('auth/passwords/reupload_final', $data);
    }
}
