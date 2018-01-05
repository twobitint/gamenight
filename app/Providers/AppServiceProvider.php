<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('active', function ($expression) {
            list($route, $result) = $this->getArguments($expression . ', \'active\'');
            return "<?php echo strpos(Route::currentRouteName(), $route) === 0 ? $result : ''; ?>";
        });

        Schema::defaultStringLength(191);
    }

    /**
     * Get argument array from argument string.
     *
     * @param string $argumentString
     *
     * @return array
     */
    private function getArguments($argumentString)
    {
        return explode(', ', str_replace(['(', ')'], '', $argumentString));
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
