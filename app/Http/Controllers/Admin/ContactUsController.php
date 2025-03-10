<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index(){
        $data = ContactUs::get();
        return view('admin.contactus.index',compact('data'));
    }

    public function change_status(Request $request){  

        $this->validate($request,[          
            'contact' => 'required|numeric', 
            'status' => 'required'          
        ]);

        if($request->status == 'done'){
            $update = ContactUs::where('id',$request->contact)->update(['status' => $request->status]);

            return response()->json('done');
        }
            return response()->json('error');
    }
}
