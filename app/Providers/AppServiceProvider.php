<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CMS;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['include.front.header','include.front.footer'], function ($view) {

            $data = CMS::get();

            foreach($data as $row_cms){
                if($row_cms['slug'] == 'address'){
                    $headerData['address']  = $row_cms['value'];
                } elseif($row_cms['slug'] == 'email'){
                    $headerData['email']  = $row_cms['value'];
                } elseif($row_cms['slug'] == 'contact'){
                    $headerData['contact']  = $row_cms['value'];
                } elseif($row_cms['slug'] == 'logo'){
                    $headerData['logo']  = $row_cms['value']; 
                } else {
                    continue;
                }
            }

            $view->headerData = $headerData;
            
        });
    }
}
