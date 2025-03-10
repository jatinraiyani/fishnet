<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Brand;
use App\Models\ProductBrand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Session;

class ProductController extends Controller
{
    public function index(){

        $data = Product::get();        

        foreach($data as $k => $row){                      
          $product_brand = ProductBrand::where('product_id',$row->id)->get();
          
          $brand = [];
          foreach($product_brand as $p => $dos){ 

            
              
          $brandName = Brand::where('id',$dos->brand_id)->first();  
               array_push($brand,@$brandName->name);                
            $data[$k]['brand'] = $brand;            
          }
        }     
        return view('admin.product.index',compact('data'));
    }

    public function create(){

        $type = Type::get()->pluck('name','id');    
        $brands = Brand::get()->pluck('name','id');    

        return view('admin.product.create',compact('type','brands'));

    }

    public function store(Request $request){ 
       
        $this->validate($request,[          
            'name' => 'required',          
            'type_id' => 'required|numeric',          
            'category_id' => 'required|numeric',          
            'subcategory_id' => 'nullable|numeric', 
            'product_unit' => 'required',         
            'description' => 'required',          
            'brand.*' => 'required',          
            'images.*' => 'required|image|mimes:jpeg,jpg,png',          
            'size_unit.*' => 'required',          
            'size.*' => 'required|numeric',          
            'size_price.*' => 'required|numeric',
            'size_available.*' => 'required',         
            'price' => 'required|numeric',   
            'old_price' => 'required|numeric'    
        ]);

        if($request->product_unit == 'weight'){

            $this->validate($request,[
                'chart.*' => 'required|image|mimes:jpeg,jpg,png'
            ]);

        }

        $data = $request->all();        
        
        $data = $request->except(['images','size_unit','size','size_price','size_available','brand','chart']);

        $storeProduct = new Product;
        $storeProduct->fill($data);
        $storeProduct->save();
        
        // upload images
        
        foreach($request->images as $img){  
                      
            $filename  = "product-".uniqid().'.'.$img->getClientOriginalExtension();
            $img->move(storage_path('app/public/product'), $filename);
            
            $imgData['product_id'] = $storeProduct->id;
            $imgData['image'] = $filename;

            $storeImage = new ProductImage;
            $storeImage->fill($imgData);
            $storeImage->save();
        }   
         
        // brand 

        for($i=0;$i < count($request['brand']);$i++){

            $brandData['product_id'] = $storeProduct->id;
            $brandData['brand_id'] = $request['brand'][$i];           

            $storeProductBrand = new ProductBrand;
            $storeProductBrand->fill($brandData);
            $storeProductBrand->save();
        }

        
        // size 
       
        for($i=0;$i < count($request['size_unit']);$i++){

          $sizeData['product_id'] = $storeProduct->id;
          $sizeData['size_unit'] = $request['size_unit'][$i];
          $sizeData['size'] = $request['size'][$i];
          $sizeData['price'] = $request['size_price'][$i];
          $sizeData['size_available'] = $request['size_available'][$i];

          // chart upload START  
          $img = $request['chart'][$i];
          $filename  = "chart-".uniqid().'.'.$img->getClientOriginalExtension();
          $img->move(storage_path('app/public/chart'), $filename);
          $sizeData['chart'] = $filename;
          // chart upload END   

          $storeSize = new ProductSize;
          $storeSize->fill($sizeData);
          $storeSize->save();

        }
       
        if($storeProduct && $storeSize){           
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Product Added Successfully.!! </div>');
            return redirect('admin/product');
        }
    }

    public function edit($id){       

        $data = Product::where('id',$id)->first(); 
        $type = Type::get()->pluck('name','id');
        $brands = Brand::get()->pluck('name','id');
        $category = Category::where('type_id',$data->type_id)->pluck('name','id');
        $selectedCategory = @$data->product_category->id;  
        $subCategory = SubCategory::where('category_id',$data->category_id)->pluck('name','id');
        $selectedSubCategory = @$data->product_subcategory->id;           
        $selectedBrands = ProductBrand::where('product_id',$id)->pluck('brand_id');      
    

        return view('admin.product.edit',compact('data','type','brands','category','selectedCategory','selectedBrands','subCategory','selectedSubCategory'));
    }

    public function update(Request $request, $id){         
       
        $this->validate($request, [          
            'name' => 'required',          
            'type_id' => 'required|numeric',          
            'category_id' => 'required|numeric',          
            'subcategory_id' => 'nullable|numeric', 
            'product_unit' => 'required',         
            'description' => 'required',          
            'product_size_id.*' => 'required|numeric',          
            'size_unit.*' => 'required',          
            'size.*' => 'required|numeric', 
            'size_price.*' => 'required|numeric',         
            'size_available.*' => 'required',         
            'price' => 'required|numeric',
            'old_price' => 'required|numeric'
        ]);

       

        $data = $request->all();
        $data = $request->except(['_token','images','size_unit','size','product_size_id','size_price','chart','size_available','brand']);

       

        $update = Product::where('id',$id)->update($data);

        if($update){
           

        if($request->images) { 

            $this->validate($request,[          
                'images.*' => 'required|image|mimes:jpeg,jpg,png', 
            ]);  

            // upload images
        
            foreach($request->images as $img){            
                $filename  = "product-".uniqid().'.'.$img->getClientOriginalExtension();
                $img->move(storage_path('app/public/product'), $filename);
                
                $imgData['product_id'] = $id;
                $imgData['image'] = $filename;

                $storeImage = new ProductImage;
                $storeImage->fill($imgData);
                $storeImage->save();
            }       

        }

        // brand 
        $deleteSize = ProductBrand::where('product_id',$id)->delete();

        for($i=0;$i < count($request['brand']);$i++){

            $brandData['product_id'] = $id;
            $brandData['brand_id'] = $request['brand'][$i];           

            $storeProductBrand = new ProductBrand;
            $storeProductBrand->fill($brandData);
            $storeProductBrand->save();
        }


        // size 
        // $deleteSize = ProductSize::where('product_id',$id)->delete();

        for($i=0;$i < count($request['size_unit']);$i++){

         if($request['product_size_id'][$i] == 0){

            $sizeData['product_id'] = $id;
            $sizeData['size_unit'] = $request['size_unit'][$i];
            $sizeData['size'] = $request['size'][$i];
            $sizeData['price'] = $request['size_price'][$i];
            $sizeData['size_available'] = $request['size_available'][$i];

            // chart upload START  
            $img = $request['chart'][$i];
            $filename  = "chart-".uniqid().'.'.$img->getClientOriginalExtension();
            $img->move(storage_path('app/public/chart'), $filename);
            $sizeData['chart'] = $filename;
            // chart upload END 

            $storeSize = new ProductSize;
            $storeSize->fill($sizeData);
            $storeSize->save();

         } else {

            $get_exists = ProductSize::where('id',$request['product_size_id'][$i])->first();

                $newData['product_id'] = $id;
                $newData['size_unit'] = $request['size_unit'][$i];
                $newData['size'] = $request['size'][$i];
                $newData['price'] = $request['size_price'][$i];
                $newData['size_available'] = $request['size_available'][$i];
    
                if(@$request['chart'][$i]){
    
                    if(file_exists(storage_path('app/public/chart/'.$get_exists['chart'])))
                    {                
                        unlink(storage_path('app/public/chart/'.$get_exists['chart']));                
                    }
    
                    // chart upload START  
                        $img = $request['chart'][$i];
                        $filename  = "chart-".uniqid().'.'.$img->getClientOriginalExtension();
                        $img->move(storage_path('app/public/chart'), $filename);
                        $newData['chart'] = $filename;
                    // chart upload END                
                }
    
                $check_exists = ProductSize::where('id',$request['product_size_id'][$i])->update($newData);

            }

        }       

        } else {
            Session::flash('message', '<div class="alert alert-warning"><strong>Failed!</strong> Somenthing Went Wrong.!! </div>');
            return redirect('admin/product');
        }  

        if($update){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Product Updated Successfully.!! </div>');
            return redirect('admin/product');
        }

    }

    public function remove_product_size(Request $request){

        $this->validate($request, [
            'sizeId' => 'required|numeric'           
        ]);
       
        $get = ProductSize::where('id',$request->sizeId)->first();

        if(file_exists(storage_path('app/public/chart/'.$get['chart'])))
        {                
            unlink(storage_path('app/public/chart/'.$get['chart']));                
        }

        $delete = ProductSize::where('id',$request->sizeId)->delete();

        return response()->json('deleted');

    }

    public function category_by_type(Request $request){

        $this->validate($request, [
            'nettype' => 'required|numeric'           
        ]);

        $getCategory = Category::where('type_id',$request->nettype)->pluck('name','id')->toArray();
       
        return response()->json($getCategory);
       

    }

    public function subcategory_by_category(Request $request){

        $this->validate($request, [
            'category' => 'required|numeric'           
        ]);

        $getSubCategory = SubCategory::where('category_id',$request->category)->pluck('name','id')->toArray();
       
        return response()->json($getSubCategory);

    }

    public function delete(Request $request){

        $this->validate($request, [
            'productId' => 'required|numeric'           
        ]);
       
        $getProduct = Product::where('id',$request->productId)->first();
        
        if(!empty($getProduct)){            

            $oldImage = ProductImage::where('product_id',$request->productId)->get();

            foreach($oldImage as $img){
                if(file_exists(storage_path('app/public/product/'.$img['image'])))
                {                
                  unlink(storage_path('app/public/product/'.$img['image']));                
                }
            }

           $delete = Product::where('id',$request->productId)->delete();
           return response()->json('success');
        } else {
           return response()->json('faild');
        }
    }

    public function remove_image(Request $request){

        $this->validate($request, [
            'imageId' => 'required|numeric'           
        ]);
        
        $getProductimage = ProductImage::where('id',$request->imageId)->first();

        // check at least one product image should be available START
        $check = ProductImage::where('product_id',$getProductimage->product_id)->get();

        if(count($check) == 1){
            return response()->json('limit'); 
        }
        // check at least one product image should be available END

        
        
        if(!empty($getProductimage)){

            if(file_exists(storage_path('app/public/product/'.$getProductimage['image']))){                                
                unlink(storage_path('app/public/product/'.$getProductimage['image']));                
            }

        $delete = ProductImage::where('id',$request->imageId)->delete();
        return response()->json('success');
        } else {
           return response()->json('faild');
        }

    }
}
