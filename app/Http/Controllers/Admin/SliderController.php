<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Session;

class SliderController extends Controller
{
    public function index(){

        $data = Slider::get();

        return view('admin.slider.index',compact('data'));
    }

    public function create(){

        return view('admin.slider.create');

    }

    public function store(Request $request){        
       
        $this->validate($request, [          
            'title' => 'nullable|unique:slider',          
            'description' => 'nullable',          
            'image' => 'required',           
        ]);

        $data = $request->all();        
        $file_data = $request->image;

        if(!empty($file_data)) {            
        $image_parts = explode(";base64,", $file_data);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $f_name = 'slider-' . uniqid() . '.png';       
        $file = 'storage/app/public/slider/'.$f_name;
        file_put_contents($file,$image_base64);
        $data['image'] = $f_name;        
        }  
        
        $store = new Slider;
        $store->fill($data);
        if($store->save()){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Slider Added Successfully.!! </div>');
            return redirect('admin/slider');
        }
    }

    public function edit($id){       

        $data = Slider::where('id',$id)->first(); 

        return view('admin.slider.edit',compact('data'));
    }

    public function update(Request $request, $id){

        $this->validate($request, [                    
            'title' => 'nullable|unique:slider,title,'.$id,
            'description' => 'nullable',
        ]);

        $get = Slider::where('id',$id)->first(); 

        $data = $request->all();
        $data = $request->except(['_token']);        

        if($request->image) {

            $this->validate($request, [
                'image' => 'required'           
            ]);
    
    
            $oldimage = Slider::where('id', $id)->value('image');

            if (!empty($oldimage)) {
                if(file_exists(storage_path('app/public/slider/'.$oldimage)))
                {                
                unlink(storage_path('app/public/slider/'.$oldimage));                
                }
            } 
            
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $f_name = 'slider-' . uniqid() . '.png';       
            $file = 'storage/app/public/slider/'.$f_name;
            file_put_contents($file,$image_base64);
            $data['image'] = $f_name;                
     

        } else {
            $data['image'] = $get->image;
        }
       
        $update = Slider::where('id',$id)->update($data);

        if($update){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Slider Updated Successfully.!! </div>');
            return redirect('admin/slider');
        }

    }

    public function delete(Request $request){

        $this->validate($request, [
            'sliderId' => 'required|numeric'           
        ]);
       
        $getProduct = Slider::where('id',$request->sliderId)->first();
        
        if(!empty($getProduct)){

         if(file_exists(storage_path('app/public/slider/'.$getProduct->image)))
            {                
                unlink(storage_path('app/public/slider/'.$getProduct->image));                
            }
           $delete = Slider::where('id',$request->sliderId)->delete();
           return response()->json('success');
        } else {
           return response()->json('faild');
        }
    }

}
