<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CMS;
use Session;

class CMSController extends Controller
{

    public function index(){

        $privacyData = CMS::where('slug','privacy')->first();
        $privacy =$privacyData['value'];
        $termsData = CMS::where('slug','terms')->first();
        $terms =$termsData['value'];
        $addressData = CMS::where('slug','address')->first();
        $address =$addressData['value'];
        $contactData = CMS::where('slug','contact')->first();
        $contact =$contactData['value'];
        $emailData = CMS::where('slug','email')->first();
        $email =$emailData['value'];
        $logoData = CMS::where('slug','logo')->first();
        $logo =$logoData['value'];
              
        return view('admin.cms.cms',compact('privacy','terms','address','contact','email','logo'));

    }    

    public function update_cms(Request $request){

        $this->validate($request, [                    
            'address' => 'nullable',
            'contact' => 'nullable|numeric',
            'email' => 'nullable|email',
        ]); 

        $updateprivacy = CMS::where('slug','privacy')->update(['value' => $request->privacy]);
        $updateterms = CMS::where('slug','terms')->update(['value' => $request->terms]);
        $updateaddress = CMS::where('slug','address')->update(['value' => $request->address]);
        $updatecontact = CMS::where('slug','contact')->update(['value' => $request->contact]);
        $updateemail = CMS::where('slug','email')->update(['value' => $request->email]);       
        

        if($request->logo) {             
    
            $oldimage = CMS::where('slug','logo')->value('value');           

            if (!empty($oldimage)) {
                if(file_exists(storage_path('app/public/logo/'.$oldimage)))
                {                
                unlink(storage_path('app/public/logo/'.$oldimage));                
                }
            } 
            
            $image_parts = explode(";base64,", $request->logo);
            $image_type_aux = explode("image/", $image_parts[0]);            
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $f_name = 'logo-' . uniqid() . '.png';       
            $file = 'storage/app/public/logo/'.$f_name;
            file_put_contents($file,$image_base64);
            $data['logo'] = $f_name;

            $updatelogo = CMS::where('slug','logo')->update(['value' => $f_name]);

        } 

        if($updateprivacy || $updateterms || $updateaddress || $updatecontact || $updateemail || $updatelogo){
            Session::flash('message','<div class="alert alert-success"><strong>Success!</strong> CMS Updated Successfully.!! </div>');
            return redirect('admin/cms');
        }
    }
}
