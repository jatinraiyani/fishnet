<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdBanner;
use Session;

class AdBannerController extends Controller
{
    public function index(){

        $data = AdBanner::get();

        return view('admin.promobanner.index',compact('data'));
    }

    public function create(){       

        return view('admin.promobanner.create');

    }

    public function store(Request $request){        
       
        $this->validate($request, [
            'title' => 'nullable|string',          
            'image' => 'required',           
        ]);

        $data = $request->all();
        
        $file_data = $request->image;

        if(!empty($file_data)) {            
        $image_parts = explode(";base64,", $file_data);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $f_name = 'promobanner-' . uniqid() . '.png';       
        $file = 'storage/app/public/promobanner/'.$f_name;
        file_put_contents($file,$image_base64);
        $data['image'] = $f_name;        
        }  
        
        $store = new AdBanner;
        $store->fill($data);
        if($store->save()){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> AdBanner Added Successfully.!! </div>');
            return redirect('admin/promobanner');
        }
    }

    public function edit($id){       

        $data = AdBanner::where('id',$id)->first();
        return view('admin.promobanner.edit',compact('data'));
    }

    public function update(Request $request, $id){

        $this->validate($request, [   
            'title' => 'nullable|string',
        ]);

        $get = AdBanner::where('id',$id)->first(); 

        $data = $request->all();
        $data = $request->except(['_token']);

        if($request->image) { 

            $this->validate($request, [
                'image' => 'required'           
            ]);
    
    
            $oldimage = AdBanner::where('id', $id)->value('image');

            if (!empty($oldimage)) {
                if(file_exists(storage_path('app/public/promobanner/'.$oldimage)))
                {                
                unlink(storage_path('app/public/promobanner/'.$oldimage));                
                }
            } 
            
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $f_name = 'promobanner-' . uniqid() . '.png';       
            $file = 'storage/app/public/promobanner/'.$f_name;
            file_put_contents($file,$image_base64);
            $data['image'] = $f_name;                
     

        } else {
            $data['image'] = $get->image;
        }
       
        $update = AdBanner::where('id',$id)->update($data);

        if($update){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> AdBanner Updated Successfully.!! </div>');
            return redirect('admin/promobanner');
        }

    }

    public function delete(Request $request){

        $this->validate($request, [
            'adbannerId' => 'required|numeric'           
        ]);
       
        $getProduct = AdBanner::where('id',$request->adbannerId)->first();
        
        if(!empty($getProduct)){

         if(file_exists(storage_path('app/public/promobanner/'.$getProduct->image)))
            {                
                unlink(storage_path('app/public/promobanner/'.$getProduct->image));                
            }
           $delete = AdBanner::where('id',$request->adbannerId)->delete();
           return response()->json('success');
        } else {
           return response()->json('faild');
        }
    }
}
