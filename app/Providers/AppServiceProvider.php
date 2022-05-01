<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


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
        \Blade::directive('money', function ($amount) {

            $price ="
            <?php
             if($amount==0){
                 echo 'Liên hệ';
             }else { 
              echo number_format($amount,0,',','.').'₫'; 
             }
            ?>
            ";
             return $price;
         });
    }
}
