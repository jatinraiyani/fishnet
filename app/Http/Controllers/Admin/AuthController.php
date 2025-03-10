<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Gate;
use Session;
use Hash;
use File;

class AuthController extends Controller
{
    public function admin_login(){

        if(Auth::check() && Gate::check('isAdmin')){
            return redirect('admin/dashboard');    
        } else {
            return view('admin.auth.login');
        }
        
    }

    public function do_login(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $checkLogin = User::where('email', $request['email'])->first();
        
        if (empty($checkLogin)) {
            return redirect()->back()
                ->withErrors(['email' => "User not found."]);
        }

        // $checkloginStatus = User::where('email', $request['email'])->where('status', 'active')->first();
        // if (empty($checkloginStatus)) {
        //     return redirect()->back()
        //         ->withErrors(['email' => "User block by admin..!"]);
        // }

        $logindetails = array(
            'email' => $request['email'],
            'password' => $request['password']
        );

        if (Auth::attempt($logindetails)) {
            if (Gate::check('isAdmin')) {

                return redirect('admin/dashboard');
            }
            Auth::logout();
            return redirect()->back()
                ->withErrors(['email' => "Only Admin Can Login Here..!"]);

        } else {
            return redirect()->back()
                ->withErrors(['email' => 'Invalid Login Details.']);
        }
        
    }

    public function edit_profile(){
        $data = User::where('id',Auth::user()->id)->first();
        return view('admin.auth.profile',compact('data'));
    }

    public function update_profile(Request $request){

        $this->validate($request,[
            'name'=>'required',            
            'contact'=>'required|digits:10'
        ]);

        $data = $request->all();
        $data = $request->except('_token', '_method');


        if ($request->file('profile')) {

            $this->validate($request,[
                'profile'=>'mimes:jpeg,png,jpg'
            ]);

            $oldimage = User::where('id', Auth::user()->id)->value('profile');

            if (!empty($oldimage)) {

                File::delete('storage/app/public/user/' . $oldimage);
            }

            $file = $request->file('profile');
            $filename = 'admin-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('storage/app/public/user', $filename);
            $data['profile'] = $filename;
        }
        
        $user = User::where('id',Auth::user()->id)->update($data);
        
        if ($user) {
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Admin updated successfully. </div>');

            return redirect('admin/dashboard');
        }
    }

    public function edit_password(){
        return view('admin.auth.change');
    }

    public function update_password(Request $request){
        $this->validate($request,[
            'password' => 'required',
            'newPassword' => 'required|string|min:8|confirmed'
          ]);
        
          if(!(Hash::check($request->password,Auth::user()->password))) {    
            return back()->withErrors(['password' => 'Current Password does not match. Please try again.']);
         } else {
        
          $update = User::where('id',Auth::user()->id)->update(['password' => Hash::make($request->newPassword)]);
        
            if($update){
        
             return redirect('admin/logout');
        
            }
        
         }
    }

    public function logout(){        
        Auth::logout();       
        return redirect('admin/login');
    }

}
