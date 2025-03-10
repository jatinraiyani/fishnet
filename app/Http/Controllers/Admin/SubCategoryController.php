<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Category;
use App\Models\SubCategory;
use Session;

class SubCategoryController extends Controller
{
    public function index(){

        $data = SubCategory::get();

        return view('admin.subcategory.index',compact('data'));
    }

    public function create(){

        $type = Type::get()->pluck('name','id'); 
        $category = Category::get()->pluck('name','id');       

        return view('admin.subcategory.create',compact('type','category'));

    }

    public function store(Request $request){        
       
        $this->validate($request, [ 
            'type_id' => 'required|numeric',         
            'category_id' => 'required|numeric',         
            'name' => 'required'          
        ]);

        $data = $request->all();
        
        $file_data = $request->image;

        if(!empty($file_data)) {            
        $image_parts = explode(";base64,", $file_data);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $f_name = 'subcategory-' . uniqid() . '.png';       
        $file = 'storage/app/public/subcategory/'.$f_name;
        file_put_contents($file,$image_base64);
        $data['image'] = $f_name;        
        }  
        
        $store = new SubCategory;
        $store->fill($data);
        if($store->save()){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> SubCategory Added Successfully.!! </div>');
            return redirect('admin/subcategory');
        }
    }

    public function edit($id){       

        $data = SubCategory::where('id',$id)->first(); 
        $type = Type::get()->pluck('name','id');        
        $category = Category::where('type_id',$data->type_id)->pluck('name','id');
        $selectedCategory = @$data->sub_category->id; 

        return view('admin.subcategory.edit',compact('data','type','category','selectedCategory'));
    }

    public function update(Request $request, $id){

        $this->validate($request, [ 
            'type_id' => 'required|numeric',         
            'category_id' => 'required|numeric',                         
            'name' => 'required',
        ]);

        $get = SubCategory::where('id',$id)->first(); 

        $data = $request->all();
        $data = $request->except(['_token']);

        if($request->image) {         
    
    
            $oldimage = SubCategory::where('id', $id)->value('image');

            if (!empty($oldimage)) {
                if(file_exists(storage_path('app/public/subcategory/'.$oldimage)))
                {                
                unlink(storage_path('app/public/subcategory/'.$oldimage));                
                }
            } 
            
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $f_name = 'subcategory-' . uniqid() . '.png';       
            $file = 'storage/app/public/subcategory/'.$f_name;
            file_put_contents($file,$image_base64);
            $data['image'] = $f_name;                
     

        } else {
            $data['image'] = $get->image;
        }
       
        $update = SubCategory::where('id',$id)->update($data);

        if($update){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> SubCategory Updated Successfully.!! </div>');
            return redirect('admin/subcategory');
        }

    }

    public function category_by_type(Request $request){

        $this->validate($request, [
            'nettype' => 'required|numeric'           
        ]);

        $getCategory = Category::where('type_id',$request->nettype)->pluck('name','id')->toArray();
       
        return response()->json($getCategory);
       

    }
}
