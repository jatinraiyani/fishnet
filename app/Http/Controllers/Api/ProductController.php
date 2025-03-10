<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Type;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductBrand;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Cart;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\AdBanner;
use Twilio\Rest\Client;

class ProductController extends Controller
{
    public function product_list(){

        $product = Product::get();

        if(!empty($product)){       

        foreach($product as $k => $row){            
            
        // product type 
        $product[$k]['type_id'] = $row->product_type;

        // product category
        $product[$k]['category_id'] = $row->product_category;

        // product images       

        $product[$k]['images'] = $row->product_image;

        foreach($product[$k]['images'] as $im => $img){
          $product[$k]['images'][$im]['image'] = url('storage/app/public/product/'.$img->image);
        }
        // $product[$k]['images'] = url('storage/app/public/product/'.$row->image);

        // product size

        $product[$k]['size'] = $row->product_size;

        foreach($product[$k]['size'] as $si => $size){
          $product[$k]['size'][$si]['chart'] = url('storage/app/public/chart/'.$size->chart);
        }

        // product color

        // $product[$k]['color'] = $row->product_color;      
        
        // product brand

        $product_brand = ProductBrand::where('product_id',$row->id)->get();
        
        $brand = [];
        foreach($product_brand as $p => $dos){ 
            
        $brandName = Brand::where('id',$dos->brand_id)->first();  
                array_push($brand,$brandName->name);                
            $product[$k]['brand'] = $brand;            
          }
        }
        return response()->json(['status'=> 1,'message'=> 'Product get successfull','data'=>$product],200);
      } else {
        return response()->json(['status'=> 0,'message'=> 'No data found','data'=> null],400);
      }
    }

    public function product_by_type(Request $request){
        $rule=[
            'type'=>'required|numeric'
        ];

        $message=[
          'type.required'=>'Type Id is required'
        ];

        $validate = Validator::make($request->all(),$rule,$message);

        if($validate->fails())
        {
            return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
        }

        $product = Product::where('type_id',$request->type)->get();

        if(count($product) > 0){       

        foreach($product as $k => $row){            
            
        // product type 
        $product[$k]['type_id'] = $row->product_type;

        // product category
        $product[$k]['category_id'] = $row->product_category;

        // product images

        $product[$k]['images'] = $row->product_image;

        foreach($product[$k]['images'] as $im => $img){
          $product[$k]['images'][$im]['image'] = url('storage/app/public/product/'.$img->image);
        }

        // product size

        $product[$k]['size'] = $row->product_size;

        foreach($product[$k]['size'] as $si => $size){
          $product[$k]['size'][$si]['chart'] = url('storage/app/public/chart/'.$size->chart);
        }

        // product color

        // $product[$k]['color'] = $row->product_color;      
        
        // product brand

        $product_brand = ProductBrand::where('product_id',$row->id)->get();
        
        $brand = [];
        foreach($product_brand as $p => $dos){ 
            
        $brandName = Brand::where('id',$dos->brand_id)->first();  
                array_push($brand,$brandName->name);                
            $product[$k]['brand'] = $brand;            
          }
        }
        return response()->json(['status'=> 1,'message'=> 'Product get successfull','data'=>$product],200);
      } else {
        return response()->json(['status'=> 0,'message'=> 'No data found','data'=> null],400);
      }
    }

    public function product_by_category(Request $request){
      
        $rule=[
            'category'=>'required|numeric'
        ];

        $message=[
          'category.required'=>'Category Id is required'
        ];

        $validate = Validator::make($request->all(),$rule,$message);

        if($validate->fails())
        {
            return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
        }

        $product = Product::where('category_id',$request->category)->paginate(10);

        if(!empty($product)){       

        foreach($product as $k => $row){            
            
        // product type 
        $product[$k]['type_id'] = $row->product_type;

        // product category
        $product[$k]['category_id'] = $row->product_category;

        // product images

        $product[$k]['images'] = $row->product_image;

        foreach($product[$k]['images'] as $im => $img){
          $product[$k]['images'][$im]['image'] = url('storage/app/public/product/'.$img->image);
        }

        // product size

        $product[$k]['size'] = $row->product_size;

        foreach($product[$k]['size'] as $si => $size){
          $product[$k]['size'][$si]['chart'] = url('storage/app/public/chart/'.$size->chart);
        }

        // product color

        // $product[$k]['color'] = $row->product_color;      
        
        // product brand

        $product_brand = ProductBrand::where('product_id',$row->id)->get();
        
        $brand = [];
        foreach($product_brand as $p => $dos){ 
            
        $brandName = Brand::where('id',$dos->brand_id)->first();  
                array_push($brand,$brandName->name);                
            $product[$k]['brand'] = $brand;            
          }
        }
        return response()->json(['status'=> 1,'message'=> 'Product get successfull','data'=>$product],200);
      } else {
        return response()->json(['status'=> 0,'message'=> 'No data found','data'=> null],400);
      }
    }

    public function product_by_subcategory(Request $request){      

      $rule=[
        'category'=>'required|numeric',
        'subcategory'=>'nullable|numeric'
      ];

      $message=[
        'category.required'=>'Category Id is required'
      ];

      $validate = Validator::make($request->all(),$rule,$message);

    if($validate->fails())
    {
        return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
    }

    $product = Product::where('subcategory_id',$request->subcategory)->get();

    if(count($product) == 0){
      $product = Product::where('category_id',$request->category)->get();
     
    }

    if(count($product) > 0){       

    foreach($product as $k => $row){            
        
    // product type 
    $product[$k]['type_id'] = $row->product_type;

    // product category
    $product[$k]['category_id'] = $row->product_category;

    // product images

    $product[$k]['images'] = $row->product_image;

    foreach($product[$k]['images'] as $im => $img){
      $product[$k]['images'][$im]['image'] = url('storage/app/public/product/'.$img->image);
    }

    // product size

    $product[$k]['size'] = $row->product_size;

    foreach($product[$k]['size'] as $si => $size){
      $product[$k]['size'][$si]['chart'] = url('storage/app/public/chart/'.$size->chart);
    }

    // product color

    // $product[$k]['color'] = $row->product_color;      
    
    // product brand

    $product_brand = ProductBrand::where('product_id',$row->id)->get();
    
    $brand = [];
    foreach($product_brand as $p => $dos){ 
        
    $brandName = Brand::where('id',$dos->brand_id)->first();  
            array_push($brand,$brandName->name);                
        $product[$k]['brand'] = $brand;            
      }
    }
    return response()->json(['status'=> 1,'message'=> 'Product get successfull','data'=>$product],200);
  } else {
    return response()->json(['status'=> 0,'message'=> 'No data found','data'=> null],400);
  }

    }

public function product_detail(Request $request){

  $rule=[
    'product_id'=>'required|numeric'
  ];

  $message=[
    'product_id.required'=>'Product id is required',
    'product_id.numeric'=>'Product id should in numeric'
  ];

  $validate = Validator::make($request->all(),$rule,$message);

  if($validate->fails())
  {
      return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
  }

  $product = Product::where('id',$request->product_id)->first();

  // product type 
  $product->type_id = $product->product_type;
  $product->category_id = $product->product_category;
  $product->subcategory_id = $product->product_subcategory; 
  

  $product->image = $product->product_image;

  foreach($product->product_image as $im => $img){
    $product->product_image[$im]['image'] = url('storage/app/public/product/'.$img->image);
  }

  $product->size = $product->product_size;

  foreach($product->product_size as $si => $size){
    $product->product_size[$si]['chart'] = url('storage/app/public/chart/'.$size->chart);
  }
  
  // product brand

  $product_brand = ProductBrand::where('product_id',$product->id)->get();
  
  $brand = [];

  foreach($product_brand as $p => $dos){ 
      
    $brandName = Brand::where('id',$dos->brand_id)->first();  
          array_push($brand,$brandName->name);                
      $product->brand = $brand;            
    }
  
  return response()->json(['status'=> 1,'message'=> 'Product get successfull','data'=>$product],200);

}   

public function add_cart(Request $request){ 

  $var = (object)$request->all(); 

  // if($var->cart != NULL){
  //   $delete_cart = Cart::where('user_id',$request->user_data['user_id'])->delete();  
  // }
  
  foreach($var->cart as $row){  

    $check = Cart::where('user_id',$request->user_data['user_id'])->where('product',$row['product'])
    ->where('product_unit',$row['product_unit'])->where('size',$row['size'])->first();

    if(!empty($check)){

      $update = Cart::where('user_id',$request->user_data['user_id'])->where('product',$row['product'])
      ->where('product_unit',$row['product_unit'])->where('size',$row['size'])
      ->update(['price' => $row['price'],'qty' => $check->qty + $row['qty']]);

    } else {

    $data['user_id'] = $request->user_data['user_id'];
    $data['uniqueId'] = $row['uniqueId'];
    $data['product'] = $row['product'];
    $data['type'] = $row['type'];
    $data['product_unit'] = $row['product_unit'];
    $data['category'] = $row['category'];
    $data['subcategory'] = $row['subcategory'];
    $data['price'] = $row['price'];
    $data['size'] = $row['size'];
    $data['qty'] = $row['qty'];

    $cart_insert = new Cart;
    $cart_insert->fill($data);
    $cart_insert->save($data);

    }

  } 

  $get_user_cart = Cart::where('user_id',$request->user_data['user_id'])->get();

  if($get_user_cart){

    $cart_product = [];
    $cart_total = 0;

    foreach($get_user_cart as $cart_row){  
      
      $product = Product::where('id',$cart_row['product'])->first();     
      

      $current_size = explode('-',$cart_row['size']);  
      $c_size = $current_size[0];
      $c_unit = $current_size[1];
      
      $size_data = ProductSize::where('product_id',$cart_row['product'])->where('size',$c_size)->where('size_unit',$c_unit)->first();                 
                      
      $current_product['uniqueId'] = $cart_row['uniqueId'];
      $current_product['id'] = $product->id;      
      $current_product['type'] = $product->product_type->name;
      $current_product['product_unit'] = $product->product_unit;
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
     $data = ['cart' => $cart_product,'total' => $cart_total];
    return response()->json(['status'=> 1,'message'=> 'Product save successfull in cart','data'=> $data],200);
  }
  
  return response()->json(['status'=> 1,'message'=> 'Something went wrong','data'=> null],400);

}

public function get_cart(Request $request){  

  $cart = Cart::where('user_id',$request->user_data['user_id'])->get();  

  $cart_product = [];
  $cart_total = 0;

  if(!empty($cart)){

  foreach($cart as $carts){

    $product = Product::where('id',$carts['product'])->first();   
                    
    $current_product['uniqueId'] = $carts['uniqueId'];
    $current_product['id'] = $product['id'];
    $current_product['type'] = $product->product_type->name;
    $current_product['product_unit'] = $product->product_unit;
    $current_product['category'] = $product->product_category->name;
    $current_product['subcategory'] = @$product->product_subcategory->name;
    $current_product['name'] = $product->name;
    $current_product['image'] = url('storage/app/public/product/'.$product->product_image[0]['image']);
    $current_product['price'] = $carts->price;
    $current_product['qty'] = $carts['qty'];
    $current_product['size'] = str_replace("-"," ",$carts['size']);
    $current_product['product_total'] = $carts['qty'] * $carts->price;

    $cart_total = $cart_total + ($carts['qty'] * $carts->price);

    array_push($cart_product,$current_product);
  }
}

   $data = ['cart_product' => $cart_product,'cart_total' => $cart_total,'cort_count' => count($cart)];

  return response()->json(['status'=> 1,'message'=> 'Product get successfull from cart','data'=> $data],200);

}

public function delete_cart_item(Request $request){

  $rule=[    
    'uniqueId'=>'required',
    'product'=>'required|numeric'
    ];

  $message=[    
    'product.required'=>'Product id is required',
    'product.numeric'=>'Product id should in numeric',
    'uniqueId.required'=>'Unique id should in numeric'   
  ];

  $validate = Validator::make($request->all(),$rule,$message);

  if($validate->fails())
  {
      return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
  }

  $cartdelete = Cart::where('user_id',$request->user_data['user_id'])->where('uniqueId',$request->uniqueId)->where('product',$request->product)->delete();

  if($cartdelete){
    return response()->json(['status'=> 1,'message'=> 'Product deleted successfull from cart','data'=> null],200);
  }
   return response()->json(['status'=> 1,'message'=> 'Something went wrong','data'=> null],400);

}

public function search(Request $request){  

$rule=[    
  'search' => 'required|string'  
  ];

$message=[    
  'search.required'=>'Product name is required',
  'product.string'=>'Product name should in string'   
];

$validate = Validator::make($request->all(),$rule,$message);

if($validate->fails())
{
    return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
}

$string = explode(" ",$request->search);      
          
$product = Product::where('status','active')->Where(function ($query) use($string) {
            foreach($string as $str){
                $query->orwhere('name', 'like', '%' . $str .'%');
            }      
        })->get();

    foreach($product as $k => $row){            
        
      // product type 
      $product[$k]['type_id'] = $row->product_type;

      // product category
      $product[$k]['category_id'] = $row->product_category;

      // product images

      $product[$k]['images'] = $row->product_image;

      foreach($product[$k]['images'] as $im => $img){
        $product[$k]['images'][$im]['image'] = url('storage/app/public/product/'.$img->image);
      }

      // product size

      $product[$k]['size'] = $row->product_size;

      foreach($product[$k]['size'] as $si => $size){
        $product[$k]['size'][$si]['chart'] = url('storage/app/public/chart/'.$size->chart);
      }

      // product color

      // $product[$k]['color'] = $row->product_color;      
      
      // product brand

      $product_brand = ProductBrand::where('product_id',$row->id)->get();
      
      $brand = [];
      foreach($product_brand as $p => $dos){ 
          
      $brandName = Brand::where('id',$dos->brand_id)->first();  
              array_push($brand,$brandName->name);                
          $product[$k]['brand'] = $brand;            
        }
      }        



if(!empty($product)){
  return response()->json(['status'=> 1,'message'=> 'search Product get successfull','data'=> $product],200);
}

  return response()->json(['status'=> 1,'message'=> 'No product found','data'=> null],200);

}

public function filter(Request $request){

    $rule=[    
      'category' => 'numeric',  
      'brand.*' => 'numeric' 
    ];
    
    $message=[    
      'category.numeric'=>'Category should in numeric',
      'brand.numeric'=>'Brand should in numeric'
    ];
    
    $validate = Validator::make($request->all(),$rule,$message);
    
    if($validate->fails())
    {
        return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
    }

    if(($request->category && $request->brand) || ($request->category && !$request->brand)){
        $product = Product::with(['product_image'])->where('category_id',$request->category)->where('status','active')->get();
    } elseif(!$request->category && $request->brand){
        $product = Product::with(['product_image'])->where('status','active')->get();
    } else {
        $product = Product::with(['product_image'])->where('category_id',$request->category)->where('status','active')->get();
    }

    
        if(!empty($product)){
            foreach($product as $l => $product_row){                     
                if($request->brand){                                
                    foreach($product_row->product_brand as $brands){                            
                        if(!in_array($brands['brand_id'],$request['brand'])){                                
                            $product->forget($l);
                        } 
                    }
                }
            }

            foreach($product as $k => $row){            
        
              // product type 
              $product[$k]['type_id'] = $row->product_type;
        
              // product category
              $product[$k]['category_id'] = $row->product_category;
        
              // product images
        
              $product[$k]['images'] = $row->product_image;
        
              foreach($product[$k]['images'] as $im => $img){
                $product[$k]['images'][$im]['image'] = url('storage/app/public/product/'.$img->image);
              }
        
              // product size
        
              $product[$k]['size'] = $row->product_size;
        
              foreach($product[$k]['size'] as $si => $size){
                $product[$k]['size'][$si]['chart'] = url('storage/app/public/chart/'.$size->chart);
              }
        
              // product color
        
              // $product[$k]['color'] = $row->product_color;      
              
              // product brand
        
              $product_brand = ProductBrand::where('product_id',$row->id)->get();
              
              $brand = [];
              foreach($product_brand as $p => $dos){ 
                  
              $brandName = Brand::where('id',$dos->brand_id)->first();  
                      array_push($brand,$brandName->name);                
                  $product[$k]['brand'] = $brand;            
                }
              }            
          
              return response()->json(['status'=> 1,'message'=> 'Filter Product get successfull','data'=> $product],200);
        }

        return response()->json(['status'=> 1,'message'=> 'No product found','data'=> null],200);

 }

 public function size_chart(Request $request){

  $rule=[    
    'size_id' => 'required|numeric'
  ];
  
  $message=[    
    'size_id.required'=>'Product id is required',
    'size_id.numeric'=>'Product id should in numeric'
  ];
  
  $validate = Validator::make($request->all(),$rule,$message);
  
  if($validate->fails())
  {
      return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
  } 

  $chart = ProductSize::where('id',$request->size_id)->first();
  $chart->chart = url('storage/app/public/chart/'.$chart->chart);
  if($chart){
    return response()->json(['status'=> 1,'message'=> 'Chart get successfull','data'=> $chart],200);
  }
    return response()->json(['status'=> 0,'message'=> 'No Chart found','data'=> null],400);
 }

 public function qty_update(Request $request){

  $rule=[    
    'product' => 'required|numeric',
    'size' => 'required',
    'qty' => 'required|numeric'
  ];
  
  $message=[    
    'product.required'=>'Product id is required',
    'product.numeric'=>'Product id should in numeric',
    'size.required'=>'Size is required',
    'qty.required'=>'Quantity is required',
    'qty.numeric'=>'Quantity should in numeric'
  ];
  
  $validate = Validator::make($request->all(),$rule,$message);
  
  if($validate->fails())
  {
      return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
  } 

  $check = Cart::where('user_id',$request->user_data['user_id'])->where('product',$request->product)->where('size',$request->size)->first();

   if(!empty($check)){

    $check->update(['qty' => $request['qty']]);

    return response()->json(['status'=> 1,'message'=> 'Qty update successfull','data'=> $check],200);

   }  

   return response()->json(['status'=> 0,'message'=> 'No product found in cart','data'=> null],400);
  
 }

 public function checkout(Request $request){

  $rule=[    
    'name' => 'required|regex:/^[\pL\s]+$/u',         
    'email' => 'nullable|email',        
    'contact' => 'required|regex:/[0-9]{10}/|digits:10|numeric',
    'address' => 'required|string',
    'zipcode' => 'required|numeric',
    'state' => 'required',
    'city' => 'required' 
  ];

  $message=[    
    'name.required'=>'Name is required',
    'name.regex'=>'Name Should in valid format',
    'email.email'=>'Email id should in valid format',
    'contact.required'=>'Contact is required',
    'contact.regex'=>'Contact should in valid format',
    'contact.digits'=>'Contact should in 10 digits',
    'address.required'=>'Address is required',
    'address.string'=>'Address Should in valid format',
    'zipcode.required'=>'Zipcode is required',
    'zipcode.numeric'=>'Zipcode should in numeric',
    'state.required'=>'State is required',
    'city.required'=>'City is required'
  ];

  $validate = Validator::make($request->all(),$rule,$message);

  if($validate->fails())
  {
      return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
  } 


//get cart data 

 $cart = Cart::where('user_id',$request->user_data['user_id'])->get();

 $cart_total = 0;
 $cart_product = [];

 foreach($cart as $cart_row){

    $product = Product::where('id',$cart_row['product'])->first();

    $cart_total = $cart_total + ($cart_row['qty'] * $cart_row['price']);        
 } 
 
 if($cart_total < 5000){
    return response()->json(['status'=> 0,'message'=> 'You need to purchase minimum 5000 RS.','data'=> NULL],400);
 }

// Store Address 

$insert_address = UserAddress::where('user_id',$request->user_data['user_id'])
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

    $address['user_id'] = $request->user_data['user_id'];
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
        $update = UserAddress::where('user_id',$request->user_data['user_id'])->where('id','!=',$insert_address->id)->update(['set_as' => 'secondary']);
        // set secondary all address of auth user END
    
    }

}

// order

$order['user_id'] = $request->user_data['user_id'];
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

    $cart = Cart::where('user_id',$request->user_data['user_id'])->get();

    foreach($cart as $cart_row){

    $product = Product::where('id',$cart_row['product'])->first();    

    $orderProduct['user_id'] = $request->user_data['user_id'];
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

        $deleteCart = Cart::where('user_id',$request->user_data['user_id'])->delete(); 
        
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

    return response()->json(['status'=> 1,'message'=> 'Order Placed Successfully,Admin will confirm you.','data'=> NULL],200);  
    }        

}  

    return response()->json(['status'=> 0,'message'=> 'Order did not placed,please contact admin.','data'=> NULL],400);

 }

 public function pay(Request $request){

  $rule=[    
      'payment_method' => 'required',         
      'total_amount' => 'required|numeric',         
      'pay_order' => 'required|numeric'    
  ];

  $message=[    
      'payment_method.required'=>'Payment Method is required',
      'total_amount.numeric'=>'Total Amount should in numeric',
      'total_amount.required'=>'Total Amount is required',
      'pay_order.required'=>'Order Id is required',
      'pay_order.numeric'=>'Order Id should in numeric'
  ];

if($request['payment_method'] == 'online'){

    $rule=[    
      'transaction_id' => 'required'  
    ];

    $message=[    
        'transaction_id.required'=>'Transaction Id is required'
    ];  

}

$validate = Validator::make($request->all(),$rule,$message);

if($validate->fails())
{
    return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
} 

$update['payment_method'] = $request['payment_method'];
$update['transaction_id'] = $request['transaction_id'];


if($request['payment_method'] == 'banktransfer' || $request['payment_method'] == 'cashondelivery' || $request['payment_method'] == 'angadia'){
    $update['payment_status'] = 'pending';
    $update['order_status'] = 'pending';
} 

if($request['payment_method'] == 'online' && !empty($request['transaction_id'])){
    $update['payment_status'] = 'success';
    $update['order_status'] = 'confirm';
}    
 
$update_order = Order::where('id',$request['pay_order'])->update($update);

if($update){

// Payment 
   
 $payment['user_id'] = $request->user_data['user_id'];
 $payment['order_id'] = $request['pay_order'];
 $payment['payment_method'] = $request['payment_method'];
 $payment['transaction_id'] = $request['transaction_id'];
 $payment['card_last'] = 0;
 $payment['card_expire'] = 0;
 $payment['payment_status'] = $update['payment_status'];

 $insertpayment = new Payment;
 $insertpayment->fill($payment);
 $insertpayment->save();

// order status 

 $orderstatus['user_id'] = $request->user_data['user_id'];
 $orderstatus['order_id'] = $request['pay_order'];
 $orderstatus['order_status'] =  $update['order_status'];

 $insertstatus = new OrderStatus;
 $insertstatus->fill($orderstatus);
 $insertstatus->save();

    return response()->json(['status'=> 1,'message'=> 'Payment confirm successfully..!','data'=> NULL],200);
 }

    return response()->json(['status'=> 0,'message'=> 'Payment confirm Failed..!','data'=> NULL],400);

 }

 public function order_list(Request $request){   

  $order = Order::where('user_id',$request->user_data['user_id'])->get();
  

  if(!empty($order)){

  foreach($order as $k => $order_row){     
    $order_row['address'] = $order_row->delivery_address;
    foreach($order_row->order_product as $pi => $product_row){      
      $order_row->order_product[$pi]['image'] = url('storage/app/public/product/'.$product_row->product_image->product_image[0]->image);      
    }    
  } 
  
  return response()->json(['status'=> 1,'message'=> 'Order list get successfully..!','data'=> $order],200);
  }
  return response()->json(['status'=> 1,'message'=> 'No order Found','data'=> NULL],200);
 }

public function slip_upload(Request $request){

  $rule=[    
    'order' => 'required|numeric', 
    'file' => 'required|image|mimes:jpeg,png,jpg'
  ];

  $message=[    
      'order.required'=>'Order Id is required',
      'order.numeric'=>'Order Id Should in number format',
      'file.required'=>'File is required',
      'file.image'=>'File should as image',
      'file.mimes'=>'File should be in jpeg,png,jpg format'
  ];  

  $validate = Validator::make($request->all(),$rule,$message);

  if($validate->fails())
  {
      return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
  } 

  $file = $request->file('file');
  $filename = 'slip'. '-' . uniqid() . '.' . $file->getClientOriginalExtension();
  $file->move(storage_path('app/public/slip'), $filename);
  $data['slip'] = $filename;

  // remove old slip if exist START
  $check = Order::where('id',$request['order'])->first();

  if(!empty($check)){
      if(!empty($check->slip)){            
          if(file_exists(storage_path('app/public/slip/'.$check['slip'])))
          {                
              unlink(storage_path('app/public/slip/'.$check['slip']));                
          }
      }
  }
  // remove old slip if exist END

  $update = Order::where('id',$request['order'])->update($data);

  if($update){
    $order = Order::where('id',$request['order'])->first();
    return response()->json(['status'=> 1,'message'=> 'Slip uploaded successfully..!','data'=> $order],200);
  }
    return response()->json(['status'=> 0,'message'=> 'Something went wrong','data'=> NULL],400);

  } 

  public function home(Request $request){

    $data = Product::with(['product_image'])->get();    

    foreach($data as $k => $data_row){      
      foreach($data_row->product_image as $i => $img){
        $data_row->product_image[$i]['image'] = url('storage/app/public/product/'.$data_row->product_image[$i]['image']);
      }
      
      $getType = Type::where('id',$data_row['type_id'])->first();
      $data[$k]['type_name'] = $getType->name;
      
    }
            
    // $product = $data->sortBy('type_id')->groupBy('type_id');

    if(!empty($data)){
        return response()->json(['status' => 1,'message' => 'Product get successfully','data' => $data],200);
    }

  }

  public function promo_banner(Request $request){

    $banner = AdBanner::where('status','active')->get();

    if(count($banner) > 0){

      foreach($banner as $i => $row){

        $banner[$i]['image'] = url('storage/app/public/promobanner/'.$banner[$i]['image']);
      }     
    }
    return response()->json(['status' => 1,'message' => 'Promobanner get successfully','data' => $banner],200);
  }

}

