<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $results = DB::table('plan_setting')->get()->first();
        $data = (array) $results;
        define('title', $data['title']);
        define('logo', asset('../storage/uploads/' . $data['logo']));
        define('favicon', asset('/storage/uploads/' . $data['favicon']));
        define('base_url', $data['base_url']);
        define('prefix', $data['prefix']);
        define('registration', $data['registration']);
        define('activation', $data['activation']);
        define('currency', $data['currency']);
        define('withdraw', $data['withdraw']);
        define('withdraw_status', $data['withdraw_status']);
        define('min_withdraw', $data['min_withdraw']);
        define('max_withdraw', $data['max_withdraw']);
        define('multiple_withdraw', $data['multiple_withdraw']);
        define('withdraw_charges', $data['withdraw_charges']);
        define('incomeLimit', $data['incomeLimit']);
        define('level_access', $data['level_access']);
        define('direct_access', $data['direct_access']);
        define('roi_access', $data['roi_access']);
        define('SECT_KEY', "Vi@jrc437239Son@j53832ncdKAm24443443####$#$$0jnc2043");
    }
}
