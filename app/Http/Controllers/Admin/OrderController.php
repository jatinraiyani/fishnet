<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\User;

class OrderController extends Controller
{
    public function index(){

        $data = Order::get();
        return view('admin.order.index',compact('data'));

    }

    public function change_status(Request $request){  

        $this->validate($request,[          
            'order' => 'required|numeric', 
            'status' => 'required'          
        ]);

        if($request->status == 'ready_for_pay'){
            $update = Order::where('id',$request->order)->update(['order_status' => $request->status,'payment_status' => 'pending']);

            return response()->json(['pending']);
        } 

        if($request->status == 'confirm'){
            $update = Order::where('id',$request->order)->update(['order_status' => $request->status,'payment_status' => 'success']);

            return response()->json(['confirmed']);
        } 
        
        if($request->status == 'slip_refuse'){
            $update = Order::where('id',$request->order)->update(['order_status' => $request->status,'payment_status' => 'pending']);
            return response()->json(['refused']);
        } 

        if($request->status == 'cancel'){

            $update = Order::where('id',$request->order)->update(['order_status' => $request->status,'payment_status' => 'failed']);
            return response()->json(['canceled']);

        }
        return response()->json(['nodata']);

    }

    public function view_order($order){

        $order_detail = Order::where('id',$order)->first();        
        
        $user = User::findOrFail($order_detail->user_id);       
        
        return view('admin.order.invoice',compact('order_detail','user'));
    }
}
