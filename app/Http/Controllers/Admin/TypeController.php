<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Session;

class TypeController extends Controller
{
    public function index(){

        $data = Type::get();

        return view('admin.type.index',compact('data'));
    }

    public function create(){

        return view('admin.type.create');

    }

    public function store(Request $request){        
       
        $this->validate($request, [          
            'name' => 'required|unique:type',          
            'image' => 'required',           
        ]);

        $data = $request->all();        
        $file_data = $request->image;

        if(!empty($file_data)) {            
        $image_parts = explode(";base64,", $file_data);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $f_name = 'type-' . uniqid() . '.png';       
        $file = 'storage/app/public/type/'.$f_name;
        file_put_contents($file,$image_base64);
        $data['image'] = $f_name;        
        }  
        
        $store = new Type;
        $store->fill($data);
        if($store->save()){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Type Added Successfully.!! </div>');
            return redirect('admin/type');
        }
    }

    public function edit($id){       

        $data = Type::where('id',$id)->first(); 

        return view('admin.type.edit',compact('data'));
    }

    public function update(Request $request, $id){

        $this->validate($request, [                    
            'name' => 'required|unique:type,name,'.$id,
        ]);

        $get = Type::where('id',$id)->first(); 

        $data = $request->all();
        $data = $request->except(['_token']);        

        if($request->image) {

            $this->validate($request, [
                'image' => 'required'           
            ]);
    
    
            $oldimage = Type::where('id', $id)->value('image');

            if (!empty($oldimage)) {
                if(file_exists(storage_path('app/public/type/'.$oldimage)))
                {                
                unlink(storage_path('app/public/type/'.$oldimage));                
                }
            } 
            
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $f_name = 'type-' . uniqid() . '.png';       
            $file = 'storage/app/public/type/'.$f_name;
            file_put_contents($file,$image_base64);
            $data['image'] = $f_name;                
     

        } else {
            $data['image'] = $get->image;
        }
       
        $update = Type::where('id',$id)->update($data);

        if($update){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Type Updated Successfully.!! </div>');
            return redirect('admin/type');
        }

    }

}
