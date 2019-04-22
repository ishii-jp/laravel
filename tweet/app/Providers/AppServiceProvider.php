<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);
        // laravelのログファイルにsqlのクエリーログをデバッグ用で出すようにします。
        # 商用環境以外だった場合、SQLログを出力する
        // XAMPPのmysqlでクエリーログ を出せるようにしたのでこっちはコメントアウトします。
        
        // if (config('app.env') !== 'production') {
        //     DB::listen(function ($query) {
        //         \Log::info("Query Time:{$query->time}s] $query->sql");
        //     });
        // }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
