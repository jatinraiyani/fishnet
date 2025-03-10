<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Type;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;

class TypeController extends Controller
{
    public function list(){

        $types = Type::all();

        if(!empty($types)){

            foreach($types as $row){
                $row->image = url('storage/app/public/type/'.$row->image);
            }

            return response()->json(['status'=> 1,'message'=> 'Type Get Successful','data'=>$types],200);
        } else {
            return response()->json(['status'=> 0,'message'=> 'No data found','data'=> null],400);
        }
    }

    public function category_by_type(Request $request){

        $rule=[
            'type'=>'required|numeric'
        ];

        $message=[
          'type.required'=>'Type name is required'
        ];

        $validate = Validator::make($request->all(),$rule,$message);

        if($validate->fails())
        {
            return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
        }

        $category = Category::where('type_id',$request->type)->get();

        if(!empty($category)){

            foreach($category as $row){
                $row->image = url('storage/app/public/category/'.$row->image);
            }
            return response()->json(['status'=> 1,'message'=> 'Category get successfull','data'=>$category],200);
        } else {
            return response()->json(['status'=> 0,'message'=> 'No data found','data'=> null],400);
        }

    }

    public function subcategory_by_category(Request $request){

        $rule=[
            'category'=>'required|numeric'
        ];

        $message=[
          'category.required'=>'category id is required'
        ];

        $validate = Validator::make($request->all(),$rule,$message);

        if($validate->fails())
        {
            return response()->json(['status'=> 0,'message'=>'validation fail','data'=>['errors'=>$validate->errors()->all()]],400);
        }

        $subcategory = SubCategory::where('category_id',$request->category)->get();

        if(!empty($subcategory)){

            foreach($subcategory as $row){
                $row->image = url('storage/app/public/subcategory/'.$row->image);
            }
            return response()->json(['status'=> 1,'message'=> 'SubCategory get successfull','data'=>$subcategory],200);
        } else {
            return response()->json(['status'=> 0,'message'=> 'No data found','data'=> null],400);
        }

    }

    public function category_list(){

        $category = Category::where('status','active')->get();

        if(!empty($category)){
            foreach($category as $row){
                $row->image = url('storage/app/public/category/'.$row->image);
            }
            return response()->json(['status'=> 1,'message'=> 'Category get successfull','data'=>$category],200);
        } else {
            return response()->json(['status'=> 0,'message'=> 'No data found','data'=> null],400);
        }

    }

    public function brand_list(){

        $brand = Brand::get();

        if(!empty($brand)){
            foreach($brand as $row){
                $row->image = url('storage/app/public/brand/'.$row->image);
            }
            return response()->json(['status'=> 1,'message'=> 'Brand get successfull','data'=> $brand],200);
        } else {
            return response()->json(['status'=> 0,'message'=> 'No data found','data'=> null],400);
        }

    }
}
