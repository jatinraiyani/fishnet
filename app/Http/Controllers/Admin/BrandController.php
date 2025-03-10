<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Session;

class BrandController extends Controller
{
    public function index(){

        $data = Brand::get();

        return view('admin.brand.index',compact('data'));
    }

    public function create(){

        return view('admin.brand.create');

    }

    public function store(Request $request){        
       
        $this->validate($request, [          
            'name' => 'required|unique:brand',          
            'image' => 'required',           
        ]);

        $data = $request->all();        
        $file_data = $request->image;

        if(!empty($file_data)) {            
        $image_parts = explode(";base64,", $file_data);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $f_name = 'brand-' . uniqid() . '.png';       
        $file = 'storage/app/public/brand/'.$f_name;
        file_put_contents($file,$image_base64);
        $data['image'] = $f_name;        
        }  
        
        $store = new Brand;
        $store->fill($data);
        if($store->save()){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Brand Added Successfully.!! </div>');
            return redirect('admin/brand');
        }
    }

    public function edit($id){       

        $data = Brand::where('id',$id)->first(); 

        return view('admin.brand.edit',compact('data'));
    }

    public function update(Request $request, $id){

        $this->validate($request, [                    
            'name' => 'required|unique:brand,name,'.$id,
        ]);

        $get = Brand::where('id',$id)->first(); 

        $data = $request->all();
        $data = $request->except(['_token']);        

        if($request->image) {

            $this->validate($request, [
                'image' => 'required'           
            ]);    
    
            $oldimage = Brand::where('id', $id)->value('image');

            if (!empty($oldimage)) {
                if(file_exists(storage_path('app/public/brand/'.$oldimage)))
                {                
                unlink(storage_path('app/public/brand/'.$oldimage));                
                }
            } 
            
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $f_name = 'brand-' . uniqid() . '.png';       
            $file = 'storage/app/public/brand/'.$f_name;
            file_put_contents($file,$image_base64);
            $data['image'] = $f_name;

        } else {
            $data['image'] = $get->image;
        }
       
        $update = Brand::where('id',$id)->update($data);

        if($update){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Brand Updated Successfully.!! </div>');
            return redirect('admin/brand');
        }

    }
    public function delete(Request $request){

        $this->validate($request, [
            'brandId' => 'required|numeric'           
        ]);
       
        $getProduct = Brand::where('id',$request->brandId)->first();
        
        if(!empty($getProduct)){

         if(file_exists(storage_path('app/public/brand/'.$getProduct->image)))
            {                
                unlink(storage_path('app/public/brand/'.$getProduct->image));                
            }
           $delete = Brand::where('id',$request->brandId)->delete();
           return response()->json('success');
        } else {
           return response()->json('faild');
        }
    }
}
