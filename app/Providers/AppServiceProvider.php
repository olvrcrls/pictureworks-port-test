<?php

namespace App\Providers;

use Exception;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /** Applying macro for more readable response and programmability */
        Response::macro('success', function ($data, $message = 'OK') {
            return response()->json([
                'data' => $data,
                'message' => $message
            ], 200);
        });

        Response::macro('error', function ($error, $status_code = 422) {
            if (env('SCRIPT')) throw new Exception($error);
            Log::error($error);

            return response()->json([
                'error' => $error,
            ], $status_code);
        });
    }
}
