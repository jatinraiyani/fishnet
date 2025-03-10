<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Models\ForgotLink;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Payment;
use Session;
use Mail;
use Twilio\Rest\Client;


class AuthController extends Controller
{
    public function signup(){
        return view('front.signup');
    }

    public function do_register(Request $request){

        $this->validate($request, [          
            'name' => 'required|regex:/^[\pL\s]+$/u',         
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'contact' => 'required|regex:/[0-9]{10}/|digits:10|numeric|unique:users',
            'state' => 'required',
            'city' => 'required',           
            'business' => 'required'           
        ]);

        $data = $request->all();
        
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'user';       

        // Twillio START 

        $token = '9f766355337c4ccc7e52dfcdd50fcc74';
        $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
        $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';       
        
        $twilio = new Client($twilio_sid,$token);

        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create("+91".$data['contact']."", "sms");         
           
        // Twillio END
        
        $user = new User;
        $user->fill($data);

        if($user->save()){
            return redirect('verify/'.$data['contact']);            
        }

    }

    public function signin(){
        return view('front.login');
    }

    public function verify($contact){  
       return view('front.verify',compact('contact'));
    }

    protected function do_verify(Request $request)
    {
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'contact' => ['required', 'numeric'],
        ]);        
        

        /* Get credentials from .env */
        $token = '9f766355337c4ccc7e52dfcdd50fcc74';
        $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
        $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';        
        $twilio = new Client($twilio_sid,$token);    

      try {

        $verification = $twilio->verify->v2->services($twilio_verify_sid)
        ->verificationChecks
        ->create($request['verification_code'], array('to' => '+91'.$data['contact']));


        if($verification->valid) {            

            $user = tap(User::where('contact', $data['contact']))->update(['isVerified' => 'true']);
            
            Auth::login($user->first());
            
            $notification = array(
                'message' => 'Phone number verified',
                'alert-type' => 'success'
            );

            return redirect('/')->with($notification); 
        
        }  
    
      } catch (\Exception $e) { 
        
        Session::flash('message','Invalid verification code entered!');
        return redirect()->back();
     }

     Session::flash('message','Invalid verification code entered!');
     return redirect()->back();

    }

    public function otp_resend($contact){

        // Twillio START 

        $token = '9f766355337c4ccc7e52dfcdd50fcc74';
        $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
        $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';       
        
        $twilio = new Client($twilio_sid,$token);

        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create("+91".$contact."", "sms");         
           
        // Twillio END

        return view('front.verify',compact('contact'));
    }

    public function do_login(Request $request){

        if(is_numeric($request->email)){  

            $this->validate($request, [
                'email' => 'required|regex:/[0-9]{10}/|digits:10',            
                'password' => 'required'                  
            ]);

            $field = 'contact';

            $check_contact = User::where('contact', $request['email'])->first();
            

            if(!empty($check_contact)){

                if(Hash::check($request->password,$check_contact->password) && $check_contact->role == 'user'){

                    $request->merge([$field => $request->input('email')]);

                    // if mobile is not verify then verify it START

                    if($check_contact->isVerified == 'false'){

                        // Twillio START

                        $token = '9f766355337c4ccc7e52dfcdd50fcc74';
                        $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
                        $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';                        
                        $twilio = new Client($twilio_sid,$token);                          
                       

                        $twilio->verify->v2->services($twilio_verify_sid)
                            ->verifications
                            ->create("+91".$check_contact['contact']."", "sms"); 

                        // Twillio END                        

                        return redirect('verify/'.$check_contact['contact']);
                        // return redirect('verify')->with(['contact' => $check_contact['contact']]);
                    }

                    // if mobile is not verify then verify it END

                    if (Auth::attempt(['contact' => $request->email, 'password' => $request->password])) {
                        $notification = array(
                            'message' => 'Login Successfully...!',
                            'alert-type' => 'success'
                        );
    
                        return redirect('/')->with($notification); 
                    } 
                    
                    $notification = array(
                        'message' => 'Invalid Credentials...!',
                        'alert-type' => 'error'
                    );
    
                    return redirect('signin')->with($notification);                   
    
                }                
                
            } 

        } elseif(filter_var($request->email, FILTER_VALIDATE_EMAIL)){           

            $this->validate($request, [
                'email' => 'required|email',            
                'password' => 'required'                  
            ]);

            $field = 'email';

            $check_email = User::where('email', $request['email'])->first();

            if(!empty($check_email)){

                if(Hash::check($request->password,$check_email->password) && $check_email->role == 'user'){

                    $request->merge([$field => $request->input('email')]);

                    // if mobile is not verify then verify it START

                    if($check_email->isVerified == 'false'){

                        // Twillio START
                        $token = '9f766355337c4ccc7e52dfcdd50fcc74';
                        $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
                        $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';                        
                        $twilio = new Client($twilio_sid,$token);                     
                        
                        $twilio->verify->v2->services($twilio_verify_sid)
                            ->verifications
                            ->create("+91".$check_email['contact']."", "sms"); 
                        // Twillio END

                        return redirect('verify/'.$check_contact['contact']);
                        // return redirect('verify')->with(['contact' => $check_email['contact']]);
                    }

                    // if mobile is not verify then verify it END

                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        $notification = array(
                            'message' => 'Login Successfully...!',
                            'alert-type' => 'success'
                        );
    
                        return redirect('/')->with($notification); 
                    } 
                    
                    $notification = array(
                        'message' => 'Invalid Credentials...!',
                        'alert-type' => 'error'
                    );
    
                    return redirect('signin')->with($notification);
    
                }
                
            } 

        } else {

            $notification = array(
                'message' => 'Invalid Credentials...!',
                'alert-type' => 'error'
            );

            return redirect('signin')->with($notification);
        }

        $notification = array(
            'message' => 'Invalid Credentials...!',
            'alert-type' => 'error'
        );

        return redirect('signin')->with($notification);
        
    } 

    public function forgot_password(){
        return view('front.forgot');
    }

    public function forgot_link(Request $request){

        if(is_numeric($request->email)){  

            $this->validate($request, [
                'email' => 'required|regex:/[0-9]{10}/|digits:10'
            ]);

            $field = 'contact';

            $check_contact = User::where('contact', $request['email'])->first();            

            if(!empty($check_contact)){

                // delete old link of current user
                $delete = ForgotLink::where('user_id',$check_contact->id)->delete();

                $forgot_link['user_id'] = $check_contact->id;
                $forgot_link['contact'] = $check_contact->contact;
                $forgot_link['link'] = md5(rand().microtime()); // Token

                $insertToken = new ForgotLink;
                $insertToken->fill($forgot_link);

                if($insertToken->save($forgot_link)){                    
                    $link = url('/password-link/'.$forgot_link['link'].'/'.$forgot_link['contact']);

                    // send link in message START

                    $token = '9f766355337c4ccc7e52dfcdd50fcc74';
                    $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
                    $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';                        
                    $twilio = new Client($twilio_sid,$token);

                    $twilio->messages
                              ->create("+91".$request['email']."",
                                       [
                                           "body" => "Password reset link is:".$link."",
                                           "from" => "+12532014537"
                                       ]);
                    // send link in message END       
                    
                    $notification = array(
                        'message' => 'Link sent Successfully!',
                        'alert-type' => 'success'
                    );
            
                    return redirect('forgot')->with($notification);
                }
                
            } 

        } elseif(filter_var($request->email, FILTER_VALIDATE_EMAIL)){           

            $this->validate($request, [
                'email' => 'required|email'               
            ]);

            $field = 'email';

            $check_email = User::where('email', $request['email'])->first();

            if(!empty($check_email)){

            // delete old link of current user
            $delete = ForgotLink::where('user_id',$check_email->id)->delete();

            $forgot_link['user_id'] = $check_email->id;
            $forgot_link['email'] = $check_email->email;
            $forgot_link['link'] = md5(rand().microtime()); // Token

            $insertToken = new ForgotLink;
            $insertToken->fill($forgot_link);

            if($insertToken->save()){

                $link = url('/password-link/'.$forgot_link['link'].'/'.$forgot_link['email']);

                // Email Send Start 
    
                $title = 'Reset password link';
                $email = $check_email->email;
    
                $datas = ['title'=>$title,'email'=>$email,'link'=>$link];
    
                try {                
                    \Mail::to($datas['email'])->send(new \App\Mail\ForgotPassword($datas));
                  
                    $notification = array(
                        'message' => 'Link sent Successfully!',
                        'alert-type' => 'success'
                    );
            
                    return redirect('forgot')->with($notification);
    
                } catch (\Swift_TransportException $e) {
    
                    $notification = array(
                        'message' => 'Link sending failed!',
                        'alert-type' => 'error'
                    );
            
                    return redirect('forgot')->with($notification);
                }
    
                // Email Send End 

            }             
                
            } 

        } else {

            $notification = array(
                'message' => 'Invalid Credentials for get Link!',
                'alert-type' => 'error'
            );

            return redirect('forgot')->with($notification);
        }

        $notification = array(
            'message' => 'Invalid Credentials for get Link!',
            'alert-type' => 'error'
        );

        return redirect('forgot')->with($notification);

    }

    public function password_link(Request $request,$token,$email){        

        $checkDetail = ForgotLink::where('link',$token)->where('email',$email)->orWhere('contact',$email)->first();

        if(!empty($checkDetail)){
              return view('front.reset',compact('checkDetail'));
        }

        $notification = array(
            'message' => 'Invalid Credentials',
            'alert-type' => 'error'
        );

        return redirect('forgot')->with($notification);
    } 
    
    public function reset_password(Request $request){

        $this->validate($request,[
            'user_id' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $data['password'] = Hash::make($request->password);

        $update = User::where('id',$request->user_id)->update($data);

        if($update){           

            $notification = array(
                'message' => 'Password Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect('signin')->with($notification);
        }       

        $notification = array(
            'message' => 'Something went wrong',
            'alert-type' => 'error'
        );

        return redirect('forgot')->with($notification);
    }

    public function profile(){
        
        if(Auth::check()){

            $order = Order::where('user_id',Auth::user()->id)->get();
            $user = User::where('id',Auth::user()->id)->first();
            return view('front.profile',compact('user','order'));
        } else {
            return redirect('signin');
        }
        
    }

    public function update_profile(Request $request){

        $this->validate($request, [          
            'name' => 'required|regex:/^[\pL\s]+$/u',                
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'contact' => 'required|regex:/[0-9]{10}/|digits:10|numeric|unique:users,contact,'.Auth::user()->id,
            'state' => 'required',
            'city' => 'required',
            'business' => 'required'           
        ]);

        $data = $request->all();   
        $data = $request->except('_token', '_method');

        if($request->profile) { 

            $this->validate($request, [
                'profile' => 'required'           
            ]);

            if (!empty($oldimage)) {
                if(file_exists(storage_path('app/public/user/'.Auth::user()->profile)))
                {                
                unlink(storage_path('app/public/user/'.Auth::user()->profile));                
                }
            } 
            
            $image_parts = explode(";base64,", $request->profile);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $f_name = 'user-' . uniqid() . '.png';       
            $file = 'storage/app/public/user/'.$f_name;
            file_put_contents($file,$image_base64);
            $data['profile'] = $f_name;

        } else {
            $data['profile'] = Auth::user()->profile;
        }
                
        $update = User::where('id',Auth::user()->id)->update($data);

        if($update){
            $notification = array(
                'message' => 'Profile Updated successfully!',
                'alert-type' => 'success'
            );

            return redirect('profile')->with($notification);
        }
    }

    public function change_password(Request $request){

        $this->validate($request,[
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',

          ]);
        
          if(!(Hash::check($request->current_password,Auth::user()->password))) {    
            return back()->withErrors(['password' => 'Current Password does not match. Please try again.']);
         } else {
        
          $update = User::where('id',Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
        
            if($update){

                Auth::logout();

                $notification = array(
                    'message' => 'Password Updated successfully!',
                    'alert-type' => 'success'
                );
    
                return redirect('signin#changepassword')->with($notification);
        
            }
        
         }

    }
    
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
