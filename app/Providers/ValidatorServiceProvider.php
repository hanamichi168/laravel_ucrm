<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Rules\FileExtension;

class ValidatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Validator::extend('extensions', function ($attribute, $value, $parameters) {
            $rule = app()->makeWith(FileExtension::class, [
                'extensions' => $parameters
            ]);
            return $rule->passes($attribute, $value);
        });
    }
}
