<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Type;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\ContactUs;
use App\Models\AdBanner;
use Auth;
use Razorpay\Api\Api;
use Session;
use Twilio\Rest\Client;

class HomeController extends Controller
{
    public function index(){         
        
        $banner = Slider::where('status','active')->get();
        $type = Type::get();

        $data = Product::get();        
        $product = $data->sortBy('type_id')->groupBy('type_id');
       
        $adbanner = AdBanner::get();       
        
        return view('front.home',compact('banner','type','product','adbanner'));
    }

    function loadmore_product(Request $request)
    {
     if($request->ajax())
     {         
    
      if($request->id > 0)
      {
       $data = Product::with(['product_image'])->where('id', '<', $request->id)->orderBy('id', 'DESC')->limit(8)->get();          
      }
      else
      {
        $data = Product::with(['product_image'])->orderBy('id','DESC')->limit(8)->get();
      }

      if(!empty($data)){
        foreach($data as $data_row){
            $data_row->image = url('storage/app/public/product/'.$data_row->image);
        }
       
        $last_id = @$data->last()->id;      

        return response()->json(['last_id' => $last_id,'product' => $data]);
      }

     }

    }   
    
    public function type_product($type){       
        
        $banner = Slider::where('status','active')->get();
        $product = Product::where('type_id',$type)->get();
        $type_name = Type::where('id',$type)->value('name');
        return view('front.typeproduct',compact('product','banner','type_name'));
    }

    public function product_detail(){
        return view('front.detail');
    }

    public function select_product(){
        $type = Type::get();
        return view('front.selectproduct',compact('type'));
    }

    public function category_by_type(Request $request){        

        $category = Category::where('type_id',$request->typeId)->get();

        if(!empty($category)){
            foreach($category as $row){
                $row->image = url('storage/app/public/category/'.$row->image);
            }
            return response()->json(['status' => 1,'data' => $category]);
        }
                
    }

    public function subcategory_by_category(Request $request){       

        $subcategory = SubCategory::where('category_id',$request->categoryId)->get(); 

        if(!empty($subcategory)){
            foreach($subcategory as $row){
                $row->image = url('storage/app/public/subcategory/'.$row->image);
            }
            return response()->json(['status' => 1,'data' => $subcategory]);
        } else {
            return response()->json(['status' => 1,'data' => 'nodata']);
        }
        
    }

    public function product_by_category(Request $request){    
        
        
        $products = Product::with(['product_size','product_type','product_category'])->where('subcategory_id',$request->subcategory_id)->where('status','active')->get();

        if(empty($products)){
            $products = Product::with(['product_size','product_type','product_category'])->where('category_id',$request->category_id)->where('status','active')->get();
        }
        
        $types = Type::get();
        $brand = Brand::get();
        return view('front.detail',compact('products','types','brand'));
       
    }    

    public function about_us(){
        return view('front.aboutus');
    }

    public function contact_us(){
        return view('front.contactus');
    }

    public function filter_product(Request $request){        

        if(($request->category && $request->brand) || ($request->category && !$request->brand)){
            $product = Product::with(['product_image'])->where('category_id',$request->category)->where('status','active')->get();
        } elseif(!$request->category && $request->brand){
            $product = Product::with(['product_image'])->where('status','active')->get();
        } else {
            $product = Product::with(['product_image'])->where('category_id',$request->category_id)->where('subcategory_id',$request->subcategory_id)->where('status','active')->get();
        }

            if(!empty($product)){
                foreach($product as $l => $product_row){                     
                    if($request->brand){
                        foreach($product_row->product_brand as $brands){                            
                            if(!in_array($brands->brand_id,$request->brand)){                                
                                $product->forget($l);
                            } 
                        }
                    }
                }
                
               
                return response()->json(['status' => 1,'data' => $product]);
            }
     
        return response()->json(['status' => 0,'data' => NULL]);
    }

    public function product_popup(Request $request){

        $this->validate($request, [          
            'product' => 'required|numeric', 
        ]);

        $product = Product::with(['product_size','product_image'])->where('id',$request->product)->first();
        
        if(!empty($product)){             
            
            foreach($product->product_image as $img){
                $img->image = url('storage/app/public/product/'.$img->image);               
            }

            foreach($product->product_size as $chart){
                $chart->chart = (!empty($chart->chart)) ? url('storage/app/public/chart/'.$chart->chart) : '';               
            }            
            
            return response()->json($product);
        }
    }

public function cart_detail(Request $request){

    $cart_product = [];

    $cart_total = 0;   
    
    if(Auth::check()){

        if(!empty($request->cart)){

            foreach($request->cart as $cart_row){

                $check = Cart::where('product',$cart_row['product'])->where('user_id',Auth::user()->id)->where('size',$cart_row['size'])->first();                
    
                if(!empty($check)){
                    $updateCheckQty = Cart::where('id',$check->id)->update(['uniqueid' => $cart_row['uniqueId'],'qty' => $cart_row['qty']]);                     
                                        
                } else {                
                        $data['user_id'] = Auth::user()->id;
                        $data['uniqueId'] = $cart_row['uniqueId'];
                        $data['product'] = $cart_row['product'];
                        $data['product_unit'] = $cart_row['product_unit'];
                        $data['type'] = $cart_row['type'];
                        $data['category'] = $cart_row['category'];
                        $data['subcategory'] = $cart_row['subcategory'];
                        $data['price'] = $cart_row['price'];
                        $data['size'] = $cart_row['size'];
                        $data['qty'] = $cart_row['qty'];
    
                        $cart_insert = new Cart;
                        $cart_insert->fill($data);
                        $cart_insert->save($data);
                }            
    
            }  

        }        
        
        $cart = Cart::where('user_id',Auth::user()->id)->get();                

        foreach($cart as $carts){

            $current_size = explode('-',$carts['size']);
            $c_size = $current_size[0];
            $c_unit = $current_size[1];

            $product = Product::where('id',$carts['product'])->first();
            $size_data = ProductSize::where('product_id',$carts['product'])->where('size',$c_size)->where('size_unit',$c_unit)->first(); 
                 
            $current_product['uniqueId'] = $carts['uniqueId'];
            $current_product['id'] = $product->id;
            $current_product['type'] = $product->product_type->name;
            $current_product['product_unit'] = $product->product_unit;
            $current_product['category'] = $product->product_category->name;
            $current_product['subcategory'] = @$product->product_subcategory->name;
            $current_product['name'] = $product->name;
            $current_product['image'] = url('storage/app/public/product/'.$product->product_image[0]['image']);
            $current_product['chart'] = url('storage/app/public/chart/'.$size_data['chart']);
            // $current_product['price'] = $product->price;
            $current_product['price'] = $size_data->price;
            $current_product['qty'] = $carts['qty'];
            $current_product['size'] = str_replace("-"," ",$carts['size']);
            $current_product['product_total'] = $carts['qty'] * $size_data->price;

            $cart_total = $cart_total + ($carts['qty'] * $size_data->price);

            array_push($cart_product,$current_product);
        }
        

    } else {

        foreach($request->cart as $cart_row){

            $current_size = explode('-',$cart_row['size']);
            $c_size = $current_size[0];
            $c_unit = $current_size[1];

            $product = Product::where('id',$cart_row['product'])->first();  
            $size_data = ProductSize::where('product_id',$cart_row['product'])->where('size',$c_size)->where('size_unit',$c_unit)->first();               
                            
            $current_product['uniqueId'] = $cart_row['uniqueId'];
            $current_product['id'] = $product->id;
            $current_product['type'] = $product->product_type->name;
            $current_product['product_unit'] = $product->product_unit;
            $current_product['category'] = $product->product_category->name;
            $current_product['subcategory'] = @$product->product_subcategory->name;
            $current_product['name'] = $product->name;
            $current_product['image'] = url('storage/app/public/product/'.$product->product_image[0]['image']);
            $current_product['chart'] = url('storage/app/public/chart/'.$size_data['chart']);
            // $current_product['price'] = $product->price;
            $current_product['price'] = $size_data->price;
            $current_product['qty'] = $cart_row['qty'];
            $current_product['size'] = str_replace("-"," ",$cart_row['size']);
            $current_product['product_total'] = $cart_row['qty'] * $size_data->price;

            $cart_total = $cart_total + ($cart_row['qty'] * $size_data->price);

            array_push($cart_product,$current_product);
        }
    }
   
    if(!empty($cart_product)){
        return response()->json(['data' => $cart_product,'cart_total' => $cart_total]);
    } else {
        return response()->json(['data' => null]);
    }   

}

public function cart_qty_update(Request $request){

    $updateQty = Cart::where('user_id',Auth::user()->id)->where('uniqueId',$request->uniqueId)->update(['qty' => $request->new_qty]);

    if($updateQty){
        return response()->json('ok');
    }
        return response()->json('error');
}

public function delete_cart_product(Request $request){

    $delete_cart = Cart::where('user_id',Auth::user()->id)->where('uniqueId',$request->uniqueId)->delete();

    $cart = Cart::where('user_id',Auth::user()->id)->get();
    $cart_total = 0;

    foreach($cart as $cart_row){
        $product = Product::where('id',$cart_row['product'])->first();

        $cart_total = $cart_total + ($cart_row['qty'] * $product->price);
    }

    return response()->json(['data' => 'ok','cart_total' => $cart_total]);
}

public function get_cart_detail(){

    $cart = Cart::where('user_id',Auth::user()->id)->get();

    if(!empty($cart)){
        return response()->json(['data' => $cart]);
    } 
        return response()->json(['data' => null]);
}

public function cart_checkout(Request $request){

    $cart = Cart::where('user_id',Auth::user()->id)->get();

    $cart_total = 0;
    $cart_product = [];

    foreach($cart as $cart_row){

    $product = Product::where('id',$cart_row['product'])->first(); 

    $current_size = explode('-',$cart_row['size']);
    $c_size = $current_size[0];
    $c_unit = $current_size[1];  
    $size_data = ProductSize::where('product_id',$cart_row['product'])->where('size',$c_size)->where('size_unit',$c_unit)->first();             
                            
    $current_product['uniqueId'] = $cart_row['uniqueId'];
    $current_product['id'] = $product->id;
    $current_product['type'] = $product->product_type->name;
    $current_product['category'] = $product->product_category->name;
    $current_product['subcategory'] = @$product->product_subcategory->name;
    $current_product['name'] = $product->name;
    $current_product['image'] = url('storage/app/public/product/'.$product->product_image[0]['image']);
    $current_product['price'] = $size_data->price;
    $current_product['qty'] = $cart_row['qty'];
    $current_product['size'] = str_replace("-"," ",$cart_row['size']);
    $current_product['product_total'] = $cart_row['qty'] * $size_data->price;

    $cart_total = $cart_total + ($cart_row['qty'] * $size_data->price);
      array_push($cart_product,$current_product);

    }   

     if($cart_total < 5000){

        Session::flash('message','Please add products atleast 5000 Rs.');
        return redirect('/');

     }

    return view('front.checkout',compact('cart_product','cart_total'));

}

public function do_checkout(Request $request){ 


    $this->validate($request,[          
        'name' => 'required|regex:/^[\pL\s]+$/u',         
        'email' => 'nullable|email',        
        'contact' => 'required|regex:/[0-9]{10}/|digits:10|numeric',
        'address' => 'required|string',
        'zipcode' => 'required|numeric',
        'state' => 'required',
        'city' => 'required'             
    ]);  
   

    //get cart data 
    
     $cart = Cart::where('user_id',Auth::user()->id)->get();

     $cart_total = 0;
     $cart_product = [];

     foreach($cart as $cart_row){

        $product = Product::where('id',$cart_row['product'])->first();

        $cart_total = $cart_total + ($cart_row['qty'] * $cart_row['price']);        
     }        

    // Store Address 

    $insert_address = UserAddress::where('user_id',Auth::user()->id)
                             ->where('name',$request->name)
                             ->where('email',$request->email)
                             ->where('contact',$request->contact)
                             ->where('address',$request->address)
                             ->where('zipcode',$request->zipcode)
                             ->where('state',$request->state)
                             ->where('city',$request->city)
                             ->first();

    if(!empty($insert_address)){
        $update = UserAddress::where('id',$insert_address->id)->update(['set_as' => 'primary']);
    } else {

        $address['user_id'] = Auth::user()->id;
        $address['name'] = $request->name;
        $address['email'] = $request->email;
        $address['contact'] = $request->contact;
        $address['address'] = $request->address;
        $address['zipcode'] = $request->zipcode;
        $address['state'] = $request->state;
        $address['city'] = $request->city;    
        $address['set_as'] = 'primary';
        
        $insert_address = new UserAddress;
        $insert_address->fill($address);   

        if($insert_address->save()){

            // set secondary all address of auth user START
            $update = UserAddress::where('user_id',Auth::user()->id)->where('id','!=',$insert_address->id)->update(['set_as' => 'secondary']);
            // set secondary all address of auth user END
        
        }

    }

    // order

    $order['user_id'] = Auth::user()->id;
    $order['ordernumber'] = uniqid();
    $order['subtotal'] = $cart_total;
    $order['tax'] = 0.00;
    $order['delivery_charge'] = 0.00;
    $order['discount'] = 0.00;
    $order['promo'] = 0;
    $order['grand_total'] = $cart_total;
    $order['note'] = $request->note;
    $order['address'] = $insert_address->id;
    $order['payment_method'] = 'pending';

    $order['order_status'] = 'pending_for_call';
    $order['payment_status'] = 'pending';
    $order['payment_method'] = 'pending'; 

    $insertorder = new Order;
    $insertorder->fill($order);

    if($insertorder->save()){

        $cart = Cart::where('user_id',Auth::user()->id)->get();

        foreach($cart as $cart_row){

        $product = Product::where('id',$cart_row['product'])->first();    

        $orderProduct['user_id'] = Auth::user()->id;
        $orderProduct['order_id'] = $insertorder->id;
        $orderProduct['product_id'] = $cart_row->product;
        $orderProduct['uniqueId'] = $cart_row->uniqueId;
        $orderProduct['product_name'] = $product->name;
        $orderProduct['product_unit'] = $product->product_unit;
        $orderProduct['size'] = $cart_row->size;
        $orderProduct['price'] = $cart_row->price;
        $orderProduct['qty'] = $cart_row->qty;

        $insertorderproduct = new OrderProduct;
        $insertorderproduct->fill($orderProduct);
        $insertorderproduct->save();

        }      
        
        
        if($insertorder->order_status == 'pending_for_call'){

            $deleteCart = Cart::where('user_id',Auth::user()->id)->delete(); 
            
        // Twillio START 

            // $token = '9f766355337c4ccc7e52dfcdd50fcc74';
            // $twilio_sid = 'AC61499d8950f5fb61b141aa39828e5475';
            // $twilio_verify_sid = 'VAca099701d885e77b59a0f78278545199';       
            
            // $twilio = new Client($twilio_sid,$token);          
            
            // $message = $twilio->messages
            //       ->create("+918401934536", // to
            //                ["body" => "New order found,Please check ADMIN panel", "from" => "+12532014537"]
            //       );
           
        // Twillio END

            $notification = array(
                'message' => 'Order Placed Successfully,Admin will confirm you.',
                'alert-type' => 'success'
            );
    
            return redirect('/')->with($notification);    
        }        

    }  
    
    $notification = array(
        'message' => 'Order did not placed,please contact admin.',
        'alert-type' => 'failed'
    );

    return redirect('/')->with($notification);    

  }

  public function slip_upload(Request $request){
    
    $this->validate($request,[          
        'order' => 'required|numeric', 
        'file' => 'required|image|mimes:jpeg,png,jpg'          
    ]);

    $file = $request->file('file');
    $filename = 'slip'. '-' . uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(storage_path('app/public/slip'), $filename);
    $data['slip'] = $filename;

    // remove old slip if exist START
    $check = Order::where('id',$request->order)->first();

    if(!empty($check)){
        if(!empty($check->slip)){            
            if(file_exists(storage_path('app/public/slip/'.$check['slip'])))
            {                
                unlink(storage_path('app/public/slip/'.$check['slip']));                
            }
        }
    }
    // remove old slip if exist END

    $update = Order::where('id',$request->order)->update($data);

    if($update){
        return response()->json('uploaded');
    }
        return response()->json('denied');
  }

  public function do_contact_us(Request $request){

    $this->validate($request, [          
        'name' => 'required|regex:/^[\pL\s]+$/u',         
        'email' => 'nullable|email',        
        'contact' => 'required|regex:/[0-9]{10}/|digits:10|numeric',
        'message' => 'required|string'       
    ]);

    $data = $request->all();

    $contact = new ContactUs;
    $contact->fill($data);
    
    if($contact->save()){

        $notification = array(
            'message' => 'Message sent Successfully,Support will contact you soon',
            'alert-type' => 'success'
        );

        return redirect('contactus')->with($notification);    

    }
  }

  public function product_search(Request $request){

    $this->validate($request,[          
        'string' => 'required|string'         
    ]);

    $product = Product::select('name')->where('name','LIKE',"%{$request->string}%")->where('status','active')->get();

    if(!empty($product)){
        return response()->json(['data' => $product]);
    }   
        return response()->json(['data' =>'nodata']);
  }

  public function search_result(Request $request){

    $this->validate($request,[          
        'search' => 'required|string'         
    ]);
    
    $string = explode(" ",$request->search);      
              
    $product = Product::where('status','active')->Where(function ($query) use($string) {
                foreach($string as $str){
                    $query->orwhere('name', 'like', '%' . $str .'%');
                }      
            })->get();

    $banner = Slider::where('status','active')->get();        

    return view('front.search',compact('product','banner'));  
      
  }

  public function pay(Request $request){   

    $this->validate($request,[          
        'payment_method' => 'required',         
        'total_amount' => 'required|numeric',         
        'pay_order' => 'required|numeric'         
    ]);

    if($request->payment_method == 'online'){

        $this->validate($request,[          
            'transaction_id' => 'required'
        ]);  

    }

    $update['payment_method'] = $request->payment_method;
    $update['transaction_id'] = $request->transaction_id;
    

    if($request->payment_method == 'banktransfer' || $request->payment_method == 'cashondelivery' || $request->payment_method == 'angadia'){
        $update['payment_status'] = 'pending';
        $update['order_status'] = 'pending';
    } 

    if($request->payment_method == 'online' && !empty($request->transaction_id)){
        $update['payment_status'] = 'success';
        $update['order_status'] = 'confirm';
    }    
     
    $update_order = Order::where('id',$request->pay_order)->update($update);

    if($update_order){

    // Payment 

     $payment['user_id'] = Auth::user()->id;
     $payment['order_id'] = $request->pay_order;
     $payment['payment_method'] = $request->payment_method;
     $payment['transaction_id'] = $request->transaction_id;
     $payment['card_last'] = 0;
     $payment['card_expire'] = 0;
     $payment['payment_status'] = $update['payment_status'];

     $insertpayment = new Payment;
     $insertpayment->fill($payment);
     $insertpayment->save();

    // order status 

     $orderstatus['user_id'] = Auth::user()->id;
     $orderstatus['order_id'] = $request->pay_order;
     $orderstatus['order_status'] =  $update['order_status'];

     $insertstatus = new OrderStatus;
     $insertstatus->fill($orderstatus);
     $insertstatus->save();    

        $notification = array(
            'message' => 'Payment confirm successfully..!',
            'alert-type' => 'success'
        );

        return redirect('profile')->with($notification);
    }
    
    $notification = array(
        'message' => 'Payment confirm Failed..!',
        'alert-type' => 'failed'
    );

    return redirect('profile')->with($notification);

  }

  public function privacy(){

    return view('front.privacy');

  }

}
