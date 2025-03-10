<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    public function index(){

        $data = Category::get();

        return view('admin.category.index',compact('data'));
    }

    public function create(){

        $type = Type::get()->pluck('name','id');        

        return view('admin.category.create',compact('type'));

    }

    public function store(Request $request){        
       
        $this->validate($request, [  
            'type_id' => 'required|numeric',        
            'name' => 'required',          
            'image' => 'required',           
        ]);

        $data = $request->all();
        
        $file_data = $request->image;

        if(!empty($file_data)) {            
        $image_parts = explode(";base64,", $file_data);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $f_name = 'category-' . uniqid() . '.png';       
        $file = 'storage/app/public/category/'.$f_name;
        file_put_contents($file,$image_base64);
        $data['image'] = $f_name;        
        }  
        
        $store = new Category;
        $store->fill($data);
        if($store->save()){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Category Added Successfully.!! </div>');
            return redirect('admin/category');
        }
    }

    public function edit($id){       

        $data = Category::where('id',$id)->first(); 
        $type = Type::get()->pluck('name','id');

        return view('admin.category.edit',compact('data','type'));
    }

    public function update(Request $request, $id){

        $this->validate($request, [   
            'type_id' => 'required|numeric',                 
            'name' => 'required',
        ]);

        $get = Category::where('id',$id)->first(); 

        $data = $request->all();
        $data = $request->except(['_token']);

        if($request->image) { 

            $this->validate($request, [
                'image' => 'required'           
            ]);
    
    
            $oldimage = Category::where('id', $id)->value('image');

            if (!empty($oldimage)) {
                if(file_exists(storage_path('app/public/category/'.$oldimage)))
                {                
                unlink(storage_path('app/public/category/'.$oldimage));                
                }
            } 
            
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $f_name = 'category-' . uniqid() . '.png';       
            $file = 'storage/app/public/category/'.$f_name;
            file_put_contents($file,$image_base64);
            $data['image'] = $f_name;                
     

        } else {
            $data['image'] = $get->image;
        }
       
        $update = Category::where('id',$id)->update($data);

        if($update){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Category Updated Successfully.!! </div>');
            return redirect('admin/category');
        }

    }
}
