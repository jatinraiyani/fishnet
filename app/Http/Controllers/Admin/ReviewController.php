<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(){
        $data = Review::get();

        return view('admin.review.index',compact('data'));
    }

    public function delete(Request $request){
        $this->validate($request, [
            'reviewId' => 'required|numeric'           
        ]);      
        
        $delete = Review::where('id',$request->reviewId)->delete();
        
        if(!empty($delete)){
           return response()->json('success');
        } else {
           return response()->json('faild');
        }
    }
}
