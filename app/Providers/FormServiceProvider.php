<?php

namespace App\Providers;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Fictionary\Support\Forms\AggregatorInterface;
use App\Fictionary\Support\Forms\DataAggregator;
use App\Fictionary\Support\Forms\Lists\CountryList;
use App\Fictionary\Support\Forms\Lists\StatusList;
use App\Fictionary\Support\Forms\Lists\GenderList;
use App\Fictionary\Support\Forms\Lists\GenreList;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ProfileController::class)
                  ->needs(AggregatorInterface::class)
                  ->give(function () {
                      return new DataAggregator([
                          new CountryList(),
                          new GenderList(),
                          new GenreList(),
                      ]);
                  });

          $this->app->when(UserController::class)
                    ->needs(AggregatorInterface::class)
                    ->give(function () {
                        return new DataAggregator([
                            new StatusList()
                        ]);
                    });
    }
}
