<?php

namespace App\Providers;

use App\Contracts\HtmlRendererInterface;
use App\Helpers\{Bundler, Html};
use App\Hooks\HooksHandler;
use App\PostTypes\PostTypeHandler;
use App\Taxonomies\TaxonomyHandler;
use App\View\Components\CTA;
use App\Walkers\{HeaderMainMenuWalker, HeaderMobileMainMenuWalker};
use Illuminate\Support\Facades\Blade;
use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
        $this->app->singleton( 'bundler', Bundler::class );
        $this->app->singleton( 'header_menu_walker', HeaderMainMenuWalker::class );
        $this->app->singleton( 'header_mobile_menu_walker', HeaderMobileMainMenuWalker::class );
        $this->app->bind( HtmlRendererInterface::class, Html::class );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        // Register custom post types
        PostTypeHandler::handle();
        // Register custom taxonomies
        TaxonomyHandler::handle();
        // Register hooks
        HooksHandler::register_hooks();

        Blade::component( 'cta', CTA::class );
    }
}
