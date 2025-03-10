<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\BaseFunction\BaseFunction;
use App\Models\Role;
use App\Models\User;
use App\Models\ApiSession;
use App\Models\ForgotLink;
use function foo\func;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Validator;
use Hash;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {        
        if(is_numeric($request->email)){           

            $rule=[
                'email' => 'required|regex:/[0-9]{10}/|digits:10',            
                'password' => 'required'
            ];
    
            $message=[
              'email.required'=>'Contact is Invalid',
              'email.regex' => 'Contact must be numeric',
              'email.digits' => 'Contact must be in 10 digits',
              'password.required'=>'Password is required'
            ];
            $validate = Validator::make($request->all(),$rule,$message);
    
            if($validate->fails())
            {
                return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
            }            

            $check_contact = User::where('contact', $request['email'])->where('role','user')->first();
            

            if(!empty($check_contact)){

                if($check_contact->isVerified == 'false'){
                

                    $status = 0;
                    $message = 'Please verify Contact number';
                    return response()->json(['status'=>$status,'message'=>$message,'data'=>NULL],400);

                }

                if(Hash::check($request->password,$check_contact->password))
                {      
                    $token = BaseFunction::setSessionData($check_contact->id);
                    $data = array('token'=>$token,'user'=>$check_contact);
                    $status = 1;
                    $message='Login Successful';
                    return response()->json(['status'=>$status,'message'=>$message,'data'=>$data],200);

                } else {
                    $status = 0;
                    $message = 'Password is incorrect';
                    $data = null;
                    return response()->json(['status'=>$status,'message'=>$message,'data'=>$data],400);
                } 
                
            } else {
                $status = 0;
                $message = 'Contact is incorrect';
                $data = null;
                return response()->json(['status'=>$status,'message'=>$message,'data'=>$data],400);
            }

        } elseif(filter_var($request->email, FILTER_VALIDATE_EMAIL)){           

            $rule=[
                'email' => 'required|email',            
                'password' => 'required'
            ];
    
            $message=[
              'email.required'=>'Email is required',
              'password.required'=>'Password is required'
            ];
            $validate = Validator::make($request->all(),$rule,$message);
    
            if($validate->fails())
            {
                return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
            }          

            $check_email = User::where('email', $request['email'])->first();

            if(!empty($check_email)){

                if(Hash::check($request->password,$check_email->password))
                {      
                    $token = BaseFunction::setSessionData($check_email->id);

                    $data = array('token'=>$token,'user'=>$check_email);
                    $status = 1;
                    $message='Login Successful';
                    return response()->json(['status'=>$status,'message'=>$message,'data'=>$data],200);

                } else {
                    $status = 0;
                    $message = 'Password is incorrect';
                    $data = null;
                    return response()->json(['status'=>$status,'message'=>$message,'data'=>$data],400);
                } 
                
            } else {
                $status = 0;
                $message = 'Email is incorrect';
                $data = null;
                return response()->json(['status'=>$status,'message'=>$message,'data'=>$data],400);
            }

        } else {   

            $status = 0;
            $message = 'Login Detail is invalid..';
            $data = null;
            return response()->json(['status'=>$status,'message'=>$message,'data'=>$data],400);
        
        }
        
    }

    public function register(Request $request)
    {       

        $rule = [         
          'name' => 'required|regex:/^[\pL\s]+$/u',         
          'email'=> 'required|email|unique:users',
          'contact' => 'required|regex:/[0-9]{10}/|digits:10|numeric|unique:users',
          'state'=>'required',
          'city'=>'required',
          'password' => 'required|string|min:8',
          'device_token'=>'required',
          'device_type'=>'required',
          'device_id'=>'required',              
        ];

        $message = [
          'name.required'=>'Name is required',          
          'name.regex'=>'Only alphabet is accepted',
          'email.required'=>'Email is required',          
          'email.unique'=>'Email is already taken',          
          'contact.required'=>'Contact is required',          
          'state.required'=>'State is required',          
          'city.required'=>'City is required',          
          'password.required'=>'Password is required, length should be minimum 8 character',
          'device_token.required'=>'Device Token is required',
          'device_type.required'=>'Device Type is required',
          'device_id.required'=>'Device id is required',        
        ];

        $validate = Validator::make($request->all(),$rule,$message);
          if($validate->fails())
          {
              return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['error'=>$validate->errors()->all()]],400);
          }

        $data['name'] = $request->name;        
        $data['email'] = $request->email;        
        $data['contact'] = $request->contact;        
        $data['state'] = $request->state;        
        $data['city'] = $request->city;
        $data['password'] = Hash::make($request->password);
        $data['device_token'] = $request->device_token;
        $data['device_type'] = $request->device_type;
        $data['device_id'] = $request->device_id;        
        $data['role'] = 'user';        
         

        $user = User::create($data);
        if($user)
        {           
            
            $token = BaseFunction::setSessionData($user->id);
            $data = ['token'=>$token,'user'=>$user];

           // Twillio START

            $token = '9f766355337c4ccc7e52dfcdd50fcc74';
            $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
            $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';                        
            $twilio = new Client($twilio_sid,$token); 

            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create("+91".$request['contact']."", "sms"); 

          // Twillio END  

            return response()->json(['status'=> 1,'message'=>'Registration Successful','data'=>$data],200);
        }
        else
        {
            return response()->json(['status'=> 0,'message'=>'Something went wrong','data'=>null],400);
        }

    }


    public function resend_otp(Request $request){
      
        
    $user = User::where('id',$request->user_data['user_id'])->first();  
     
    if($user){    

        // Twillio START

        $token = '9f766355337c4ccc7e52dfcdd50fcc74';
        $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
        $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';                        
        $twilio = new Client($twilio_sid,$token); 

        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create("+91".$user['contact']."", "sms"); 

        // Twillio END  

        return response()->json(['status'=> 1,'message'=>'OTP sent Successful','data'=>$user],200);
    }
    else
    {
        return response()->json(['status'=> 0,'message'=>'Something went wrong','data'=>null],400);
    }

    }

    public function profile(Request $request){
                  
        $user = User::where('id',$request->user_data['user_id'])->first();
        $user['profile'] = (!empty($user->profile)) ? url('storage/app/public/user/'.$user->profile) : '';

        if($user){
            return response()->json(['status'=> 1,'message'=>'Profile Detail Get Successfully','data'=> $user],200);
        } else{
            return response()->json(['status'=> 0,'message'=>'Invalid User','data'=>null],400);
        }

    }

    public function update_profile(Request $request){       

        $rule = [
            'name' => 'required|regex:/^[\pL\s]+$/u',                
            'email' => 'required|email|unique:users,email,'.$request->user_data['user_id'],
            'contact' => 'regex:/[0-9]{10}/|digits:10|numeric|unique:users,contact,'.$request->user_data['user_id']               
            ];

        $message=[         
          'name.required'=>'Name is required',
          'name.regex'=>'Name should in alphabet and space',
          'email.required'=>'Email is required',
          'email.email'=>'Invalid Email',
          'email.unique'=>'Email is already taken',          
          'contact.regex'=>'Contact should in 10 digits',
          'contact.unique'=>'Contact is already taken',
          'contact.numeric'=>'Contact should in numbers'         
        ];
        
        $validate = Validator::make($request->all(),$rule,$message);
        if($validate->fails())
        {
            return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['error'=>$validate->errors()->all()]],400);
        }

        $data = $request->all();
        $data = $request->except(['user_data','token']);

        $get = User::where('id',$request->user_data['user_id'])->first();

        if($request->hasFile('profile')) {

              $rule=[
                'profile' => 'image|mimes:jpeg,png,jpg',
              ];

              $message=[
                 'profile.image' => 'Profile should be in Image.',
                 'profile.mimes' => 'Profile should be in jpeg,png,jpg formats.',
              ];
  
              $validate = Validator::make($request->all(),$rule,$message);
  
              if($validate->fails())
              {
                  return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['error'=>$validate->errors()->all()]],400);
              }

              $Image = User::where('id',$request->user_data['user_id'])->value('profile');

              if (!empty($Image)) {
                  if(file_exists(storage_path('app/public/user/'.$Image)))
                  {
                    unlink(storage_path('app/public/user/'.$Image));
                  }
              }
              $file = $request->file('profile');
              $filename = 'user-'.uniqid().'.'. $file->getClientOriginalExtension();
              $file->move(storage_path('app/public/user'), $filename);
              $data['profile'] = $filename;
  
          } else {
            $data['profile'] = $get->profile;
          }

          $update = User::where('id',$request->user_data['user_id'])->update($data);

          if($update){

            $user = User::where('id',$request->user_data['user_id'])->first();
            $user['profile'] = (!empty($user->profile)) ? url('storage/app/public/user/'.$user->profile) : '';

            return response()->json(['status'=> 1,'message'=>'User Data Updated Successfully','data'=>$user],200);

          } else {
            return response()->json(['status'=> 0,'message'=>'Something went wrong','data'=>null],400);
          }


    }
    public function link(Request $request)
    {
        if(is_numeric($request->email)){  

            $rule=[
                'email' => 'required|regex:/[0-9]{10}/|digits:10'
            ];
    
            $message=[
                'email.required'=>'Contact is Invalid',
                'email.regex' => 'Contact must be numeric',
                'email.digits' => 'Contact must be in 10 digits'
            ];

            $validate = Validator::make($request->all(),$rule,$message);
    
            if($validate->fails())
            {
                return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
            }  
            
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
                               ->create("+91".$check_contact['contact']."",
                                        [
                                            "body" => "Password reset link is:".$link."",
                                            "from" => "+12532014537"
                                        ]);
                     // send link in message END   
                    
                    $data['contact'] =  $check_contact->contact;
                    $data['link'] = $link; 
                    
                    return response()->json(['status'=> 1,'message'=>'Link sent Successfully...!','data'=>$data],200);                    
                }
                    return response()->json(['status'=> 0,'message'=>'Link sent Failed','data'=>null],400);
                
            } 
            
        } elseif(filter_var($request->email, FILTER_VALIDATE_EMAIL)){

            $rule=[
                'email' => 'required|email'
            ];
    
            $message=[
                'email.required'=>'Email is required',
                'email.email'=>'Email should in Email format'
            ];

            $validate = Validator::make($request->all(),$rule,$message);
    
            if($validate->fails())
            {
                return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
            } 

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

                    $data['email'] =  $check_email->email;
                    $data['link'] = $link;

                    return response()->json(['status'=> 1,'message'=>'Link sent successfully','data'=> $data],200);    
                } catch (\Swift_TransportException $e) {    
                    return response()->json(['status'=> 0,'message'=>'Link sent Failed','data'=>null],400);
                }    
                // Email Send End
             }             
                
        }

        } else {
            return response()->json(['status'=> 0,'message'=>'Link sent Failed','data'=>null],400);
        }

    }

    // public function reset(Request $request){

    //     $rule=[
    //         'user_id' => 'required|numeric',
    //         'password' => 'required|string|min:8|confirmed',
    //         'password_confirmation' => 'required|string|min:8'
    //       ];

    //       $message=[
    //         'user_id.required'=>'User Id is required',
    //         'user_id.numeric'=>'User Id is in number',
    //         'password.required'=>'Password is required',
    //         'password.string'=>'Password must be in valid format',
    //         'password.min'=>'Password minimum length is 8',
    //         'password.confirmed'=>'Password must be same as confirm password',
    //         'password_confirmation.required'=>'Confirm Password must be same as password'
    //       ];
          
    //       $validate = Validator::make($request->all(),$rule,$message);
  
    //       if($validate->fails())
    //       {
    //           return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['error'=>$validate->errors()->all()]],400);
    //       }

    //       $data['password'] = Hash::make($request->password);

    //       $update = User::where('id',$request->user_id)->update($data);

    //         if($update){        
                
    //             $data = User::where('id',$request->user_id)->first();

    //            return response()->json(['status'=> 1,'message'=>'Password updated successfully','data'=> $data],200);
    //         }       

    //         return response()->json(['status'=> 0,'message'=>'Password update failed','data'=>null],400);

    // }

    public function changePassword(Request $request)
    { 
        $rule=[
          'old_password'=>'required',
          'new_password'=>'required'
        ];
        $message=[
          'old_password.required'=>'Old Password is required',
          'new_password.required'=>'New Password is required',
        ];
        $validate = Validator::make($request->all(),$rule,$message);

        if($validate->fails())
        {
            return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['error'=>$validate->errors()->all()]],400);
        }
        if($request['old_password'] == $request['new_password'])
        {
            return response()->json(['status'=> 0,'message'=>'Old and new password must be different','data'=>null],400);
        }
         
        $check_user = User::where('id',$request->user_data['user_id'])->first();
        
        if(Hash::check($request->old_password,$check_user->password))
        {
            $data['password'] = Hash::make($request['new_password']);
            $update = User::where('id',$request->user_data['user_id'])->update($data);
            return response()->json(['status'=> 1,'message'=>'Password Updated','data'=>null],200);
        }
        else{
            return response()->json(['status'=> 0,'message'=>'Incorrect Password','data'=>null],400);
        }
    }

    public function logout(Request $request){
           
      $delete = ApiSession::where('session_id',$request->user_data['session_id'])->delete();

      return response()->json(['status'=> 1,'message'=>'Successfully logout','data'=>null],200);

    }


    public function contact_verify(Request $request){

          $rule=[
            'verification_code'=>'required|numeric',
            'contact'=>'required|regex:/[0-9]{10}/|digits:10'
          ];
          $message=[
            'verification_code.required'=>'Verification Code is required',
            'verification_code.numeric'=>'Verification Code should in number',
            'contact.required'=>'Contact number is required',
            'contact.regex'=>'Contact digits should in between 0-9'
          ];

          $validate = Validator::make($request->all(),$rule,$message);
  
          if($validate->fails())
          {
              return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['error'=>$validate->errors()->all()]],400);
          }

          
          // Twillio START         
        

        /* Get credentials from .env */
        $token = '9f766355337c4ccc7e52dfcdd50fcc74';
        $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
        $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';        
        $twilio = new Client($twilio_sid,$token);
        

        // $verification = $twilio->verify->v2->services($twilio_verify_sid)
        //     ->verificationChecks
        //     ->create($request['verification_code'], array('to' => '+91'.$request['contact']));


        // if($verification->valid) {            

        //     $user = tap(User::where('contact', $request['contact']))->update(['isVerified' => 'true']);
            
        //      $user = User::where('contact', $request['contact'])->first();            
          
        //   return response()->json(['status'=> 1,'message'=>'Code submitted Successfully','data'=> $user],200);                     
            
        // }  else {
        //    return response()->json(['status'=> 1,'message'=>'Verification code is invalid ','data'=> null],200);
        // }     

        // Twillio END   

        //   NEW CODE START

        try {

            $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($request['verification_code'], array('to' => '+91'.$request['contact']));


        if($verification->valid) {            

            $user = tap(User::where('contact', $request['contact']))->update(['isVerified' => 'true']);
            
             $user = User::where('contact', $request['contact'])->first();            
          
          return response()->json(['status'=> 1,'message'=>'Code submitted Successfully','data'=> $user],200);
          
        }  
        
        } catch (\Exception $e) {        
            
            return response()->json(['status'=> 0,'message'=>$e->getMessage(),'data'=> null],400);
        }

        //   NEW CODE END
          
          return response()->json(['status'=> 0,'message'=>'Something went wrong','data'=>NULL],400);
        
        }
}
