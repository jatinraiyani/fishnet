<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CMS;

class content extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $privacy = new CMS();
        $privacy->slug = 'privacy';      
        $privacy->save();

        $terms = new CMS();
        $terms->slug = 'terms';      
        $terms->save();

        $address = new CMS();
        $address->slug = 'address';      
        $address->save();

        $email = new CMS();
        $email->slug = 'email';      
        $email->save();

        $contact = new CMS();
        $contact->slug = 'contact';      
        $contact->save();

        $logo = new CMS();
        $logo->slug = 'logo';      
        $logo->save();
    }
}
